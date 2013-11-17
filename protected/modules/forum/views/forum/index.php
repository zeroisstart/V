<div class="adminslidebar">

<?php

#$this->widget('zii.widgets.CBreadcrumbs', array(
#    'links'=>array('Forum')
#));


if(!Yii::app()->user->isGuest && Yii::app()->user->isAdmin)
{
    echo '管理员: '. CHtml::link('新建板块', array('/forum/forum/create'),array('class'=>'button small blue')) .'<br />';
}
?>

</div>
<?php
foreach($categories as $category)
{
    $this->renderpartial('_subforums', array(
        'forum'=>$category,
        'subforums'=>new CActiveDataProvider('Forum', array(
            'criteria'=>array(
                'scopes'=>array('forums'=>array($category->id)),
            ),
            'pagination'=>false,
        )),
    ));
}