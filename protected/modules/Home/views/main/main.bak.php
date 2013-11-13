<?php
/* @var $this MainController */

$this->breadcrumbs = array (
		'Main' 
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying the file
	<tt><?php echo __FILE__; ?></tt>
	.
</p>

<?php
$this->widget ( 'ext.popup.popup' );

$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'contact-form',
		// 'action' => $this->createUrl ( '/System/upload/ImgUpload' ),
		'action' => $this->createUrl ( '/System/upload/AttachmentUpload' ),
		'enableClientValidation' => true,
		'method' => 'post',
		'htmlOptions' => array (
				'enctype' => "multipart/form-data" 
		),
		'clientOptions' => array (
				'validateOnSubmit' => true 
		) 
) );

?>
<button>this is test</button>
<?php
/*
 * $model = new ImgUploadForm (); $this->widget ( 'widget.system.uploadForm',
 * array ( 'fieldName'=>'ImgUploadForm[img]', 'model' => $model ) );
 */
/*
$model = new ImgUploadForm ();
$this->widget ( 'widget.system.uploadForm', array (
		'fieldName'=>'AttachmentUploadForm[attachment]',
		'model' => $model
) );*/

?>

<?php echo CHtml::submitButton('submit');?>

<?php $this -> endWidget()?>


<div id="contextAdorn"></div>
            <div id="contextBox">
                <div id="rightContent">
                    <div id="contentTop">
                        <div id="contentTopImg"></div>
                        <div id="contentTopInfo">
                            <div class="title">竞赛资讯</div>
                            <ul>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                                <li><a href="javascript:;">全国高等院校物联网专业评估与人才培养研讨会在京举行</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="contentBlock">
                        <ul class="titleBar">
                            <li><a href="javascript:;" class="selected">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                        </ul>
                        <div class="contentBox"></div>
                    </div>
					
					 <div class="contentBlock">
                        <ul class="titleBar">
                            <li><a href="javascript:;" class="selected">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                        </ul>
                        <div class="contentBox"></div>
                    </div>
					
					
					 <div class="contentBlock">
                        <ul class="titleBar">
                            <li><a href="javascript:;" class="selected">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                            <li><a href="javascript:;">分赛区</a></li>
                        </ul>
                        <div class="contentBox"></div>
                    </div>
					
					
					 <div class="contentBlock">
                        <ul class="titleBar">
                            <li><a href="javascript:;">学长职业发展</a></li>
                        </ul>
                        <div class="contentBox"></div>
                    </div>
					
					
                </div>
                <div id="leftColumns">
                    <div id="userLogin">
                        <div id="userLoginTitle">用户登录</div>
                        <div id="userLoginBox">
                            <form>
                                <div class="userLoginInput">
                                    <span>用户名：</span>
                                    <input type="text" id="username" />
                                </div>
                                <div class="userLoginInput">
                                    <span>密&nbsp;&nbsp;&nbsp;码：</span>
                                    <input type="password" id="password" />
                                </div>
                            </form>
                            <div style="text-align: justify; padding: 5px;">
                                <span class="userLoginInput">
                                    <input type="button" class="login" />
                                </span>
                                <span class="userLoginInput">
                                    <input type="button" class="register" />
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="leftColumnsBox">
                        <div class="leftItem">
                            <div class="title">参与方式</div>
                            <div class="box">
                                <div class="first"></div>
                                <ul>
                                    <li><a class="link" href="javascript:;">竞赛微博</a></li>
                                    <li><a class="link" href="javascript:;">在线报名</a></li>
                                    <li><a class="link" href="javascript:;">作品提交</a></li>
                                    <li><a class="link" href="javascript:;">资料下载</a></li>
                                </ul>
                                <div class="last"></div>
                            </div>
                        </div>
                        <div class="leftItem">
                            <div class="title">合作伙伴</div>
                            <div class="box">
                                <div class="first"></div>
                                <div class="text">
                                    <p>
                                        抢票热线：010-88454017/88454027
                                        <br />
                                        报名邮箱：cie-info@163.com
                                    </p>
                                    <p style="margin: 8px 0px; text-align: center;">
                                        <a href="javascript:void(0);" class="blue_btn">会议合作</a>
                                    </p>
                                    <p>
                                        地址：北京市海淀区玉渊潭南路普惠<br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;南里13号楼<br />
                                        信箱：北京165信箱<br />
                                        邮编：100036
                                    </p>
                                    <p>
                                        联系人：陈枫<br />
                                        010-68229381-829/13121398779                                       
                                        <br />
                                        Chen13121398779@sina.com
                                    </p>
                                </div>
                                <div class="last"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>