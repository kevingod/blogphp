<?php

/**
*	成功的提示信息
*/
function succ($res){
	$result = 'succ';
	require(Root.'/view/admin/info.html');
	exit();//结束退出	
}

/**
*	失败的提示信息
*
**/
function error($res){
	$result = 'fail';
	require(Root.'/view/admin/info.html');
	exit(); //结束退出
}

?>