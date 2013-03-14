<?php
/**
 * @author dufei22 <dufei22@gmail.com>
 * 改自CGridView增加了可以选择每页显示条数，但是由于DWZ目前表头有两行就会出错，所以过滤器被禁用了。
 * 要使用全功能的暂时请先使用DwzGridView，DwzGridView只是在CGridView的基础上把翻页栏固定住。
 * 还有排序暂时没有做，等以后一起再做。其实就是将yii的发送改成dwz的方式应该就行，和翻页一样需要修改js文件。
 * 使用方法和参数同CGridView，但是由于DWZ固定为POST发送翻页而yii固定以GET获取，
 * 所以需要在DataProvider处加上如下配置，这些配置不会影响其他组件使用这个DataProvider
 * 
		$pager=array();
		if (isset($_REQUEST['pageNum'])){
			isset($_REQUEST['numPerPage'])? $pageSize=(int)$_REQUEST['numPerPage']: $pageSize=10;
			$currentPage=(int)$_REQUEST['pageNum']-1;
			$pager=array(
				'pageSize'=>$pageSize,
				'currentPage'=>$currentPage,
			);
		}
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=>$pager,
		));
 * 
 * 
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2010 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

Yii::import('zii.widgets.CBaseListView');
Yii::import('zii.widgets.grid.CDataColumn');
Yii::import('zii.widgets.grid.CLinkColumn');
Yii::import('zii.widgets.grid.CButtonColumn');
Yii::import('zii.widgets.grid.CCheckBoxColumn');

/**
 * CGridView displays a list of data items in terms of a table.
 *
 * Each row of the table represents the data of a single data item, and a column usually represents
 * an attribute of the item (some columns may correspond to complex expression of attributes or static text).
 *
 * CGridView supports both sorting and pagination of the data items. The sorting
 * and pagination can be done in AJAX mode or normal page request. A benefit of using CGridView is that
 * when the user browser disables JavaScript, the sorting and pagination automatically degenerate
 * to normal page requests and are still functioning as expected.
 *
 * CGridView should be used together with a {@link IDataProvider data provider}, preferrably a
 * {@link CActiveDataProvider}.
 *
 * The minimal code needed to use CGridView is as follows:
 *
 * <pre>
 * $dataProvider=new CActiveDataProvider('Post');
 *
 * $this->widget('zii.widgets.grid.CGridView', array(
 *     'dataProvider'=>$dataProvider,
 * ));
 * </pre>
 *
 * The above code first creates a data provider for the <code>Post</code> ActiveRecord class.
 * It then uses CGridView to display every attribute in every <code>Post</code> instance.
 * The displayed table is equiped with sorting and pagination functionality.
 *
 * In order to selectively display attributes with different formats, we may configure the
 * {@link CGridView::columns} property. For example, we may specify only the <code>title</code>
 * and <code>create_time</code> attributes to be displayed, and the <code>create_time</code>
 * should be properly formatted to show as a time. We may also display the attributes of the related
 * objects using the dot-syntax as shown below:
 *
 * <pre>
	$this->widget('ext.dwz.DwzGrid', array(
		'id'=>'tm-type-grid',
		'dataProvider'=>$model->search(),
		'columns'=>array(
			'id',
			'type',
			'groupId',
			'sn',
			array(
				'name'=>'name',
				'headerHtmlOptions'=>array('style'=>'width:80px'),
				),
			array(
				'name'=>'content',
				'headerHtmlOptions'=>array('style'=>'width:320px'),
			),
			array(
				'class'=>'CButtonColumn',
				'header'=>'操作',
			),
		),
	));
 * </pre>
 *
 * Please refer to {@link columns} for more details about how to configure this property.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CGridView.php 190 2010-06-17 16:08:28Z qiang.xue $
 * @package zii.widgets.grid
 * @since 1.1
 */
class DwzGrid extends CBaseListView
{
	const FILTER_POS_HEADER='header';
	const FILTER_POS_FOOTER='footer';
	const FILTER_POS_BODY='body';

	private $_formatter;
	/**
	 * @var array grid column configuration. Each array element represents the configuration
	 * for one particular grid column which can be either a string or an array.
	 *
	 * When a column is specified as a string, it should be in the format of "name:type:header",
	 * where "type" and "header" are optional. A {@link CDataColumn} instance will be created in this case,
	 * whose {@link CDataColumn::name}, {@link CDataColumn::type} and {@link CDataColumn::header}
	 * properties will be initialized accordingly.
	 *
	 * When a column is specified as an array, it will be used to create a grid column instance, where
	 * the 'class' element specifies the column class name (defaults to {@link CDataColumn} if absent).
	 * Currently, these official column classes are provided: {@link CDataColumn},
	 * {@link CLinkColumn}, {@link CButtonColumn} and {@link CCheckBoxColumn}.
	 */
	public $columns=array();
	/**
	 * @var array the CSS class names for the table body rows. If multiple CSS class names are given,
	 * they will be assigned to the rows sequentially and repeatedly. This property is ignored
	 * if {@link rowCssClassExpression} is set. Defaults to <code>array('odd', 'even')</code>.
	 * @see rowCssClassExpression
	 */
	public $rowCssClass=array('odd','even');
	/**
	 * @var string a PHP expression that is evaluated for every table body row and whose result
	 * is used as the CSS class name for the row. In this expression, the variable <code>$row</code>
	 * stands for the row number (zero-based), <code>$data</code> is the data model associated with
	 * the row, and <code>$this</code> is the grid object.
	 * @see rowCssClass
	 */
	public $rowCssClassExpression;
	/**
	 * @var boolean whether to display the table even when there is no data. Defaults to true.
	 * The {@link emptyText} will be displayed to indicate there is no data.
	 */
	public $showTableOnEmpty=true;
	/**
	 * @var mixed the ID of the container whose content may be updated with an AJAX response.
	 * Defaults to null, meaning the container for this grid view instance.
	 * If it is set false, it means sorting and pagination will be performed in normal page requests
	 * instead of AJAX requests. If the sorting and pagination should trigger the update of multiple
	 * containers' content in AJAX fashion, these container IDs may be listed here (separated with comma).
	 */
	public $ajaxUpdate;
	/**
	 * @var string the name of the GET variable that indicates the request is an AJAX request triggered
	 * by this widget. Defaults to 'ajax'. This is effective only when {@link ajaxUpdate} is not false.
	 */
	public $ajaxVar='ajax';
	/**
	 * @var string a javascript function that will be invoked before an AJAX update occurs.
	 * The function signature is <code>function(id)</code> where 'id' refers to the ID of the grid view.
	 */
	public $beforeAjaxUpdate;
	/**
	 * @var string a javascript function that will be invoked after a successful AJAX response is received.
	 * The function signature is <code>function(id, data)</code> where 'id' refers to the ID of the grid view
	 * 'data' the received ajax response data.
	 */
	public $afterAjaxUpdate= 'fixUI';
	/**
	 * @var string a javascript function that will be invoked after the row selection is changed.
	 * The function signature is <code>function(id)</code> where 'id' refers to the ID of the grid view.
	 * In this function, you may use <code>$.fn.yiiGridView.getSelection(id)</code> to get the key values
	 * of the currently selected rows.
	 * @see selectableRows
	 */
	public $selectionChanged;
	/**
	 * @var integer the number of table body rows that can be selected. If 0, it means rows cannot be selected.
	 * If 1, only one row can be selected. If 2 or any other number, it means multiple rows can be selected.
	 * A selected row will have a CSS class named 'selected'. You may also call the JavaScript function
	 * <code>$.fn.yiiGridView.getSelection(containerID)</code> to retrieve the key values of the selected rows.
	 */
	public $selectableRows=1;
	/**
	 * @var string the base script URL for all grid view resources (e.g. javascript, CSS file, images).
	 * Defaults to null, meaning using the integrated grid view resources (which are published as assets).
	 */
	public $baseScriptUrl;
	/**
	 * @var string the URL of the CSS file used by this grid view. Defaults to null, meaning using the integrated
	 * CSS file. If this is set false, you are responsible to explicitly include the necessary CSS file in your page.
	 */
	public $cssFile;
	/**
	 * @var string the text to be displayed in a data cell when a data value is null. This property will NOT be HTML-encoded
	 * when rendering. Defaults to an HTML blank.
	 */
	public $nullDisplay='&nbsp;';
	/**
	 * @var string the CSS class name that will be assigned to the widget container element
	 * when the widget is updating its content via AJAX. Defaults to 'grid-view-loading'.
	 * @since 1.1.1
	 */
	public $loadingCssClass='grid-view-loading';
	/**
	 * @var string the CSS class name for the table row element containing all filter input fields. Defaults to 'filters'.
	 * @see filter
	 * @since 1.1.1
	 */
	public $filterCssClass='filters';
	/**
	 * @var string whether the filters should be displayed in the grid view. Valid values include:
	 * <ul>
	 *    <li>header: the filters will be displayed on top of each column's header cell.</li>
	 *    <li>body: the filters will be displayed right below each column's header cell.</li>
	 *    <li>footer: the filters will be displayed below each column's footer cell.</li>
	 * </ul>
	 * @see filter
	 * @since 1.1.1
	 */
	public $filterPosition='body';
	/**
	 * @var CModel the model instance that keeps the user-entered filter data. When this property is set,
	 * the grid view will enable column-based filtering. Each data column by default will display a text field
	 * at the top that users can fill in to filter the data.
	 * @since 1.1.1
	 */
	public $filter;
	/**
	 * @var boolean whether to hide the header cells of the grid. When this is true, header cells
	 * will not be rendered, which means the grid cannot be sorted anymore since the sort links are located
	 * in the header. Defaults to false.
	 * @since 1.1.1
	 */
	public $hideHeader=false;
	//默认在dialog中打开
	public $buttonTarget='dialog';
	public $tableHtmlOptions=array('class'=>'table','layoutH'=>48);
	public $pager=array('class'=>'ext.dwz.DwzPager');
	public $pagerCssClass='panelBar';
	public $template="{items}\n{pager}";
//	public $htmlOption=array('layoutH'=>'48');
	/**
	 * Initializes the grid view.
	 * This method will initialize required property values and instantiate {@link columns} objects.
	 */
	public function init()
	{
		parent::init();

		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='pageContent grid-view';

		if($this->baseScriptUrl===null)
			$this->baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview';

		if($this->cssFile!==false)
		{
			if($this->cssFile===null)
				$this->cssFile=$this->baseScriptUrl.'/styles.css';
			Yii::app()->getClientScript()->registerCssFile($this->cssFile);
		}

		$this->initColumns();
	}
/**/
	public function run()
	{
		$this->registerClientScript();
		
		echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
		$this->renderKeys();
//		echo '<div class="pageContent" layoutH="26">';
		$this->renderContent();

		echo CHtml::closeTag($this->tagName);
	}

	/**/
	public function renderPager() {
//		echo '</div><div class="panelBar">';
		parent::renderPager();
//		echo '</div>';
	}
	/**
	 * Creates column objects and initializes them.
	 */
	protected function initColumns()
	{
		if($this->columns===array())
		{
			if($this->dataProvider instanceof CActiveDataProvider)
				$this->columns=$this->dataProvider->model->attributeNames();
			else if($this->dataProvider instanceof IDataProvider)
			{
				// use the keys of the first row of data as the default columns
				$data=$this->dataProvider->getData();
				if(isset($data[0]) && is_array($data[0]))
					$this->columns=array_keys($data[0]);
			}
		}
		$id=$this->getId();
		foreach($this->columns as $i=>$column)
		{
			if(is_string($column))
				$column=$this->createDataColumn($column);
			else
			{
				if(!isset($column['class']))
					$column['class']='CDataColumn';
				if ($column['class']== 'CButtonColumn'){
					if (!isset($column['headerHtmlOptions']['style']))
						$column['headerHtmlOptions']=array('style'=>'width:50px');
					if (!isset($column['viewButtonOptions']['target']))
						$column['viewButtonOptions']=array('target'=>$this->buttonTarget,'rel'=>'view');
					if (!isset($column['updateButtonOptions']['target']))
						$column['updateButtonOptions']=array('target'=>$this->buttonTarget,'rel'=>'edit');
				}
				if ($column['class']== 'CLinkColumn'){
					if (!isset($column['linkHtmlOptions']['target']))
						$column['linkHtmlOptions']=array('target'=>$this->buttonTarget);
				}
				$column=Yii::createComponent($column, $this);
			}
			if(!$column->visible)
			{
				unset($this->columns[$i]);
				continue;
			}
			if($column->id===null)
				$column->id=$id.'_c'.$i;
			$this->columns[$i]=$column;
		}

		foreach($this->columns as $column)
			$column->init();
	}

	/**
	 * Creates a {@link CDataColumn} based on a shortcut column specification string.
	 * @param string the column specification string
	 * @return CDataColumn the column instance
	 */
	protected function createDataColumn($text)
	{
		if(!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/',$text,$matches))
			throw new CException(Yii::t('zii','The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));
		$column=new CDataColumn($this);
		$column->name=$matches[1];
		if(isset($matches[3]))
			$column->type=$matches[3];
		if(isset($matches[5]))
			$column->header=$matches[5];
		return $column;
	}

	/**
	 * Registers necessary client scripts.
	 */
	public function registerClientScript()
	{
		$id=$this->getId();

		if($this->ajaxUpdate===false)
			$ajaxUpdate=false;
		else
			$ajaxUpdate=array_unique(preg_split('/\s*,\s*/',$this->ajaxUpdate.','.$id,-1,PREG_SPLIT_NO_EMPTY));
		$options=array(
			'ajaxUpdate'=>$ajaxUpdate,
			'ajaxVar'=>$this->ajaxVar,
			'pagerClass'=>$this->pagerCssClass,
			'loadingClass'=>$this->loadingCssClass,
			'filterClass'=>$this->filterCssClass,
			'tableClass'=>$this->itemsCssClass,
			'selectableRows'=>$this->selectableRows,
		);
		if($this->beforeAjaxUpdate!==null)
			$options['beforeAjaxUpdate']=(strpos($this->beforeAjaxUpdate,'js:')!==0 ? 'js:' : '').$this->beforeAjaxUpdate;
		if($this->afterAjaxUpdate!==null)
			$options['afterAjaxUpdate']=(strpos($this->afterAjaxUpdate,'js:')!==0 ? 'js:' : '').$this->afterAjaxUpdate;
		if($this->selectionChanged!==null)
			$options['selectionChanged']=(strpos($this->selectionChanged,'js:')!==0 ? 'js:' : '').$this->selectionChanged;

		$options=CJavaScript::encode($options);
		$cs=Yii::app()->getClientScript();
//		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('bbq');
		$cs->registerScriptFile(CHtml::asset(Yii::getPathOfAlias('ext.dwz.source.js').'/jquery.dwzgridview.js'));
		$cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').yiiGridView($options);");
		$cs->registerScript('fixUI',"function fixUI(){initLayout();initUI(navTab.getCurrentPanel());}");
//		if ($this->pager['class']==null || $this->pager['class']=='CLinkPager')
//			$cs->registerCss('fixPage',"li.page, .grid-view .panelBar li{float:none;}");
	}

	/**
	 * Renders the data items for the grid view.
	 */
	public function renderItems()
	{
		if($this->dataProvider->getItemCount()>0 || $this->showTableOnEmpty)
		{
			echo CHtml::openTag('table', $this->tableHtmlOptions);
			$this->renderTableHeader();
			$this->renderTableFooter();
			$this->renderTableBody();
			echo CHtml::closeTag('table');
		}
		else
			$this->renderEmptyText();
	}

	/**
	 * Renders the table header.
	 */
	public function renderTableHeader()
	{
		if(!$this->hideHeader)
		{
			echo "<thead>\n";

			if($this->filterPosition===self::FILTER_POS_HEADER)
				$this->renderFilter();

			echo "<tr>\n";
			foreach($this->columns as $column){
//加上这两行不排序表格了
				if (isset($column->sortable))
					$column->sortable=false;
				$column->renderHeaderCell();
			}
			echo "</tr>\n";

			if($this->filterPosition===self::FILTER_POS_BODY)
				$this->renderFilter();

			echo "</thead>\n";
		}
		else if($this->filter!==null && ($this->filterPosition===self::FILTER_POS_HEADER || $this->filterPosition===self::FILTER_POS_BODY))
		{
			echo "<thead>\n";
			$this->renderFilter();
			echo "</thead>\n";
		}
	}

	/**
	 * Renders the filter.
	 * @since 1.1.1
	 */
	public function renderFilter()
	{
		if($this->filter!==null)
		{
//暂时注释这里不用过滤
//			echo "<tr class=\"{$this->filterCssClass}\">\n";
//			foreach($this->columns as $column)
//				$column->renderFilterCell();
//			echo "</tr>\n";
		}
	}

	/**
	 * Renders the table footer.
	 */
	public function renderTableFooter()
	{
		$hasFilter=$this->filter!==null && $this->filterPosition===self::FILTER_POS_FOOTER;
		$hasFooter=$this->getHasFooter();
		if($hasFilter || $hasFooter)
		{
			echo "<tfoot>\n";
			if($hasFooter)
			{
				echo "<tr>\n";
				foreach($this->columns as $column)
					$column->renderFooterCell();
				echo "</tr>\n";
			}
			if($hasFilter)
				$this->renderFilter();
			echo "</tfoot>\n";
		}
	}

	/**
	 * Renders the table body.
	 */
	public function renderTableBody()
	{
		$data=$this->dataProvider->getData();
		$n=count($data);
		echo "<tbody>\n";

		if($n>0)
		{
			for($row=0;$row<$n;++$row)
				$this->renderTableRow($row);
		}
		else
		{
			echo '<tr><td colspan="'.count($this->columns).'">';
			$this->renderEmptyText();
			echo "</td></tr>\n";
		}
		echo "</tbody>\n";
	}

	/**
	 * Renders a table body row.
	 * @param integer the row number (zero-based).
	 */
	public function renderTableRow($row)
	{
//去掉这里不需要单双行类了
//		if($this->rowCssClassExpression!==null)
//		{
//			$data=$this->dataProvider->data[$row];
//			echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
//		}
//		else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
//			echo '<tr class="'.$this->rowCssClass[$row%$n].'">';
//		else
			echo '<tr style="">';
		foreach($this->columns as $column)
			$column->renderDataCell($row);
		echo "</tr>\n";
	}

	/**
	 * @return boolean whether the table should render a footer.
	 * This is true if any of the {@link columns} has a true {@link CGridColumn::hasFooter} value.
	 */
	public function getHasFooter()
	{
		foreach($this->columns as $column)
			if($column->getHasFooter())
				return true;
		return false;
	}

	/**
	 * @return CFormatter the formatter instance. Defaults to the 'format' application component.
	 */
	public function getFormatter()
	{
		if($this->_formatter===null)
			$this->_formatter=Yii::app()->format;
		return $this->_formatter;
	}

	/**
	 * @param CFormatter the formatter instance
	 */
	public function setFormatter($value)
	{
		$this->_formatter=$value;
	}
}
