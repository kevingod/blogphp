<?php


	require('./lib/init.php');


	//获得入库的文章列表
	$art_array = getAllArt();

	$cat_array = array();

	//格式化发布时间
	foreach ($art_array as $obj) {
		
		//格式化时间
		$pubtime = $obj['pubtime'];
		$date = date('Y/m/d H:i:s',$pubtime);

		//栏目名称
		$catname = getCatString($obj['cat_id']);
		$obj['catname'] = $catname;

		//设置值
		$temp_array = array();
		$temp_array['date'] = $date;
		$temp_array['catname'] = $catname;
		$temp_array['cat_id'] = $obj['cat_id'];
		$temp_array['art_id'] = $obj['art_id'];

		$cat_array[$obj['art_id']] = $temp_array;
	}

	//打印文章数组
	//print_r($cat_array);

	//显示模板
	include(Root.'/view/admin/artlist.html');


	//获得所有的文章数组
	function getAllArt(){

		$sql = "select * from art order by art_id asc ";

		$art_array = mGetAll($sql);

		return $art_array;
	}

	//获得对应的栏目名称
	function getCatString($cat_id){

		$sql = sprintf("select catname from cat where cat_id = '%s'",$cat_id);

		$rs = mGetOne($sql);

		if ($rs) {
		 	return $rs['catname'];
		}else{
			return '';
		}
	}

?>





