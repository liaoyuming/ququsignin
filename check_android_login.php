<?php
	//������֤�ֻ��ͻ��˰�Ա�����빫˾�ŵ���ȷ��
	$worker_id = $_GET['worker_id'];//Ա����
	$company_id = $_GET['company_id'];//��˾��
	$mysql = new SaeMysql();
	$check_sql = "select * from worker where `worker_id`=$worker_id and `company_id`=$company_id";
	$res = $mysql->getData($check_sql);
	if($res)//�з���ֵ��ʾԱ���󶨵�Ա���ź͹�˾����ȷ��
	{
		echo "ok";
	}
	else
		echo "fail";
?>