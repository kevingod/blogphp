<?php

//导入配置文件
require(Root.'/lib/config.php');

/*
*	连接数据库
*
*	连接成功，返回数据库的资源
*/
function mConn(){

	//感觉相当于是懒加载 单例
	static $conn = null;
	if ($conn == null) {

		//获得配置数组
		$config = config_array();

		//连接
		$conn = mysqli_connect($config['host'], $config['user'], $config['pwd']);
		mysqli_query($conn,'use '.$config['db']);
		mysqli_query($conn,'set names '.$config['charset']);	
	}

	return $conn;
}


/**
*	查询函数 更新数据库方法
*	
* 	return resoure/bool 返回资源或者bool
**/
function mQuery($sql){

	$rs = mysqli_query(mConn(),$sql);

	if ($rs) {
		//记录日志
		mLog($sql);
	}else{
		//记录日志
		mLog($sql."\n".mysqli_error());
	}

	return $rs;
}

/**
*	log日志记录功能
*I
*	
***/
function mLog($str){

	//log文件夹里面txt文件
	$filename = Root.'/log/'.date('Ymd').'.txt';
	$log = "----------------------------------------------------------------\n";
	$log .= date('Y/m/d H:i:s')."\n";
	$log .= $str;
	$log .= "\n"."----------------------------------------------------------------\n\n\n";

	//追加写入文本系统
	return file_put_contents($filename, $log, FILE_APPEND);
}

/**
*	select 查询多行数据
*	
* 	sql 待查询语句
*   return 查询成功 返回二维关联数组 , 失败返回false
***/
function mGetAll($sql){

	$rs = mQuery($sql);
	if (!$rs) {
		return false;
	}

	$data = array();
	while ($row = mysqli_fectch_assoc($rs)){	
		$data[] = $row;
	}

	return $data;
}

/*
*	select 查询返回一个结果
*
* 	sql 待查询语句
*	成功 返回结果 失败 返回false
**/
function mGetOne($sql){

	$rs = mQuery($sql);
	if (!$rs) {
		return false;
	}

	//获得结果
	$row = mysqli_fetch_assoc($rs);

	return 	$row;
}

/*$sql = "select count(*) from art where cat_id=1";
echo mGetOne($sql);*/
/**
* 自动拼接insert 和 update sql语句,并且调用mQuery() 去执行sql
*
* @param str $table 表名
* @param arr $data 接收到的数据,一维数组
* @param str $act 动作 默认为'insert'
* @param str $where 防止update更改时少加where条件
* @return bool insert 或者update 插入成功或失败 
*/

function mExec($table , $data , $act='insert' , $where=0) {

	if($act == 'insert') {
		$sql = "insert into $table (";
		$sql .= implode(',' , array_keys($data)) . ") values ('";
		$sql .= implode("','" , array_values($data)) . "')";
		return mQuery($sql);
	} else if ($act == 'update') {
		$sql = "update $table set ";
		foreach($data as $k=>$v) {
			$sql .= $k . "='" . $v . "',";
		}

		$sql = rtrim($sql , ',') . " where ".$where;
		return mQuery($sql);
	}
}

/**
* 取得上一步insert 操作产生的主键id
*/
function getLastId() {

	return mysql_insert_id(mConn());
}


?>









