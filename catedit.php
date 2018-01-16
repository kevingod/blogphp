<?php

//导入初始化文件
require('./lib/init.php');

//获得参数
$result = $_GET;

if (empty($result)) {
	echo "非法栏目，无法编辑";
	exit();
}else{

		//查询是否存在该栏目
	$conn = mConn();

	$cat_id = $result['cat_id'];
	$sql = sprintf("select * from cat where cat_id = '%s'",$cat_id);
	$rs = mQuery($sql);

	if (mysqli_num_rows($rs) == 0) {
		echo "不存在该栏目，无法编辑";
		exit();
	}

	//获得结果
	$result = mysqli_fetch_array($rs)[0];
	var_dump($result);
}


?>