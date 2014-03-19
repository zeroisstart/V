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
                            <?php foreach($news['19']['left'] as $_model):?>
                            	<li>
                            		<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>" title="<?php echo $_model -> title;?>">
                            			<?php echo mb_substr($_model -> title,0,60);?>
                            		</a>
                            	</li>
                            <?php endforeach;?>
                            </ul>
                            
                            <ul class="competition_right">
                            <?php foreach($news['19']['right']  as $_model):?>
                            	<li>
                            		<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>">
                            		<?php echo $_model -> title;?>
                            		</a>
                            	</li>
                            <?php endforeach;?>
                            </ul>
                            </div>
                    </div>

                    <div class="contentBlock schoolblock">
                        <div class="title titleBar">承办院校</div>
                        <div class="contentBox school_box">
                        	<ul class="school">
	                        	<?php foreach($news['11'] as $_model):?>
	                        		<li>
	                        			<img src="<?php echo $_model -> photo?>" />
	                        			<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>">
	                        				<?php echo $_model ->title ?>
	                        			</a>
	                        		</li>
	                        	<?php endforeach;?>
                            </ul>
                        </div>
                    </div>
					
					 <div class="contentBlock schoolblock">
					 	<div class="title titleBar">优秀作品展示</div>
                        <div class="contentBox school_box">
                        <ul class="school">
                        
                          <?php foreach($news['12'] as $_model):?>
                          		<li>
                          			<img src="<?php echo $_model -> photo?>" />
                            		<a href="<?php echo $this -> createUrl('/Home/feeds/main',array('id'=>$_model -> ID))?>" title="<?php echo $_model -> title;?>">
                            			<?php echo mb_substr($_model -> title,0,18,'utf-8').'...';?>
                            		</a>
                            	</li>
                          <?php endforeach;?>
                        </div>
                    </div>
					
					 <div class="contentBlock competition">
					 	<div class="title titleBar">合作伙伴</div>
                        <div class="contentBox">
                        <ul class="competition_logo">
                        		<li>
                            		<a href="http://www.huawei.com/cn/" target="_blank" title="">
                            			<img src="/images/logo/huawei.jpg"  />
                            		</a>
                            	</li>
                            	
                            	<li>
                            		<a href="http://www.altera.com.cn" target="_blank" title="">
                            			<img src="/images/logo/altera.jpg"  />
                            		</a>
                            	</li>
                            	
                            	
                            	<li>
                            		<a href="http://www.ansys.com.cn" target="_blank" title="">
                            			<img src="/images/logo/ansys.jpg"  />
                            		</a>
                            	</li>
                            	
                            	<li>
                            		<a href="http://www.arm.com" target="_blank" title="">
                            			<img src="/images/logo/ar.jpg"  />
                            		</a>
                            	</li>
                            	
                            	
                            	<li>
                            		<a href="http://www.synopsys.com" target="_blank" title="">
                            			<img src="/images/logo/synopsis.jpg"  />
                            		</a>
                            	</li>
                            	
                            	<li>
                            		<a href="http://www.mxchip.com/" target="_blank" title="">
                            			<img src="/images/logo/qinke.jpg"  />
                            		</a>
                            	</li>
                            	
                            </ul>
                        </div>
                    </div>
					
                </div>
                <div id="leftColumns">
                	<?php $this -> widget('widget.Helper.leftLogin');?>
                </div>
</div>