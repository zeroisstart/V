<div id="contextAdorn"></div>
<div id="contextBox">
	<div id="rightContent" class="user_profile_info">
		<?php $this -> widget('widget.Helper.ContentList',array('dataProvider'=>$dataProvider));?>
	</div>
	<div id="leftColumns">
		<?php $this -> widget('widget.Helper.GallerySecNav');?>
    </div>
</div>