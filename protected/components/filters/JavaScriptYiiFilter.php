<?php

/**
 * Created by JetBrains PhpStorm.
 * User: os
 * Date: 07.12.12
 * Time: 0:04
 * To change this template use File | Settings | File Templates.
 */

class JavaScriptYiiFilter extends CFilter
{
    public function preFilter($chain)
    {
        if (!Yii::app()->request->isAjaxRequest)
        {
            $params = array(
                'app' => array(
                    'controller' => array(
                        'id' => Yii::app()->controller->id,
                        'action' => array(
                            'id'   => Yii::app()->controller->action->id
                        ),
                        'module' => array(
                            'id'   => Yii::app()->controller->module->id,
                            'name' => Yii::app()->controller->module->name
                        )
                    ),
                    'user' => array(
                        'id'   => Yii::app()->user->id,
                        'name' => Yii::app()->user->isGuest ? null : Yii::app()->user->model->name,
                        'role' => Yii::app()->user->role,
                    )
                ) 
			);

            Yii::app()->clientScript->registerScript(
                'JavaScriptYiiFilter',
                "var Yii = " . CJSON::encode($params),
                CClientScript::POS_HEAD
            );
        }

        return true;
    }

}
