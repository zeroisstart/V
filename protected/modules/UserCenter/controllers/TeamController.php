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
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $name, true, 'like' );
		$criteria->compare ( 'User_category', '4' );
		$profiles = UserProfile::model ()->findAll ( $criteria );
		$arr = array ();
		
		foreach ( $profiles as $profile ) {
			$arr [] = $profile->Realname;
		}
		echo json_encode ( $arr );
	}
	public function actionTeacher() {
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