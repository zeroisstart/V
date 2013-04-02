<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to
	 *      '//layouts/column1',
	 *      meaning using a single column layout. See
	 *      'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link
	 *      CMenu::items}.
	 */
	public $menu = array ();
	public $is_ssl_protected = false;
	
	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this
	 *      property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link
	 *      CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public $breadcrumbs = array ();
	public function filters() {
		return array (
				array (
						'application.components.filters.RbacFilter' 
				),
				array (
						'application.components.filters.LanguageFilter' 
				),
				array (
						'application.components.filters.SiteEnableFilter' 
				),
				array (
						'application.components.filters.HttpsFilter' 
				),
				array (
						'application.components.filters.XssFilter' 
				),
				array (
						'application.components.filters.MetaTagsFilter + view' 
				),
				array (
						'application.components.filters.StatisticFilter' 
				),
				array (
						'application.components.filters.ThemeFilter' 
				),
				array (
						'application.components.filters.ReturnUrlFilter' 
				),
				array (
						'application.components.filters.JavaScriptYiiFilter' 
				),
				'accessControl' 
		);
	}
	/**
	 * get model class by controller name or false
	 * try to include it, if can't return false
	 * we can't use autoload for it, because include on non existing file throw
	 * error/warning, that shut down app
	 *
	 * @return bool string name or false
	 */
	public function getModelClass() {
		$class = ucfirst ( str_replace ( 'Admin', '', $this->id ) );
		if (! class_exists ( $class, false )) {
			@Yii::autoload ( $class );
			if (! class_exists ( $class, false )) {
				return false;
			}
		}
		return $class;
	}
	/**
	 * 字符串截取
	 * 
	 * @param String $string        	
	 * @param int $sublen        	
	 * @param int $start        	
	 * @param String $code        	
	 * @return string
	 */
	static function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
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