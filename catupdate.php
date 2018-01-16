<?php
	
	//初始化
	require('./lib/init.php');

	if (empty($_GET)) {
		
		error("不存在该栏目，无法编辑更新");

	}else if (empty($_POST)) {
		
		error("栏目名称不能为空，无法编辑更新");

	}else{

		//获得cat_id 
		$cat_id = $_GET["cat_id"];
		$carname = $_POST["catname"];

		//sql语句
		$sql = sprintf("update cat set catname = '%s' where cat_id = '%s'",$carname,$cat_id);

		//执行语句
		if (!mQuery($sql)) {
			error("栏目更新失败");
		}else{
			succ("栏目更新成功");	
		}
	}


?>