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
		
		if(!$MasterName){
			echo json_encode ( array ('status' => 1 ,'msg'=>'老师名字不能为空!') );
			die;
		}
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $MasterName );
		$criteria->compare ( 'User_category', '4' );
		$profiles = UserProfile::model ()->find ( $criteria );
		
		if ($profiles) {
			echo json_encode ( array ('status' => 0 ) );
		} else {
			// _model = UserGroup::model ();
			// _model->addError ( 'MasterName', '' );
			echo json_encode ( array ('status' => 1, 'msg' => '没有找到对应的老师!' ) );
		}
	}
	
	
	public function actionMember() {
	$UserGroup = Yii::app ()->request->getParam ( 'UserGroup' );
		$MasterName = $UserGroup ['MemberName'];
		
		if(!$MasterName){
			echo json_encode ( array ('status' => 1 ,'msg'=>'成员名字不能为空!') );
			die;
		}
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'Realname', $MasterName );
		$criteria->compare ( 'User_category', '1' );
		$profiles = UserProfile::model ()->find ( $criteria );
		
		if ($profiles) {
			echo json_encode ( array ('status' => 0 ) );
		} else {
			// _model = UserGroup::model ();
			// _model->addError ( 'MasterName', '' );
			echo json_encode ( array ('status' => 1, 'msg' => '没有找到对应的老师!' ) );
		}
	}
}	