 <?php
	class BookController extends Controller {
		/**
		 *
		 * @var string
		 */
		public $defaultAction = 'list';
		
		/**
		 * 用户报名申请页面
		 */
		public function actionList() {
			$book = UserBooked::model ();
			$book->state = 0;
			$dataProvider = $book->search ();
			$this->render ( 'list', array (
					'model' => $book,
					'dataProvider' => $dataProvider 
			) );
		}
		/**
		 */
		public function actionAccept() {
			$req = Yii::app ()->request;
			$id = $req->getParam ( 'id' );
			
			$book = UserBooked::model ()->findAllByAttributes ( array (
					'UID' => $id 
			) );
			if ($book) {
				$book->state = 1;
				$book->update ();
				die ( CJavaScript::jsonEncode ( array (
						'status' => 1,
						'msg' => '审核成功!' 
				) ) );
			} else {
				die ( CJavaScript::jsonEncode ( array (
						'status' => 0,
						'msg' => '没有找到该用户!' 
				) ) );
			}
		}
		/**
		 */
		public function actionRefused() {
			$req = Yii::app ()->request;
			$id = $req->getParam ( 'id' );
			
			$book = UserBooked::model ()->findAllByAttributes ( array (
					'UID' => $id 
			) );
			if ($book) {
				$book->state = 0;
				$book->update ();
				die ( CJavaScript::jsonEncode ( array (
						'status' => 0,
						'msg' => '拒绝成功!' 
				) ) );
			} else {
				die ( CJavaScript::jsonEncode ( array (
						'status' => 0,
						'msg' => '没有找到该用户!' 
				) ) );
			}
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
		 */
		public function actionDelete() {
			$this->render ( 'delete' );
		}
	}