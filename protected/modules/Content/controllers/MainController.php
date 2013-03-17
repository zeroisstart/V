<?php
class MainController extends Controller {
	public $defaultAction = 'main';
	
	public function actionCreate() {
		
		$this->render ( 'create' );
	}
	
	public function actionDelete() {
		$this->render ( 'delete' );
	}
	
	public function actionList() {
		$this->render ( 'list' );
	}
	
	public function actionMain() {
		$this->render ( 'main' );
	}
	
	public function actionUpdate() {
		$this->render ( 'update' );
	}
	
	public function actionView() {
		$this->render ( 'view' );
	}
	
	public function actionFileUpload() {
		Yii::import ( 'application.components.uploader.Uploader' );
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
	
	/**
	 * 文件上传类
	 *
	 * @return string
	 */
	public function actionUpload() {
		Yii::import ( 'application.components.uploader.Uploader' );
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
	
}