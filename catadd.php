<?php

if (empty($_POST)) {
	# code...
	include('./view/admin/catadd.html');
}else{

	//如果post有值 取出catname
	$catname = $_POST['catname'];
	if (empty($catname)) {
		# code...
		echo "栏目名称不能为空";
		exit();
	}

	//连接数据库
	$conn = mConn();

	//查询是否重名
	$status = selectHaveThisCatName($catname,$conn);
	if ($status) {
		# code...
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

	$result = mysqli_query($conn,$sql);
	
	return $result;
}


/**
*  查询数据库中是否存在该栏目名称
*
**/
function selectHaveThisCatName($temp_catname,$conn)
{
	//$txt = sprintf("There are %u million cars in %s.",$number,$str);
	//$sql = "select * from cat where catname = [$temp_catname]";

	$sql = sprintf("select * from cat where catname = '%s';",$temp_catname);
	//echo $sql;

	$rs = mysqli_query($conn,$sql);

	if (mysqli_num_rows($rs) > 0) {
		# code...
		return true;
	}else{
		return false;
	}
}


/**
*	连接数据库
*
**/
function mConn()
{
	//ip 账户 密码
	static $conn = null;
	$conn = mysqli_connect('127.0.0.1','root','');

	//使用 blog1234数据库
	mysqli_query($conn, 'use blog1234');
	mysqli_query($conn, 'set names utf8');

	return $conn;	
}

?>


