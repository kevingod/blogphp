<?php

$result = $_GET;
//var_dump($result);

//cat_id
$cat_id = $result['cat_id'];

//连接数据库
$conn = mConn();
$sql = sprintf("delete from cat where cat_id = %s",$cat_id);

//执行sql
$status = mysqli_query($conn,$sql);
if ($status) {
	echo "删除栏目成功";
}else{
	echo "删除栏目失败";
}



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