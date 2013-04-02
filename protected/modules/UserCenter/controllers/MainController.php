<?php
/**
 * 
 * @author top
 *
 */
class MainController extends Controller {
	public $defaultAction = 'main';
	public $layout = '//layouts/ea';
	/**
	 * (non-PHPdoc)
	 *
	 * @see CController::accessRules()
	 */
	public function accessRules() {
		return array (
				array (
						'allow',
						'actions' => array (
								'main' 
						),
						'users' => array (
								'@' 
						),
						'roles' => array (
								'admin' 
						) 
				),
				array (
						'deny',
						'actions' => array (
								'main' 
						),
						'users' => array (
								'?' 
						) 
				) 
		);
	}
	public function actionMain() {
		$req = Yii::app ()->request;
		$ac = $req->getParam ( 'ac' );
		switch ($ac) {
			case 'team' :
				$this->_actionTeam ();
				break;
			case 'product' :
				$this->_actionProduct ();
				break;
			case 'state' :
				$this->_actionState ();
				break;
			case 'join':
				$this -> _actionJoin();
				break;
			case 'book':
				$this -> _actionBook();
				break;
			default :
				$this->render ( 'main' );
				break;
		}
	}
	/**
	 * 我的团队
	 */
	public function _actionTeam() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$group_member_model = UserGroupMember::model ();
		$row = $group_member_model->findByAttributes ( array (
				'UID' => $uid,
				'state' => 1 
		) );
		
		if (empty ( $row ) || 1) {
			
			$group_model = UserGroup::model ();
			$group_model->state = '1';
			$dataProvider = $group_model->search ();
			$this->render ( 'joinTeam', array (
					'model' => $group_model,
					'dataProvider' => $dataProvider 
			) );
		} else {
			
			$group_model = UserGroup::model();
			$group_model = $group_model -> findByPk($row -> gid);
			
			$booked = UserBooked::model();
			$booked = $booked -> findByAttributes(array('UID'=>$uid));
			
			$product = UserProductGrade::model();
			$product = $product -> findByAttributes(array('gid'=>$row -> gid));
			
			$this->render ( 'team', array (
					'model' => $row ,
					'group_model'=>$group_model,
					'booked' =>$booked,
					'product'=>$product
			) );
		}
	}
	
	/**
	 * 求组团
	 */
	public function _actionJoin(){
		$req = Yii::app() -> request;
		$id = (int)$req -> getParam('id');

		$userGroup =UserGroup::model();
		$userGroup = $userGroup -> findByPk($id);
		
		if(empty($userGroup)){
			//组不存在
			echo CJavaScript::encode(array('status'=>0,'code'=>'2'));
		}
		
		$userGroupModel = UserGroupMember::model();
		$user = Yii::app() -> user;
		$uid = $user -> id;
		$username = $user -> username;
		if($userGroupModel -> canJoin($uid)){
			$model = new UserGroupMember();
			$model -> uid = $uid;
			$model -> gid = $id;
			$model -> username = $username;
			$model -> create_time = data('Y-m-d H:i:s',time());
			if(1 || $model -> save()){
				echo CJavaScript::encode(array('status'=>1,'code'=>'1'));
			}else{
				var_dump($model -> errors);
			}
		}else{
			echo CJavaScript::encode(array('status'=>0,'code'=>'3'));
		}
		
		
	}
	
	/**
	 * 我的作品
	 */
	public function _actionProduct() {
		$this->render ( 'product' );
	}
	/**
	 * 参赛状态
	 */
	public function _actionState() {
		$this->render ( 'state' );
	}
	/**
	 * 我要报名
	 */
	public function _actionBook(){
		$this->render ( 'book' );
	}
}