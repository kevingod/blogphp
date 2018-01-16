<?php

//导入初始化文件
require('./lib/init.php');

if (empty($_POST)) {
	
	//导入模板
	include(Root.'/view/admin/catadd.html');

}else{

	//如果post有值 取出catname
	$catname = $_POST['catname'];
	if (empty($catname)) {
		echo "栏目名称不能为空";
		//查询退出
		exit();
	}

	//连接数据库
	$conn = mConn();

	//查询是否重名
	$status = selectHaveThisCatName($catname,$conn);
	if ($status) {
		echo "该栏目已经存在";
		exit();
	}

	//添加到数据库
	$result = addCatToTable($catname,$conn);
	if ($result) {
		echo "添加栏目成功";
	}else{
		echo "添加栏目失败";		
	}
}

/**
*	添加栏目到数据库
*
*/
function addCatToTable($temp_catname,$conn)
{
	$sql = sprintf("insert into cat (catname) values ('%s') ",$temp_catname);

	////$result = mysqli_query($conn,$sql);

	$result = mQuery($sql);
	
	return $result;
}


/**
*  查询数据库中是否存在该栏目名称
*
**/
function selectHaveThisCatName($temp_catname,$conn)
{
	$sql = sprintf("select * from cat where catname = '%s';",$temp_catname);

	$rs = mQuery($sql);

	if (mysqli_num_rows($rs) > 0) {
		return true;
	}else{
		return false;
	}
}


?>


