<?php

class MainController extends Controller {
	
	public $layout = 'admin';
	
	public $defaultAction = 'main';
	
	public function actionMain() {
		
		$user = Yii::app ()->user;
		
		if ($user->isGuest) {
			$this->redirect ( $this->createUrl ( '/admin/login' ) );
		}
		#var_dump($user -> profile);
		#die; 
		$this->render ( 'main' );
		
	}
	
	public function actionTest(){
		
		$userProfile = UserProfile::model();
		$data = $userProfile ->findAll();
		$model_CompetitionRegion = CompetitionRegion::model();
		$ary_CompetitionRegion = $model_CompetitionRegion -> district;
		
		
		$register_form = new RegisterForm();
		$ary_register = $register_form -> getNation_list();
		
		$model_region = new Region();
		
				
		foreach($data as $_model){
			
			echo $_model ->ID;
			echo ',';
			echo $_model -> Realname;
			echo ',';
			echo $_model -> gender ==1 ?'男':'女';
			echo ',';
			echo $_model -> getUserCategory();
			echo ',';
			echo $_model -> Nickname;
			echo ',';
			
			if(isset($ary_CompetitionRegion[$_model -> District])){
				echo $ary_CompetitionRegion[$_model -> District];
			}else{
				echo "";
			}
			
			echo ",";
			echo ",";
			echo ",";
			if(isset($ary_register[$_model -> nation])){
			echo  $ary_register[$_model -> nation];
			}else{
				echo "";
			}
			
			echo $_model -> IDNum;
			echo ",";
			echo $_model -> degreeType;
			echo ",";
			echo $_model -> schoolName;
			echo ",";
			echo $_model -> joinDate;
			echo ",";
			echo $_model -> majoy;
			//Team Name:
			echo ",";
			echo $_model -> getTeamName();
			
			//ProDuctName:
			echo ",";
			echo $_model -> getProName();
			//isSame
			echo ",";
			echo $_model -> isSame == 1?'是':'否';
			
			//beforeBelong
			echo ",";
			
			if($_model -> beforeleave){
				echo $model_region -> getRegion($_model -> beforeleave);
			}else{
				echo "";
			}
			
			echo ",";
			echo $_model -> sid;
			echo ",";
			echo $_model -> Mobile;
			echo ",";
			echo $_model -> Email;
			echo ",";
			echo $_model -> qq;
			echo ",";
			echo $_model ->address;
			
			echo "<br />";
		}
		
	}

}