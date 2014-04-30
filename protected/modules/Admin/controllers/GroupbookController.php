<?php

class GroupbookController extends Controller
{
	
	public $layout ='admin';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	/**
	 * 
	 * @param unknown_type $id
	 */
	public function actionUpdate($id){
		
		$groupBook = UserGroupBook::model() -> findByPk($id);
		
		$req = Yii::app() -> request;
		
		$state = $req -> getParam('state');
		
		$groupBook -> state = $state;
		$groupBook -> update();
		
		$this -> render('view',array('model'=>$groupBook));	
		
	}

	
	public function actionList(){

		
		$GroupBook = UserGroupBook::model();
		
		$dataProvider = $GroupBook -> search();
		
		$data =$dataProvider -> data;
		
		#foreach($data as $_model){
			#var_dump($_model -> attributes);
		#}
		
		
		$this ->render('list',array('dataProvider'=>$dataProvider));
	}
}