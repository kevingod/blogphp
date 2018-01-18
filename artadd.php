<?php


	require('./lib/init.php');


	if (empty($_POST)) {

		//查询所有的栏目 然后显示出来
		$cat_array = getAllCat();
	
		//显示界面
		include(Root.'/view/admin/artadd.html');	
	
	}else{

		//创建一篇新文章
		createNewArt();
	}

	function createNewArt(){

		//获得请求参数
		$result = $_POST;

		//title   文章标题
		//cat_id  栏目id
		//content 文章内容
		//tags    文章标签

		//print_r($result);

		$title = trim($result['title']);
		$cat_id = trim($result['cat_id']);
		$content = trim($result['content']);
		$tags = trim($result['tags']);

		if (empty($title) || mb_strlen($title) == 0	) {			
			error("文章标题不能为空");
			exit();
		}

		if (empty($cat_id) || mb_strlen($cat_id) == 0	) {			
			error("栏目不能为空");
			exit();
		}

		if (empty($content) || mb_strlen($content) == 0	) {			
			error("文章内容不能为空");
			exit();
		}

		//pubtime
		$pubtime = time();

		//操作数据库
		$sql = sprintf("insert into art (cat_id,title,content,tags,pubtime) values ('%s','%s','%s','%s','%lu')",$cat_id,$title,$content,$tags,$pubtime);
		$rs = mQuery($sql);
		if ($rs) {
			succ("发表文章成功");
		}else{
			error("发表文章失败"."\n".mysqli_error());	
		}
	}


	//获得栏目数组
	function getAllCat(){

		$sql = 'select * from cat order by cat_id asc';

		/*		$rs = mQuery($sql);

				$cat_array = array();

				//将查询出来的内容放进一个数组里
				while($row = mysqli_fetch_assoc($rs)) {
					$cat_array[] = $row;
				}*/

		$cat_array = mGetAll($sql);

		return $cat_array;		
	}


?>









