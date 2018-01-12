<?php

$result = $_GET;

if (empty($result)) {
	echo "非法栏目，无法编辑";
}

//查询是否存在该栏目
$conn = mConn();

$cat_id = $result['cat_id'];
$sql = sprintf("select * from cat where cat_id = '%s'",$cat_id);
$rs = mysqli_query($conn,$sql);

if (mysqli_num_rows($rs) == 0)) {
	echo "不存在该栏目，无法编辑";
}

//获得结果
$result = mysql_fetch_array($rs)[0];
var_dump($result);

/*
	连接数据库
*/
function mConn()
{
	static $conn = null;
	$conn = mysqli_connect('127.0.0.1','root','');

	mysqli_query($conn,'use blog1234');
	mysqli_query($conn,'set names utf8');

	return $conn;
}


?>