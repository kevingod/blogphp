<?php

//连接数据库
static $conn = null;
$conn = mConn();

//查询所有的栏目数组
$sql = 'select * from cat ';
$rs = mysqli_query($conn,$sql);

if (!$rs) {
	echo "查询栏目失败";
	exit();
}

//栏目数组
$cat_array = array();

//将查询出来的内容放进一个数组里
while($row = mysqli_fetch_assoc($rs)) {
	$cat_array[] = $row;
}


//先查询出栏目列表 然后再显示html
include('./view/admin/catlist.html');


/**
*	连接数据库
*	
**/
function mConn()
{
	//连接数据库
	static $conn = null;
	$conn = mysqli_connect('127.0.0.1','root','');

	//使用数据库
	mysqli_query($conn,'use blog1234');
	mysqli_query($conn,'set names utf8');	

	return $conn;
}


?>