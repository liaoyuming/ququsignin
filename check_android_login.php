<?php
	//用于验证手机客户端绑定员工号与公司号的正确性
	$worker_id = $_GET['worker_id'];//员工号
	$company_id = $_GET['company_id'];//公司号
	$mysql = new SaeMysql();
	$check_sql = "select * from worker where `worker_id`=$worker_id and `company_id`=$company_id";
	$res = $mysql->getData($check_sql);
	if($res)//有返回值表示员工绑定的员工号和公司号正确；
	{
		echo "ok";
	}
	else
		echo "fail";
?>