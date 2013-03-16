<?
/**
 * @property $errors_str string
 * @property $errors_array array
 */
abstract class ActiveRecord extends CActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_SEARCH = 'search';

    public $captcha;

    private $_meta; //full metadata of model

    /**
     * set by chain method throw404IfNull()
     * @var bool
     */
    public $throw_404_if_null = false;

    public $throw_if_errors;

    /**
     * set by chain method asArray()
     * @var bool
     */
    public $as_array = false;

    abstract public function name();

    /**
     * @param string $className
     * @return self
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function behaviors()
    {
        return array(
            'Languages'  => array(
                'class' => 'application.components.activeRecordBehaviors.LanguagesBehavior'
            ),
            'NullValue'      => array(
                'class' => 'application.components.activeRecordBehaviors.NullValueBehavior'
            ),
            'UserForeignKey' => array(
                'class' => 'application.components.activeRecordBehaviors.UserForeignKeyBehavior'
            ),
            'UploadFile'     => array(
                'class' => 'application.components.activeRecordBehaviors.UploadFileBehavior'
            ),
            'DateFormat'     => array(
                'class' => 'application.components.activeRecordBehaviors.DateFormatBehavior'
            ),
            'Timestamp'      => array(
                'class' => 'application.components.activeRecordBehaviors.TimestampBehavior'
            ),
            'MaxMin'         => array(
                'class' => 'application.components.activeRecordBehaviors.MaxMinBehavior'
            ),
            'RawFind'         => array(
                'class' => 'application.components.activeRecordBehaviors.RawFindBehavior'
            ),
        );
    }


    public function attributeLabels()
    {
        $labels = array();

        foreach ($this->meta() as $field_data)
        {
            $labels[$field_data["Field"]] = t($field_data["Comment"]);
        }

        $languages = Language::getList();
        if (count($languages) > 1)
        {
            $labels['language'] = 'Язык';
        }
        $labels['captcha'] = 'Введите код с картинки';

        return $labels;
    }


    public function label($attribute)
    {
        $labels = $this->attributeLabels();

        if (isset($labels[$attribute]) && !empty($labels[$attribute]))
        {
            return $labels[$attribute];
        }

        return ucfirst(str_replace('_', ' ', $attribute));
    }


    public function value($attribute)
    {
        $method_name = 'get' . ucfirst(Yii::app()->text->underscoreToCamelcase($attribute)) . 'Value';

        if (method_exists($this, $method_name))
        {
            return $this->$method_name();
        }
        else
        {
            return $this->$attribute;
        }
    }


    public function __get($name)
    {
        try
        {
            return parent::__get($name);
        } catch (CException $e)
        {
            if (substr($name, -6) == '_label')
            {
                $attribute = substr($name, 0, -6);
                return $this->getAttributeLabel($attribute);
            }

            $method_name = Yii::app()->text->underscoreToCamelcase($name);
            $method_name = 'get' . ucfirst($method_name);

            if (method_exists($this, $method_name))
            {
                return $this->$method_name();
            }
            else
            {
                throw new CException($e->getMessage());
            }
        }
    }


    public function __set($name, $val)
    {
        try
        {
            return parent::__set($name, $val);
        }
        catch (CException $e)
        {
            $method_name = Yii::app()->text->underscoreToCamelcase($name);
            $method_name = 'set' . ucfirst($method_name);

            if (method_exists($this, $method_name))
            {
                return $this->$method_name($val);
            }
            else
            {
                throw new CException($e->getMessage());
            }
        }
    }


    public function __toString()
    {
        $attributes = array(
            'name', 'title', 'description', 'id'
        );

        foreach ($attributes as $attribute)
        {
            if (array_key_exists($attribute, $this->attributes))
            {
                return $this->$attribute;
            }
        }
    }


    /*___________________________________________________________________________________*/


    /*SCOPES_____________________________________________________________________________*/
    /**
     * @return self
     */
    public function scopes()
    {
        $alias = $this->getTableAlias();
        return array(
            'ordered'   => array('order'     => $alias . '.`order` DESC'),
            'last'      => array('order'     => $alias . '.date_create DESC'),
        );
    }


    /**
     * @param $num
     * @return self
     */
    public function limit($num)
    {
        $this->getDbCriteria()->mergeWith(array(
            'limit' => $num,
        ));

        return $this;
    }


    /**
     * @param $num
     * @return self
     */
    public function offset($num)
    {
        $this->getDbCriteria()->mergeWith(array(
            'offset' => $num,
        ));

        return $this;
    }


    /**
     * @param        $row
     * @param        $values
     * @param string $operator
     * @return self
     */
    public function addInCondition($row, $values, $operator = 'AND')
    {
        $this->getDbCriteria()->addInCondition($row, $values, $operator);
        return $this;
    }


    /**
     * @param        $row
     * @param        $values
     * @param string $operator
     * @return self
     */
    public function notIn($row, $values, $operator = 'AND')
    {
        $this->getDbCriteria()->addNotInCondition($row, $values, $operator);
        return $this;
    }


    /**
     * @param $status
     * @return self
     */
    public function status($status)
    {
        $alias = $this->getTableAlias();
        $this->getDbCriteria()->mergeWith(array(
            'criteria' => "$alias.status=:status",
            'params' => array(
                'status' => $status
            )
        ));

        return $this;
    }


    public function meta()
    {
        if ($this->_meta == null);
        {
            $this->_meta = Yii::app()->db->cache(YII_DEBUG ? 0 : 3600)->createCommand("SHOW FUll columns FROM " . $this->tableName())->queryAll();
        }
        return $this->_meta;
    }


    public function optionsTree($name = 'name', $id = null, $result = array(), $value = 'id', $spaces = 0, $parent_id = null)
    {
        $objects = $this->findAllByAttributes(
            array('parent_id' => $parent_id),
            array('order'     => 'parent_id')
        );

        foreach ($objects as $object)
        {
            if ($object->id == $id)
            {
                continue;
            }

            $result[$object->$value] = str_repeat(".", $spaces) . $object->$name;

            if ($object->childs)
            {
                $result = $this->optionsTree($name, $id, $result, $value, $spaces+2, $object->id);
            }
        }

        return $result;
    }

    /**
     * @param CModelEvent $event
     */
    public function onBeforeFormInit($event)
    {
        $this->raiseEvent('onBeforeFormInit', $event);
    }

    /**
     * @param CModelEvent $event
     */
    public function onAfterFormInit($event)
    {
        $this->raiseEvent('onAfterFormInit', $event);
    }

    /**
     * @param CModelEvent $event
     */
    public function onBeforeGridInit($event)
    {
        $this->raiseEvent('onAfterGridInit', $event);
    }

    /**
     * @param CModelEvent $event
     */
    public function onAfterGridInit($event)
    {
        $this->raiseEvent('onAfterGridInit', $event);
    }

    /**
     * @param CModelEvent $event
     */
    public function onBeforeGridInitColumns($event)
    {
        $this->raiseEvent('onBeforeGridInitColumns', $event);
    }

    /**
     * @param CModelEvent $event
     */
    public function onAfterGridInitColumns($event)
    {
        $this->raiseEvent('onAfterGridInitColumns', $event);
    }


    public function getAttachedModel($model_class)
    {
        $attach = new $model_class();
        $attach->model_id = get_class($this);
        if ($this->getIsNewRecord())
        {
            $attach->object_id = 'tmp_' . get_class($this) . '_' . Yii::app()->user->id;
        }
        else
        {
            $attach->object_id = $this->getPrimaryKey();
        }

        return $attach;
    }


    public function existsByAttributes($attributes)
    {
        $criteria = new CDbCriteria();
        foreach ($attributes as $attribute => $value)
        {
            $criteria->compare($attribute, $value);
        }

        return $this->exists($criteria);
    }


    public function getErrorsArray()
    {
        $result = array();

        foreach ((array)$this->errors as $attribute => $errors)
        {
            foreach ($errors as $error)
            {
                $result[] = array(
                    'attribute' => $attribute,
                    'label'     => $this->getAttributeLabel($attribute),
                    'error'     => $error
                );
            }
        }

        return $result;
    }


    public function getErrorsStr()
    {
        return implode("\n", ArrayHelper::extract($this->getErrorsArray(), 'error'));
    }


    public function getUrl()
    {
        return $this->getActionUrl("view", array('id' => $this->id));
    }


    public function getUpdateUrl()
    {

        return $this->getActionUrl("update", array('id' => $this->id));
    }


    public static function getCreateUrl()
    {
        return self::getActionUrl("create");
    }


    public function getDeleteUrl()
    {

        return $this->getActionUrl("delete");
    }


    public static function getActionUrl($action, $params = array())
    {
        $model  = lcfirst(get_called_class());
        $module = AppManager::getModelModule($model);

        return Yii::app()->createUrl("/$module/$model/$action", $params);
    }


    public function throw404IfNull()
    {
        /*
        if not clone than expression:
        User::model()->throw404IfNull()->findByPk(Yii::app()->user->model->id);
        will not working right, because User::model() is reference on object from AR::model cache and
        Yii::app()->user->model will do User::model() for finding record already with our flag
        */
        $clone = clone $this;
        $clone->throw_404_if_null = true;
        return $clone;
    }


    public function throwIfErrors()
    {
        $this->throw_if_errors = true;
    }


    public function asArray()
    {
        $clone = clone $this; // please see comments for self::throw404IfNull() about it
        $clone->as_array = true;
        return $clone;
    }

    /*___________________________________________________________________________________*/


    /*find* methods______________________________________________________________________*/

    /**
     * @param mixed  $pk
     * @param string $condition
     * @param array  $params
     * @return self
     */
    public function findByPk($pk,$condition='',$params=array())
    {
        $method = $this->as_array ? 'findByPkRaw' : 'findByPk';
        $result = parent::$method($pk, $condition, $params);

        if ($this->throw_404_if_null && $result === null)
        {
            Yii::app()->controller->pageNotFound();
        }
        return $result;
    }

    /**
     * @param array  $attributes
     * @param string $condition
     * @param array  $params
     * @return self
     */
    public function findByAttributes($attributes,$condition='',$params=array())
    {
        $method = $this->as_array ? 'findByAttributesRaw' : 'findByAttributes';
        $result = parent::$method($attributes, $condition, $params);

        if ($this->throw_404_if_null && $result === null)
        {
            Yii::app()->controller->pageNotFound();
        }
        return $result;
    }

    /**
     * @param string $condition
     * @param array  $params
     * @return self[]
     */
    public function find($condition='',$params=array())
    {
        $method = $this->as_array ? 'findRaw' : 'find';
        return parent::$method($condition, $params);
    }

    /**
     * @param string $condition
     * @param array  $params
     * @return self[]
     */
    public function findAll($condition='',$params=array())
    {
        $method = $this->as_array ? 'findAllRaw' : 'findAll';
        return parent::$method($condition, $params);
    }

    /**
     * @param mixed  $pk
     * @param string $condition
     * @param array  $params
     * @return self[]
     */
    public function findAllByPk($pk,$condition='',$params=array())
    {
        $method = $this->as_array ? 'findAllByPkRaw' : 'findAllByPk';
        return parent::$method($pk, $condition, $params);
    }

    /**
     * @param array  $attributes
     * @param string $condition
     * @param array  $params
     * @return self[]
     */
    public function findAllByAttributes($attributes,$condition='',$params=array())
    {
        $method = $this->as_array ? 'findAllByAttributesRaw' : 'findAllByAttributes';
        return parent::$method($attributes, $condition, $params);
    }


    public function afterFind()
    {
        parent::afterFind();
        $this->as_array = $this->throw_404_if_null = false;
    }


    public function fetchScalarByAttributes(array $attributes, $scalar_attribute)
    {
        $model = $this->findByAttributes($attributes);
        if ($model)
        {
            return $model->$scalar_attribute;
        }
    }


    public function save($runValidation = true, $attributes=null)
    {
        $save = parent::save($runValidation, $attributes);
        if ($this->throw_if_errors && !$save && $this->errors)
        {
            throw new CException("Can't save model " . get_class($this) . ': ' . $this->errors_str);
        }

        return $save;
    }


    public static function getSmartDate($date_time)
    {
        $curr = date('Y-m-d');
        $date = date('Y-m-d', strtotime($date_time));

        switch (true)
        {
            case $curr == $date:
                return 'сегодня';

            case date('Y-m-d', strtotime('-1 day')) == $date:
                return 'вчера';

            case date('Y-m-d', strtotime('-2 day')) == $date:
                return 'позавчера';

            case date('Y-m-d', strtotime('-3 day')) == $date:
                return '3 дня назад';

            case date('Y-m-d', strtotime('-4 day')) == $date:
                return '4 дня назад';

            default:
                return Yii::app()->dateFormatter->formatDateTime(strtotime($date_time), 'short', 'short');
        }
    }
}
