<div id="contextAdorn"></div>
            <div id="contextBox">
                <div id="rightContent">
                    <div id="contentTop">
                        <div id="contentTopImg">
                       	 <?php $this -> widget('ext.slider.sliders',array('images'=>$img))?>
                        </div>
                        <div id="contentTopInfo">
                            <div class="title">竞赛资讯</div>
                            <ul>
                            <?php foreach($news as $_model):?>
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
                	<?php $this -> widget('widget.Helper.leftLogin');?>
                </div>
</div>