<meta charset="utf-8">
<?php

require('./lib/init.php');

//获得所有文章列表
$art_array = getAllArt();


//显示主页
include('./view/front/index.html');



//获得所有的文章
function getAllArt(){

	$sql = sprintf("select * from art order by art_id asc ");

	$rs =  mGetAll($sql);

	return $rs;
}


?>