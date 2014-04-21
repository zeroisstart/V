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
	public function actionDelete($id) {
		
		$userGroupMember = UserGroupMember::model()->deleteAllByAttributes(array('gid'=>$id));
		$userGroup = UserGroup::model()->findByPk($id);
		if($userGroup)
			$userGroup -> delete();
	}
	/**
	 * 用户组显示
	 */
	public function actionList() {
		$group = UserGroup::model ();
		// ar_dump($group-> attributes);
		// ie;
		$dataProvider = $group->search ();
		
		#var_dump($dataProvider -> data);
		#die;
		//error_reporting(E_ALL);
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

}