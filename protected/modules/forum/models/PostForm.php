<?php
/**
 * This form is used to insert or edit posts, either in a new thread, or in
 * an existing one, depending on the model's current thread_id
 */

class PostForm extends CFormModel
{
    public $thread_id;
    public $subject;
    public $content;
    public $lockthread;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject', 'required', 'on'=>'create'),
            array('subject', 'length', 'max'=>120),
            array('content', 'required'),
            array('lockthread', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), array(
            'subject' => '表示',
            'content'=>'内容',
            'lockthread'=>'锁定帖子?',
        ));
    }
}
