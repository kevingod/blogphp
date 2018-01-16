<?php

require('./lib/init.php');

if (empty($_GET)) {
	
		echo "非法操作";

}else{

		//获得参数
		$result = $_GET;

		//cat_id
		$cat_id = $result['cat_id'];

		//连接数据库
		$conn = mConn();
		$sql = sprintf("delete from cat where cat_id = %s",$cat_id);

		//执行sql
		$status = mQuery($sql);

		if ($status) {
			echo "删除栏目成功";
		}else{
			echo "删除栏目失败";
		}
}



?>