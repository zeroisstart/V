<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent">
		<?php #$this -> widget('widget.Helper.ContentList',array('dataProvider'=>$dataProvider));?>
		<div class="companyq_content">
			<?php echo $current_model -> text;?>
		</div>
    </div>
	<div id="leftColumns" class="company_q">
		<ul>
        		<?php foreach($titles as $key => $val):?>
        			
        				<?php if($current_model -> ID == $val['ID']):?>
        					<li class="active_q">
        					<?php echo CHtml::link($val['title'],$this -> createUrl('/Home/companyq/main',array('id'=>$val['ID'])))?>
        				<?php else:?>
        				<li>
        					<?php echo CHtml::link($val['title'],$this -> createUrl('/Home/companyq/main',array('id'=>$val['ID'])))?>
        				<?php endif;?>
      						</li>  			
        		<?php endforeach;?>
        	</ul>
	</div>
</div>