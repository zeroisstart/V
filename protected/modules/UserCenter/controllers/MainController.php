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
			case 'info' :
				$this->_actionInfo ();
				break;
			case 'book' :
				$this->_actionBook ();
				break;
			case 'accept' :
				$this->_actionAccept ();
				break;
			case 'acceptTeam' :
				$this -> acceptTeam();
				break;
			case 'rejectTeam':
				$this -> rejectTeam();
				break;
			case 'export':
				$this -> _export();
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
		
		$bookinfo = $user->isBooked ();
		
		if (!$bookinfo || !$bookinfo ['state']) {
			
			if(!$bookinfo)
				Yii::app ()->user->setFlash ( 'success', "请先报名!" );
			else
				Yii::app ()->user->setFlash ( 'success', "请耐心等待审核" );
			
			$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
					'ac' => 'book' 
			) ) );
		}
		
		$group_member_model = UserGroupMember::model ();
		$row = $group_member_model->findByAttributes ( array (
				'UID' => $uid,
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
			
			$teacher = false;
			$member = array();
			foreach($group_model->members as $_mem){
				if($_mem -> profile -> User_category== 4){
					$teacher = $_mem;
				}
				$member [] = $_mem -> profile -> Realname;
			}
			$member_list = implode(',', $member);
			
			$this->render ( 'team', array (
					'model' => $row,
					'group_model' => $group_model,
					'booked' => $booked,
					'product' => $product,
					'teacher'=>$teacher,
					'memberList'=>$member_list
			) );
		}
	}
	
	public function _export(){
		$user_model = Yii::app() -> user;
		$leader = $user_model -> profile;
		if(UserGroup::model() -> isLeader($user_model -> id)){
			$leader = $user_model -> profile;
		}else{
			$member_model = UserGroup::model() -> findByAttributes(array('UID'=>$user_model -> id));
		}
		
		$team_name = '作品名称';
		$product_name = '作品名称';
		$full_name ='全称';
		$simple_name ='简称';
		
		#var_dump($user_model -> profile -> attributes);
		#die;
		ob_start();
		$this -> renderPartial('_export',array('full_name'=>$full_name,'simple_name'=>$simple_name, 'user'=>$user_model,'leader'=>$leader,'team_name'=>$team_name,'product_name'=>$product_name));
		$content = ob_get_clean();
		
		Yii::app() -> request -> sendFile("报名.doc", $content,'');
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
		$cdbcriteria = new CDbCriteria();
		$cdbcriteria -> compare('gid', $id);
		$count = (int)$userGroupModel -> count($cdbcriteria);
		
		if($count > 3){
			//人员满了
			echo CJavaScript::encode ( array (
					'status' => 0,
					'code' => '-2'
			) );
			die;
		}
		
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
		$dataProvider = $userGroupMember->search ();
		$this->render ( 'accept', array (
				'model' => $userGroup,
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * 拒绝申请
	 */
	public function rejectTeam(){
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$req = Yii::app ()->request;
		
		//@2
		$teamid = ( int ) $req->getParam ( 'teamid' );
		$joinUserID = $req->getParam ( 'userid' );
		
		$userGroup = UserGroup::model ()->findByAttributes ( array (
				'UID' => $uid,
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
				'UID' => $joinUserID
		) );
		
		if (empty ( $userGroupMember )) {
			die ( CJavaScript::encode ( array (
					'status' => '0',
					'code' => 2,
					'msg' => '您不是那个队的队长哦!'
			) ) );
		}
		
		if ($userGroupMember->delete ()) {
			// 成功加入
			echo CJavaScript::encode ( array (
					'status' => 1,
					'code' => 0
			) );
		}
	}
	
	/**
	 * 接收申请
	 */
	public function acceptTeam() {
		$user = Yii::app ()->user;
		$uid = $user->id;
		
		$req = Yii::app ()->request;
		
		//@2
		$teamid = ( int ) $req->getParam ( 'teamid' );
		$joinUserID = $req->getParam ( 'userid' );
		
		$userGroup = UserGroup::model ()->findByAttributes ( array (
				'UID' => $uid,
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
				'UID' => $joinUserID 
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
		
		$bookinfo = $user-> isBooked();
		
		if (!$bookinfo || !$bookinfo ['state']) {
			
			if(!$bookinfo)
				Yii::app ()->user->setFlash ( 'success', "请先报名!" );
			else
				Yii::app ()->user->setFlash ( 'success', "请耐心等待审核" );
			
			$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
					'ac' => 'book' 
			) ) );
		}
		
		$req = Yii::app ()->request;
		
		$groupMemberModel = UserGroupMember::model ();
		$groupMemberModel = $groupMemberModel->findByAttributes ( array (
				'UID' => $uid,
				'state' => 1 
		) );
		$product = '';
		$group = '';
		
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
			$model = new UserProductGrade ();
			$group = UserGroup::model ();
			$id = ( int ) $req->getParam ( 'id' );
			if ($id) {
				$model = UserProductGrade::model ()->findByPk ( $id );
				if (empty ( $model )) {

					$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
							'ac' => 'product' 
					) ) );
				}
				if (isset ( $_POST ['UserProductGrade'] )) {
					$model = $this->_updatePro ();
				}
			} else {
				if (isset ( $_POST ['UserProductGrade'] )) {
					$model = $this->_addPro ();
				}
			}
			
			
			
			$this->render ( 'no_pro', array (
					'model' => $model,
					'groupMember' => $groupMemberModel,
					'group' => $group 
			) );
		} else {

			$this->render ( 'product', array (
					'product' => $product,
					'model' => $groupMemberModel 
			) );
		}
	}
	/**
	 * 更新作品
	 *
	 * @return UserProductGrade
	 */
	public function _updatePro() {
		$req = Yii::app ()->request;
		$id = ( int ) $req->getParam ( 'id' );
		
		$model = UserProductGrade::model ()->findByAttributes ( array (
				'ID' => $id,
				'uid' => Yii::app ()->user->id 
		) );
		
		if ($model->edit_count >= 3) {
			$model->addError ( 'edit_count', "不能修改作品超过三次,谢谢!" );
		}
		
		$model = $this->_validateProductModel ( $model );
		$model->edit_count = ( int ) ($model->edit_count) + 1;
		if ($model->update ()) {
			Yii::app ()->user->setFlash ( 'success', "作品修改成功!" );
			$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
					'ac' => 'product' 
			) ) );
		}
		return $model;
	}
	
	/**
	 * 添加作品
	 *
	 * @return UserProductGrade
	 */
	public function _addPro() {
		$model = new UserProductGrade ();
		$model = $this->_validateProductModel ( $model );
		$model->edit_count = 0;
		if ($model->save ()) {
			Yii::app ()->user->setFlash ( 'success', "作品新增成功!" );
			$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
					'ac' => 'product' 
			) ) );
		}
		return $model;
	}
	/**
	 * 保存上传的文件
	 *
	 * @param UploadedFile $upload        	
	 * @return string
	 */
	public function _model_file_save(CUploadedFile $upload, $key = 'imgUploadPath') {
		$ext = $upload->getExtensionName ();
		$name = md5 ( $upload->getName () . time () );
		$name = $name . '.' . $ext;
		$path = Yii::app ()->getParams ();
		$imgUploadPath = $path->$key;
		$folder = UploadedFile::getFolder ( $imgUploadPath );
		// save before action
		$upload->saveAs ( $folder . '/' . $name );
		$savePath = (substr ( $folder, strpos ( $folder, '../' ) + 5 )) . '/' . $name;
		// save before action
		$upload->saveAs ( $folder . '/' . $name );
		return $savePath;
	}
	
	/**
	 *
	 * @param UserProductGrade $model        	
	 */
	public function _validateProductModel($model) {
		$user = Yii::app ()->user;
		
		$groupModel = UserGroup::model ()->findByAttributes ( array (
				'UID' => $user->id 
		) );
		$model->uid = $user->id;
		$model->attributes = $_POST ['UserProductGrade'];
		$model->gid = $groupModel->ID;
		// $model->
		$model->doc = UploadedFile::getInstance ( $model, 'doc' );
		$model->img = UploadedFile::getInstance ( $model, 'img' );
		$model->create_time = date ( 'Y-m-d H:i:s', time () );
		$model->type = 1;
		if ($model->validate ()) {
			// 保存文档文件
			$model->doc = $this->_model_file_save ( $model->doc, 'attachmentUploadPath' );
			// 保存图片文件
			$model->img = $this->_model_file_save ( $model->img );
		} else {
			// ar_dump ( $model->errors );
		}
		
		return $model;
	}
	/**
	 * 参赛状态
	 */
	public function _actionState() {
		$user = Yii::app ()->user;
		
		$groupMemberModel = UserGroupMember::model ()->findByAttributes ( array (
				'UID' => $user->id 
		) );
		$booked = UserBooked::model ();
		
		$booked = $booked->findByAttributes ( array (
				'UID' => $user->id 
		) );
		
		$this->render ( 'state', array (
				'groupMemberModel' => $groupMemberModel,
				'booked' => $booked 
		) );
	}
	
	/**
	 * 我要报名
	 */
	public function _actionBook(){
		$uid = Yii::app() -> user -> id;
		$team =  new UserGroup('create');
		$canBuild = $team -> canBuild($uid);
		$username= Yii::app() -> user -> name;
		
		if(!$canBuild){
			$this -> redirect($this -> createAbsoluteUrl('/profile').'?ac=accept');
			Yii::app() -> end();
		}
		
		if(isset($_POST['UserGroup'])){
			$team -> attributes = $_POST['UserGroup'];
			$team -> create_time = date('Y-m-d H:i:s');
			$team -> UID = $uid;
			$team -> username =$username ;
			$team -> state = 1;
			$team -> name = addslashes(strip_tags($team -> name));
			
			if($team -> validate()){
				$team -> save();
				
				$model = new UserGroupMember ('create');
				$model->UID = $uid;
				$model->gid = $team -> ID;
				$model->username = $username;
				$model->state = 1;
				$model->create_time = date ( 'Y-m-d H:i:s', time () );
				$model ->save();
				
			}else{
				YII_DEBUG &&var_dump($team -> errors); 
			}
		}
		
		if($canBuild){
			$model = new UserGroup();
			$this -> render('build_team',array('model'=>$model));
		}else{
			$this -> render('build_member');
		}
	}
	
	/**
	 * 我要报名
	 */
	public function old_actionBook() {
		$bookModel = new UserBooked ();
		$user = Yii::app ()->user;
		$bookModel_already = $bookModel->findByAttributes ( array (
				'UID' => $user->id 
		) );
		if (empty ( $bookModel_already )) {
			if (isset ( $_POST ['UserBooked'] )) {
				$bookModel->attributes = $_POST ['UserBooked'];
				$bookModel->UID = $user->id;
				$bookModel->state = 0;
				$bookModel->img = UploadedFile::getInstance ( $bookModel, 'img' );
				if ($bookModel->validate ()) {
					$path = $this->_model_file_save ( $bookModel->img );
					$bookModel->img = $path;
					if ($bookModel->save ()) {
						$user->setFlash ( 'success', '报名申请提交成功，请耐心等待验证哦!' );
						$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
								'ac' => 'book' 
						) ) );
					}
				} else {
					YII_DEBUG && var_dump ( $bookModel->errors );
				}
			}
		} else {
			$bookModel = $bookModel_already;
		}
		$this->render ( 'book', array (
				'model' => $bookModel 
		) );
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
	/**
	 * 个人用户信息
	 */
	public function _actionInfo() {
		$user = Yii::app ()->user;
		$userInfo = UserProfile::model ()->findByPk ( $user->id );
		
		$req = Yii::app ()->request;
		$edit = false;
		if ($req->getParam ( 'edit' )) {
			if (isset ( $_POST ['UserProfile'] )) {
				$userInfo->attributes = $_POST ['UserProfile'];
				if ($userInfo->validate ()) {
					$userInfo->save ();
					Yii::app ()->user->setFlash ( 'success', '修改成功!' );
					$this->redirect ( $this->createUrl ( '/UserCenter/main/main', array (
							'ac' => 'info' 
					) ) );
				}
			}
			
			$edit = true;
		}
		$this->render ( 'info', array (
				'model' => $userInfo,
				'edit' => $edit 
		) );
	}
}