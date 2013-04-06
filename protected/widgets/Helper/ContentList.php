<?php

/**
 * 
 * @author top
 *
 */
class ContentList extends CWidget {
	public $dataProvider;
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::init()
	 */
	public function init() {
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see CWidget::run()
	 */
	public function run() {
		?>
<?php foreach($this -> dataProvider -> data as $model):?>
<?php 
	$url =  Yii::app() -> createUrl('/Home/feeds/main',array('id'=>$model -> ID));
	switch($model->category){
		case 18:
			break;
		case 19:
			break;
		case 20:
			break;
		case 21:
			break;
		case 22:
			$url = Yii::app() -> createUrl('/Home/master/main',array('id'=>$model -> ID));
			break;
		default:
			break; 
	}
	
?>
<div class="feed_list">
	<div class="feed_list_img">
		<a href="<?php echo $url?>">
			<img src="<?php echo Yii::app()->createUrl('/').'/'.$model -> photo;?>" />
		</a>
	</div>

	<div class="feed_list_content">
		<span class="feed_list_title"> 
		<a href="<?php echo $url?>">
					<?php echo $model -> title?>
		</a>
		</span>
		<p class="timeline"><?php echo $model -> create_time?></p>
		<p class="f_content">
			<a href="<?php echo $url?>" />
				<?php echo $this -> cut_str(strip_tags($model -> text),70).'...';?>
			</a>
		</p>
	</div>
</div>
<?php endforeach;?>

<div id="pager">
		<?php
		
		$this->widget ( 'CLinkPager', array (
				'header' => '',
				'firstPageLabel' => '首页',
				'lastPageLabel' => '末页',
				'prevPageLabel' => '上一页',
				'nextPageLabel' => '下一页',
				'pages' => $this->dataProvider->getPagination (),
				'maxButtonCount' => 13 
		) );
		?>
		</div>
<?php
	}
	function c_substr($str, $start = 0) {
		$ch = chr ( 127 );
		$p = array (
				"/[x81-xfe]([x81-xfe]|[x40-xfe])/",
				"/[x01-x77]/" 
		);
		$r = array (
				"",
				"" 
		);
		if (func_num_args () > 2) {
			$end = func_get_arg ( 2 );
		} else {
			$end = strlen ( $str );
		}
		
		if ($start < 0) {
			$start += $end;
		}
		
		if ($start > 0) {
			$s = substr ( $str, 0, $start );
			if ($s [strlen ( $s ) - 1] > $ch) {
				$s = preg_replace ( $p, $r, $s );
				$start += strlen ( $s );
			}
		}
		$s = substr ( $str, $start, $end );
		$end = strlen ( $s );
		if ($s [$end - 1] > $ch) {
			$s = preg_replace ( $p, $r, $s );
			$end += strlen ( $s );
		}
		return substr ( $str, $start, $end );
	}
	function substr_cut($str_cut, $length = 30) {
		if (strlen ( $str_cut ) > $length) {
			for($i = 0; $i < 128; $i ++)
				;
			$str_cut = substr ( $str_cut, 0, $i ) . "…";
		}
		return $str_cut;
	}
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
		if ($code == 'UTF-8') {
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all ( $pa, $string, $t_string );
			if (count ( $t_string [0] ) - $start > $sublen)
				return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) . "...";
			return join ( '', array_slice ( $t_string [0], $start, $sublen ) );
		} else {
			$start = $start * 2;
			$sublen = $sublen * 2;
			$strlen = strlen ( $string );
			$tmpstr = '';
			for($i = 0; $i < $strlen; $i ++) {
				if ($i >= $start && $i < ($start + $sublen)) {
					if (ord ( substr ( $string, $i, 1 ) ) > 129) {
						$tmpstr .= substr ( $string, $i, 2 );
					} else {
						$tmpstr .= substr ( $string, $i, 1 );
					}
				}
				if (ord ( substr ( $string, $i, 1 ) ) > 129)
					$i ++;
			}
			if (strlen ( $tmpstr ) < $strlen)
				$tmpstr .= "...";
			return $tmpstr;
		}
	}
}