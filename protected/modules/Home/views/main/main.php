<?php 
$this -> registerPopupBox();
?>

<div id="contextAdorn"></div>
            <div id="contextBox">
                <div id="rightContent">
                    <div id="contentTop">
                        <div id="contentTopImg">
                       	 <?php $this -> widget('ext.slider.sliders',array('images'=>$img))?>
                        </div>
                    </div>
                    
                    <div class="contentBlock competition">
                            <div class="title titleBar">竞赛资讯</div>
                            <div class="contentBox">
                            <ul class="competition_left">
                            <?php foreach($left as $_model):?>
                            	<li>
                            		<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>" title="<?php echo $_model -> title;?>">
                            			<?php echo mb_substr($_model -> title,0,60);?>
                            		</a>
                            	</li>
                            <?php endforeach;?>
                            </ul>
                            
                            <ul class="competition_right">
                            <?php foreach($right as $_model):?>
                            	<li>
                            		<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>">
                            		<?php echo $_model -> title;?>
                            		</a>
                            	</li>
                            <?php endforeach;?>
                            </ul>
                            </div>
                    </div>

                    <div class="contentBlock">
                        <div class="title titleBar">承办院校</div>
                        <div class="contentBox"></div>
                    </div>
					
					 <div class="contentBlock">
					 	<div class="title titleBar">优秀作品展示</div>
                        <div class="contentBox"></div>
                    </div>
					
					 <div class="contentBlock">
					 	<div class="title titleBar">合作伙伴</div>
                        <div class="contentBox"></div>
                    </div>
					
                </div>
                <div id="leftColumns">
                	<?php $this -> widget('widget.Helper.leftLogin');?>
                </div>
</div>