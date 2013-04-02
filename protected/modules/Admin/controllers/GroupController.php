<?php
/**
 * 
 * @author Top
 *
 */
class GroupController extends Controller {
	public $layout = 'admin';
	
	/**
	 */
	public function actionDelete() {
		$this->render ( 'delete' );
	}
	/**
	 * 用户组显示
	 */
	public function actionList() {
		$group = UserGroup::model ();
		// ar_dump($group-> attributes);
		// ie;
		$dataProvider = $group->search ();
		
		$this->render ( 'list', array (
				'model' => $group,
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 */
	public function actionMain() {
		$this->render ( 'main' );
	}
	/**
	 */
	public function actionUpdate() {
		$this->render ( 'update' );
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