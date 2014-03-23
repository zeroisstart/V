<?php

/**
 * 
 * @author top
 *
 */
class TeamController extends Controller {
	
	/**
	 */
	public function actionIndex() {
		$this->render ( 'index' );
	}
	
	/**
	 */
	public function actionGet_user() {
		$name = Yii::app ()->request->getParam ( 'term' );
		$ac = Yii::app ()->request->getParam ( 'ac' );
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $name, true, 'like' );
		if ($ac == 2) {
			$criteria->compare ( 'User_category', '4' );
		} else {
			$criteria->compare ( 'User_category', '1' );
		}
		
		$profiles = UserProfile::model ()->findAll ( $criteria );
		$arr = array ();
		foreach ( $profiles as $profile ) {
			$arr [] = $profile->Realname;
		}
		echo json_encode ( $arr );
	}
	public function actionTeacher() {
		$UserGroup = Yii::app ()->request->getParam ( 'UserGroup' );
		$MasterName = $UserGroup ['MasterName'];
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $MasterName );
		$criteria->compare ( 'User_category', '4' );
		$profiles = UserProfile::model ()->find ( $criteria );
		
		if ($profiles) {
			echo json_encode ( array () );
		} else {
			$_model = UserGroup::model ();
			$_model->addError ( 'MasterName', '没有找到对应的老师!' );
			echo json_encode ( $_model->errors );
		}
	}
	public function actionMember() {
		$UserGroup = Yii::app ()->request->getParam ( 'UserGroup' );
		$MasterName = $UserGroup ['UserGroup'];
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $MasterName, true, 'like' );
		$criteria->compare ( 'User_category', '4' );
		$profiles = UserProfile::model ()->findAll ( $criteria );
		$arr = array ();
		
		foreach ( $profiles as $profile ) {
			$arr [] = $profile->Realname;
		}
		echo json_encode ( $arr );
	}
}	