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
		$name=trim($name);
		$criteria->compare ( 'Realname', $name, true, 'like' );
		if ($ac == '1') {
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
	
	
	/**
	 * 
	 * @param integer $gid
	 */
	public function _checkMemberLimit($gid){
		$userGroupModel = UserGroupMember::model ();
		$cdbcriteria = new CDbCriteria();
		$cdbcriteria -> compare('gid', $gid);
		$count = (int)$userGroupModel -> count($cdbcriteria);
		if($count > 3){
			//人员满了
			return false;
		}
		return true;
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
			$uid = Yii::app() -> user -> id;
			$group_model = UserGroup::model();
			$gid = $group_model -> getGidByUID($uid);
			
			if(!$this -> _checkMemberLimit($gid)){
				echo json_encode ( array ('status' => 1,'msg'=>'队伍处于满员状态!' ) );
				die;
			}
			
			if(!$group_model -> canAddTeacher($profiles -> ID,$gid)){
				echo json_encode ( array ('status' => 1,'msg'=>'现有队伍中已有老师!' ) );
			}else{
				
				$userGroupModel = UserGroupMember::model ();
				if($userGroupModel->canJoin ( $uid ) || 1){
					$model = new UserGroupMember ();
					$model->UID = $profiles ->ID;
					$model->gid = $gid;
					$model->username = $profiles -> Realname;
					$model->state = 1;
					$model->create_time = date ( 'Y-m-d H:i:s', time () );
					if ($model->save ()) {
						echo json_encode ( array ('status' => 0 ) );
					}
					
				}else{
					echo json_encode ( array ('status' => 1,'msg'=>'无法加入!' ) );
				}
				
			}
			
		} else {
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
			$uid = Yii::app() -> user -> id;
			$group_model = UserGroup::model();
			$gid = $group_model -> getGidByUID($uid);
				
			if(!$this -> _checkMemberLimit($gid)){
				echo json_encode ( array ('status' => 1,'msg'=>'队伍处于满员状态!' ) );
				die;
			}
				
			if(!$group_model -> canAddMember($profiles ->ID,$gid)){
				echo json_encode ( array ('status' => 1,'msg'=>'现有队伍中已有该成员!' ) );
			}else{
		
				$userGroupModel = UserGroupMember::model ();
				if($userGroupModel->canJoin ( $uid ) || 1){
					$model = new UserGroupMember ();
					$model->UID = $profiles ->ID;
					$model->gid = $gid;
					$model->username = $profiles -> Realname;
					$model->state = 1;
					$model->create_time = date ( 'Y-m-d H:i:s', time () );
					if ($model->save ()) {
						echo json_encode ( array ('status' => 0 ) );
					}
						
				}else{
					echo json_encode ( array ('status' => 1,'msg'=>'无法加入!' ) );
				}
		
			}
				
		} else {
			echo json_encode ( array ('status' => 1, 'msg' => '没有找到对应的成员!' ) );
		}
		
	}
}	