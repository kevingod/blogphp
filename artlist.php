<?php


	require('./lib/init.php');


	//获得入库的文章列表
	$art_array = getAllArt();


	//显示模板
	include(Root.'/view/admin/artlist.html');


	//获得所有的文章数组
	function getAllArt(){

		$sql = "select * from art order by art_id asc ";

		$art_array = mGetAll($sql);

		return $art_array;
	}

?>