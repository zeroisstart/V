<?php
/**
 * 新闻的管理后台 
 * @author Top
 *
 */
class NewsController extends Controller {
	
	/**
	 *
	 * @var array
	 */
	public $jsFiles = array ();
	
	/**
	 *
	 * @var array
	 */
	public $cssFiles = array ();
	
	/**
	 * 视图文件
	 *
	 * @var string
	 */
	public $layout = 'admin';
	
	/**
	 * 默认控制器
	 *
	 * @var string
	 */
	public $defaultAction = 'list';
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CController::accessRules()
	 */
	public function accessRules() {
		return array (
				array (
						'deny',
						'actions' => array (
								'create',
								'edit' 
						),
						'users' => array (
								'?' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'delete' 
						),
						'roles' => array (
								'admin' 
						) 
				),
				array (
						'deny',
						'actions' => array (
								'delete',
								'index' 
						),
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 *
	 * @return multitype:string
	 */
	public static function actionsTitles() {
		return array (
				'list' => '新闻列表',
				'create' => '新闻添加',
				'delete' => '新闻删除',
				'update' => '新闻编辑' 
		);
	}
	
	/**
	 * 新闻列表
	 */
	public function actionList() {
		$news = News::model ();
		
		if (isset ( $_POST ['News'] )) {
			$news->attributes = $_POST ['News'];
		}
		
		$data = $news->search ();
		
		$this->render ( 'list', array (
				'dataProvider' => $data 
		) );
	}
	
	/**
	 * 新闻添加
	 */
	
	// @todo.top
	public function actionCreate() {
		$model = new News ( 'create' );
		
		$user = Yii::app ()->user;
		
		if (isset ( $_POST ['News'] )) {
			$model->attributes = $_POST ['News'];
			
			$model = $this->_validateForm ( $model );
			
			if ($model->validate ()) {
				
				$db = Yii::app ()->db;
				$transaction = $db->beginTransaction ();
				
				try {
					$model->save ();
					$id = $model->ID;
					if ($model->category) {
						$category_data = new Category_Data ( 'create' );
						$category_data->cate_id = $model->category;
						$category_data->sub_id = $id;
						$category_data->save ();
					}
					
					$transaction->commit ();
				} catch ( Exception $e ) {
					$transaction->rollback ();
				}
				
				Yii::app ()->user->setFlash ( 'success', '新增成功!' );
				
				$this->redirect ( $this->createUrl ( '/news/admin/list' ) );
				
				// form inputs are valid, do something here
			} else {
				YII_DEBUG && var_dump ( $model->errors );
				die ();
			}
		}
		
		$this->render ( 'create', array (
				'model' => $model 
		) );
	}
	
	/**
	 * 新闻删除
	 */
	public function actionDelete($id) {
		if (empty ( $id )) {
			$this->run ( 'list' );
			Yii::app ()->end ();
		}
		$model = News::model ()->findByPk ( $id );
		
		if (empty ( $model )) {
			$this->run ( 'list' );
			Yii::app ()->end ();
		}
		
		if ($model->canDelete ()) {
			$model->delete ();
		}
		
		if (Yii::app ()->request->isAjaxRequest) {
			echo CJSON::encode ( array (
					'status' => '1',
					'msg' => '删除成功!' 
			) );
		} else {
		}
	}
	/**
	 * 新闻编辑
	 */
	public function actionUpdate($id) {
		if (empty ( $id )) {
			$this->run ( 'list' );
			Yii::app ()->end ();
		}
		$model = News::model ()->findByPk ( $id );
		if ($model) {
			if (isset ( $_POST ['News'] )) {
				$model->attributes = $_POST ['News'];
				$model = $this->_validateForm ( $model );
				if ($model->validate ()) {
					
					// $db = Yii::app ()->db;
					$transaction = $model->dbConnection->beginTransaction ();
					
					try {
						$model->save ();
						$id = $model->ID;
						if ($model->category) {
							$cdbCriteria = new CDbCriteria ();
							$cdbCriteria->compare ( 'sub_id', $id );
							Category_Data::model ()->deleteAll ( $cdbCriteria );
							$category_data = new Category_Data ( 'create' );
							$category_data->cate_id = $model->category;
							$category_data->sub_id = $id;
							$category_data->save ();
							$transaction->commit ();
						}
					} catch ( Exception $e ) {
						var_dump ( $e );
						$transaction->rollback ();
					}
					
					Yii::app ()->user->setFlash ( 'success', 'value', 'default' );
				}
			}
			
			$this->render ( 'update', array (
					'model' => $model 
			) );
		} else {
			// 没有找到这篇新闻
		}
	}
	
	/**
	 * 表单新增编辑验证
	 */
	private function _validateForm($model) {
		$user = Yii::app ()->user;
		$model->UID = $user->id;
		$model->text = $_POST ['editorValue'];
		$model->state = 'active';
		$model->date = date ( 'Y-m-d' );
		$model->create_time = date ( 'Y-m-d H:i:s' );
		return $model;
	}

	/**
	 * 文件上传类
	 *
	 * @return string
	 */
	public function actionImgUpload() {
		Yii::import ( 'application.components.system.Uploader' );
		if (empty ( $_FILES )) {
			die ( 'Not Allow Access!' );
		}
		
		$title = htmlspecialchars ( $_POST ['pictitle'], ENT_QUOTES );
		$path = htmlspecialchars ( $_POST ['dir'], ENT_QUOTES );
		
		// 上传配置
		$config = array (
				"savePath" => ($path == "1" ? "upload/" : "upload1/"),
				"maxSize" => 1000, // 单位KB
				"allowFiles" => array (
						".gif",
						".png",
						".jpg",
						".jpeg",
						".bmp" 
				) 
		);
		
		// 生成上传实例对象并完成上传
		$up = new Uploader ( "upfile", $config );
		
		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 * "originalName" => "", //原始文件名
		 * "name" => "", //新文件名
		 * "url" => "", //返回的地址
		 * "size" => "", //文件大小
		 * "type" => "" , //文件类型
		 * "state" => "" //上传状态，上传成功时必须返回"SUCCESS"
		 * )
		 */
		$info = $up->getFileInfo ();
		
		/**
		 * 向浏览器返回数据json数据
		 * {
		 * 'url' :'a.jpg', //保存后的文件路径
		 * 'title' :'hello', //文件描述，对图片来说在前端会添加到title属性上
		 * 'original' :'b.jpg', //原始文件名
		 * 'state' :'SUCCESS' //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
		 * }
		 */
		echo "{'url':'" . $info ["url"] . "','title':'" . $title . "','original':'" . $info ["originalName"] . "','state':'" . $info ["state"] . "'}";
	}
	
	
	/**
	 * 
	 */
	public function actionFileUpload() {
		Yii::import ( 'application.components.system.Uploader' );
		if (empty ( $_FILES )) {
			die ( 'Not Allow Access!' );
		}
	
		$config = array (
				"savePath" => "upload/", // 保存路径
				"allowFiles" => array (
						".rar",
						".xls",
						".doc",
						".docx",
						".zip",
						".pdf",
						".txt",
						".swf",
						".wmv"
				), // 文件允许格式
				"maxSize" => 100000);  // 文件大小限制，单位KB
		// 生成上传实例对象并完成上传
		$up = new Uploader ( "upfile", $config );
	
		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 * "originalName" => "", //原始文件名
		 * "name" => "", //新文件名
		 * "url" => "", //返回的地址
		 * "size" => "", //文件大小
		 * "type" => "" , //文件类型
		 * "state" => "" //上传状态，上传成功时必须返回"SUCCESS"
		 * )
		*/
		$info = $up->getFileInfo ();
	
		/**
		 * 向浏览器返回数据json数据
		 * {
		 * 'url' :'a.rar', //保存后的文件路径
		 * 'fileType' :'.rar', //文件描述，对图片来说在前端会添加到title属性上
		 * 'original' :'编辑器.jpg', //原始文件名
		 * 'state' :'SUCCESS' //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
		 * }
		*/
		echo '{"url":"' . $info ["url"] . '","fileType":"' . $info ["type"] . '","original":"' . $info ["originalName"] . '","state":"' . $info ["state"] . '"}';
		;
	}
	
}