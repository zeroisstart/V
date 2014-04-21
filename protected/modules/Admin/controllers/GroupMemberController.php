<?php

class GroupMemberController extends Controller
{
	public $layout = 'admin';
	
	
	public function actionDelete($id){
		
		
		$model = UserGroupMember::model() -> findByAttributes(array('ID'=>(int)$id));
		
		if($model){
		$userGroup = UserGroup::model();
		if($userGroup -> isLeader($model -> UID)){
			return false;
		}
		
		if($model) 
			$model -> delete();
		}
	}
	
	/**
	 *
	 * @param int $id
	 */
	public function actionView($id) {
		$model = UserGroup::model ();
		$model = $model->findByPk ( $id );
	
	
		if (empty ( $model )) {
			$this->redirect ( $this->createUrl ( '/Admin/group/list' ) );
		}
	
		$user_model = User::model ();
		$user_model = $user_model->findByPk ( $model -> UID );
	
		$groupMember_model = UserGroupMember::model ();
		$groupMember_model->gid = $model->ID;
		$dataProvider = $groupMember_model->search ();
	
		$this->render ( 'view', array (
				'model' => $model,
				'leader'=>$user_model,
				'groupMember_model' => $groupMember_model,
				'dataProvider' => $dataProvider
		) );
	}
}