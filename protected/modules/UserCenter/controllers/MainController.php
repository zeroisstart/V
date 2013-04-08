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
			case 'join' :
				$this->_actionJoin ();
				break;
			case 'book' :
				$this->_actionBook ();
				break;
			case 'accept' :
				$this->_actionAccept ();
				break;
			case 'acceptTeam' :
				break;
			case 'assessment' :
				$this->_actionAssessment ();
				break;
			case 'assessmented' :
				$this->_actionAssessmented ();
				break;
			default :
				
				$user = Yii::app ()->user;
				$uid = $user->id;
				
				$profile = $user->userProfile;
				// 评委老师页面
				if ($profile && $user->userProfile->User_category == 2) {
					$this->_actionAssessment ();
				} else {
					$news = News::model ()->findByPk ( '230' );
					
					$this->render ( 'main', array (
							'model' => $news 
					) );
				}
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
				'state' => '1' 
		) );
		
		if (empty ( $row )) {
			
			$group_model = UserGroup::model ();
			$group_model->state = '1';
			$dataProvider = $group_model->search ();
			$this->render ( 'joinTeam', array (
					'model' => $group_model,
					'dataProvider' => $dataProvider 
			) );
		} else {
			
			$group_model = UserGroup::model ();
			$group_model = $group_model->findByPk ( $row->gid );
			
			$booked = UserBooked::model ();
			$booked = $booked->findByAttributes ( array (
					'UID' => $uid 
			) );
			
			$product = UserProductGrade::model ();
			$product = $product->findByAttributes ( array (
					'gid' => $row->gid 
			) );
			
			$this->render ( 'team', array (
					'model' => $row,
					'group_model' => $group_model,
					'booked' => $booked,
					'product' => $product 
			) );
		}
	}
	
	/**
	 * 求组团
	 */
	public function _actionJoin() {
		$req = Yii::app ()->request;
		$id = ( int ) $req->getParam ( 'id' );
		
		$userGroup = UserGroup::model ();
		$userGroup = $userGroup->findByPk ( $id );
		
		if (empty ( $userGroup )) {
			// 组不存在
			echo CJavaScript::encode ( array (
					'status' => 0,
					'code' => '2' 
			) );
		}
		
		$userGroupModel = UserGroupMember::model ();
		$user = Yii::app ()->user;
		$uid = $user->id;
		$username = $user->username;
		if ($userGroupModel->canJoin ( $uid )) {
			$model = new UserGroupMember ();
			$model->UID = $uid;
			$model->gid = $id;
			$model->username = $username;
			$model->state = 0;
			$model->create_time = date ( 'Y-m-d H:i:s', time () );
			if ($model->save ()) {
				echo CJavaScript::encode ( array (
						'status' => 1,
						'code' => '1' 
				) );
			} else {
				var_dump ( $model->errors );
			}
		} else {
			echo CJavaScript::encode ( array (
					'status' => 0,
					'code' => '3' 
			) );
		}
	}
	
	/**
	 * 接受队员
	 */
	public function _actionAccept() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$userGroup = UserGroup::model ()->findByAttributes ( array (
				'UID' => $uid 
		) );
		
		if (empty ( $userGroup )) {
			$this->redirect ( $this->createUrl ( '/UserCenter/main/main' ) );
		}
		
		$userGroupMember = UserGroupMember::model ();
		$userGroupMember->gid = $userGroup->ID;
		$userGroupMember->state = '0';
		$dataProvider = $userGroupMember->search ();
		
		$this->render ( 'accept', array (
				'model' => $userGroup,
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 */
	public function acceptTeam() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$req = Yii::app ()->request;
		
		$teamid = ( int ) $req->getParam ( 'teamid' );
		$joinUserID = $req->getParam ( 'userid' );
		
		$userGroup = UserGroup::model ()->findByAttributes ( array (
				'uid' => $uid,
				'ID' => $teamid 
		) );
		if (empty ( $userGroup ))
			die ( CJavaScript::encode ( array (
					'status' => '0',
					'code' => 1,
					'msg' => '您不是那个队的队长哦!' 
			) ) );
		$userGroupMember = UserGroupMember::model ()->findByAttributes ( array (
				'gid' => $userGroup->ID,
				'uid' => $joinUserID 
		) );
		
		if (empty ( $userGroupMember )) {
			die ( CJavaScript::encode ( array (
					'status' => '0',
					'code' => 2,
					'msg' => '您不是那个队的队长哦!' 
			) ) );
		}
		
		$userGroupMember->state = 1;
		if ($userGroupMember->update ()) {
			// 成功加入
			echo CJavaScript::encode ( array (
					'status' => 1,
					'code' => 0 
			) );
		}
	}
	
	/**
	 * 我的作品
	 */
	public function _actionProduct() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$groupMemberModel = UserGroupMember::model ();
		$groupMemberModel = $groupMemberModel->findByAttributes ( array (
				'UID' => $uid,
				'state' => '1' 
		) );
		$product = '';
		$group = '';
		
		// ar_dump($groupMemberModel);
		// ie;
		if ($groupMemberModel) {
			
			$group = UserGroup::model ()->findByAttributes ( array (
					'ID' => $groupMemberModel->gid 
			) );
			
			$product = UserProductGrade::model ()->findByAttributes ( array (
					'gid' => $groupMemberModel->gid 
			) );
		}
		
		if (! ($group)) {
			$this->render ( 'no_grp', array () );
		} elseif (! ($product)) {
			$this->render ( 'no_pro', array (
					'groupMember' => $groupMemberModel,
					'group' => $group 
			) );
		} else {
			
			$this->render ( 'product', array (
					'model' => $groupMemberModel 
			) );
		}
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
	public function _actionBook() {
		$this->render ( 'book' );
	}
	
	/**
	 * 评委获取需要评定的作品
	 */
	public function _actionAssessment() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$productGrade = UserGroupGrade::model ();
		$productGrade->judges = $uid;
		$productGrade->is_checked = 0;
		
		$req = Yii::app ()->request;
		$id = $req->getParam ( 'id' );
		
		if ($id) {
			
			$productGrade->ID = $id;
			
			$criteria = new CDbCriteria ();
			$criteria->compare ( 't.judges', $uid );
			$criteria->compare ( 't.is_checked', 0 );
			$criteria->compare ( 't.ID', $id );
			$criteria->with = array (
					'product' 
			);
			
			$model = $productGrade->find ( $criteria );
			
			if (isset ( $_POST ['UserGroupGrade'] )) {
				$model->attributes = $_POST ['UserGroupGrade'];
				if ($model->validate ()) {
					$model->is_checked = 1;
					$model->check_time = date ( 'Y-m-d H:i:s', time () );
					$model->save ();
					Yii::app ()->user->setFlash ( 'success', '评分成功!' );
					$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
							'ac' => 'assessment' 
					) ) );
				} else {
					var_dump ( $model->errors );
				}
			}
			
			if (empty ( $model )) {
				$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
						'ac' => 'assessment' 
				) ) );
			}
			
			$this->render ( 'assessment_ing', array (
					'model' => $model 
			) );
		} else {
			$dataProvider = $productGrade->search ();
			$this->render ( 'assessment', array (
					'model' => $productGrade,
					'dataProvider' => $dataProvider 
			) );
		}
	}
	
	/**
	 * 评委获取评定过的作品
	 */
	public function _actionAssessmented() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$productGrade = UserGroupGrade::model ();
		$productGrade->judges = $uid;
		$productGrade->is_checked = 1;
		$dataProvider = $productGrade->search ();
		
		$this->render ( 'assessmented', array (
				'model' => $productGrade,
				'dataProvider' => $dataProvider 
		) );
	}
}