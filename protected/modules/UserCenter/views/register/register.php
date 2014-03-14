<?php
/*
 * @var $this RegisterController
 */
$this->breadcrumbs = array ('Register' );
?>

<div class="registerFrame">
	<div class="registerFrameBorder">
		<div class="form login_form">
			<div class="registerTitle">请填写以下注册信息...</div>
	<?php
	
	$form = $this->beginWidget ( 'CActiveForm', array ('id' => 'register-form', 'enableClientValidation' => true, 'clientOptions' => array ('validateOnSubmit' => true ) ) );
	?>

	<p class="note none">
				Fields with <span class="required">*</span> are required.
			</p>
			
	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->radioButtonList ($model,'gender',$model-> gender_type,array('template'=>'<span class="radio">{input}{label}</span>','separator'=>'')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->dropDownList ($model,'userType',$model-> user_type,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'userType'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'district'); ?>
		<?php echo $form->dropDownList ($model,'district',$model-> district_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'district'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->dropDownList ($model,'area',$model-> area_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nation'); ?>
		<?php echo $form->dropDownList ($model,'nation',$model-> nation_list,array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'nation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idType'); ?>
		<?php echo $form->dropDownList($model,'idType',array(1=>'身份证','学生证','士兵证','军官证','护照和户口本'),array('class'=>'reg_select')); ?>
		<?php echo $form->error($model,'idType'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'idNum'); ?>
		<?php echo $form->textField($model,'idNum',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'idNum'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'degreeType'); ?>
		<?php echo $form->textField($model,'degreeType',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'degreeType'); ?>	
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'schoolName'); ?>
		 <?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'schoolName',
            'sourceUrl' => $this->createUrl('/UserCenter/register/get_school'),
 			'source'=>array('ac1','ac2','ac3'),
 			// additional javascript options for the autocomplete plugin
 			'options'=>array(
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
 											),
 										));
                                        ?>
		<?php if(0):?>
		<?php echo $form->textField($model,'schoolName',array('class'=>'reg_input')); ?>
		<?php endif;?>
		<?php echo $form->error($model,'schoolName'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'joinDate'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'language'=>'zh_cn',
				'name'=>'RegisterForm[joinDate]',
				'value'=> date('Y-m'),
				'options'=>array(
						'showAnim'=>'fold',
						'maxDate'=>'new Date()',
						'dateFormat'=>'yy-mm',
				),
				'htmlOptions'=>array(
						'style'=>'height:18px',
						'maxlength'=>8,'class'=>'reg_input',
				),
		));
		?>
		<?php if(0):?>
		<?php echo $form->textField($model,'joinDate',array('class'=>'reg_input')); ?>
		<?php endif;?>
		<?php echo $form->error($model,'joinDate'); ?>	
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'majoy'); ?>
		 <?php
          $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
 			'model'=>$model,
 			'attribute' => 'majoy',
            'sourceUrl' => $this->createUrl('/UserCenter/register/get_majoy'),
 			'source'=>array('ac1','ac2','ac3'),
 			// additional javascript options for the autocomplete plugin
 			'options'=>array(
 					'minLength'=>'1',
 											),
 											'htmlOptions'=>array(
 											'class'=>'reg_input',
 											),
 		));
         ?>
        <?php if(0):?>
		<?php echo $form->textField($model,'majoy',array('class'=>'reg_input')); ?>
		<?php endif;?>
		<?php echo $form->error($model,'majoy'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'isSame'); ?>
		<?php //@alan?>
		<?php echo $form->radioButtonList ($model,'isSame',array('1'=>'相同','0'=>'不同'),array('template'=>'<span class="radio">{input}{label}</span>','separator'=>'')); ?>
		<?php echo $form->error($model,'isSame'); ?>
	</div>
	
	<div class="row" style="margin:0px;height:40px;">
		<?php echo $form->labelEx($model,'beforeleave'); ?>
		<select id="seachprov" name="seachprov" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');"></select>
		<?php if(0):?>
			<input type="button"  value="获取地区" onClick="showAreaID()"/>
		<?php endif;?>
	</div>
	<div class="row" style="margin:0px;height:25px;">
		<select id="seachcity" name="homecity" onChange="changeCity(this.value,'seachdistrict','seachdistrict');"></select>
		</div>
		
		<div class="row" style="margin:0px;height:25px;">
					<span id="seachdistrict_div"><select id="seachdistrict" name="seachdistrict"></select></span>
		</div>
	
	
			<div class="row">
		<?php echo $form->labelEx($model,'sid'); ?>
		<?php echo $form->textField($model,'sid',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'sid'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('class'=>'reg_input')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>


	<div>
		<span class="allowregister">
		<?php echo $form->labelEx($model,'allowRegister'); ?>
		<?php echo $form->checkBox($model,'allowRegister'); ?>
		<a href="javascript:void(0);">查看大赛注册协议</a>
				</span>
		
		<?php echo $form->error($model,'allowRegister'); ?>
	</div>

			<div class="registerBtn">
				<a href="javascript:void();" class="submit_btn">注册</a>
		<?php // echo CHtml::submitButton('注册'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
		<!-- form -->

	</div>
	
	
</div>

<script>
	
$(document).ready(function(){
	_form_reset= function(){
	}
	
	$(".reg_input").change(function(){
		switch($(this).val()){
			case '3':
				$('.company_name_row').hide();
				break;
			case '4':
				$('.company_name_row').show();
				break;
			case '5':
				$('.company_name_row').show();
				break;
			default :
				break;
		}
	});
	
	$(".reg_input").change();

	$(".submit_btn").click(function(){
		$("#register-form").submit();
	});

	var _area_list = <?php echo $area_list_joson;?>;
	$("#RegisterForm_district").change(function(){
			var _p = $(this).val();
			var _sub_area = _area_list[_p];
			$("#RegisterForm_area").empty();
			
			$.each(_sub_area,function(k,v){
				$("<option>").val(v.id).html(v.name).appendTo($("#RegisterForm_area"));
			});
			
	});
	
	$("#RegisterForm_district").change();
	$("#RegisterForm_userType").change(function(){
		var _url="<?php echo $this -> createUrl('/register')?>";
		var _id = $(this).val();
		_url+='?userType='+_id;
		window.location.href = _url;
	});
});
</script>

<script src="js/Area.js" type="text/javascript"></script>
<script src="js/AreaData_min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
	initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '44', '0', '0');
});

//得到地区码
function getAreaID(){
	var area = 0;          
	if($("#seachdistrict").val() != "0"){
		area = $("#seachdistrict").val();                
	}else if ($("#seachcity").val() != "0"){
		area = $("#seachcity").val();
	}else{
		area = $("#seachprov").val();
	}
	return area;
}

function showAreaID() {
	//地区码
	var areaID = getAreaID();
	//地区名
	var areaName = getAreaNamebyID(areaID) ;
	alert("您选择的地区码：" + areaID + "      地区名：" + areaName);            
}

//根据地区码查询地区名
function getAreaNamebyID(areaID){
	var areaName = "";
	if(areaID.length == 2){
		areaName = area_array[areaID];
	}else if(areaID.length == 4){
		var index1 = areaID.substring(0, 2);
		areaName = area_array[index1] + " " + sub_array[index1][areaID];
	}else if(areaID.length == 6){
		var index1 = areaID.substring(0, 2);
		var index2 = areaID.substring(0, 4);
		areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
	}
	return areaName;
}
</script>


