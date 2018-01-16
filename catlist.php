<?php

//导入初始化文件
require('./lib/init.php');

//连接数据库
$conn = mConn();

//查询所有的栏目数组
$sql = 'select * from cat ';
$rs = mQuery($sql);

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

?>