<?php

//导入初始化文件
require('./lib/init.php');

//获得参数
$result = $_GET;

if (empty($result)) {
	//echo "非法栏目，无法编辑";
	error("非法栏目，无法编辑");
	exit();
}else{

	//查询是否存在该栏目
	$conn = mConn();

	$cat_id = $result['cat_id'];
	$sql = sprintf("select * from cat where cat_id = %s ",$cat_id);
	$rs = mGetOne($sql);

	if (!$rs) {
		
		error("不存在该栏目，无法编辑");
		exit();	

	}else{


		//显示模板
		include(Root.'/view/admin/catedit.html');
	}
}


?>