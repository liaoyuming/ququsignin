<?php
class Sae_sql_model extends CI_Model
{
	var $mysql;
	var $sql;
	var $sql2;
	//���캯����  
	function __construct()
	{
		parent::__construct();
		//��ʼ��SAE��MySQL����
		$this->mysql = new SaeMysql();
	}
	
/*
*MySQL��Select��ѯ�����������Ĳ���Ϊ����data���������company_id,worker_id,start_date,end_date.
*���ط���������ȫ��ǩ�����
*/
	function select_all_sign($data)
	{	
		$company_id = $data['company_id'];
		if($data['start_date'] && $data['end_date'])
		{
			$start_date = $data['start_date'];
			$end_date = $data['end_date'];
			
		}else{
		//��û��start_time ��end_timeʱ��Ĭ��Ϊ��¼��ҳ����ʾ�����ǩ�����������start_date = end_date = today;
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}
		$start_date_timestamp = strtotime($start_date." 00:00:00");
		$end_date_timestamp = strtotime($end_date." 24:00:00");
		if($data['worker_id'])
			//�����ض�����ȫ��ǩ�����
		{
			$worker_id = $data['worker_id'];
			$this->sql="select * from worker natural join signin where company_id = '$company_id' and worker_id =	'$worker_id' order by in_date";
			$res = $this->mysql->getData($this->sql);
		}else{
			//����ȫ��ǩ�����
			$this->sql="select * from worker natural join signin where company_id = '$company_id' order by in_date";
			$res = $this->mysql->getData($this->sql);
		}
		$items = null;
		$i = 0;
		if($res)
		{
			foreach($res as $item)
			{
				//��ѡ���ض�ʱ���ڵ�Ա��ǩ����Ϣ,���ض�ʱ�����û���web��ѡ��ģ�
				if( strtotime($item['in_date']." ".$item['am_in_time'])>=$start_date_timestamp && 
						strtotime($item['in_date']." ".$item['am_in_time'])<$end_date_timestamp )
				{//��ӹ���״̬��һ�0��ʾ������1��ʾ�ٵ���2��ʾ���ˣ�3��ʾ�ٵ������ˣ���ʼ��Ϊ0
					$item['work_state'] = 0;
					$items[$i] = $item;
					$i++;
				}
			}	
		}
		
		$res = $this->select_standard_time($company_id);
		if($res)
		{
			foreach($res as $item)
			{//�õ���˾�涨�ı�׼�������°�ʱ�䣬�������°�ʱ���ʱ��������ڱȽ��ж��Ƿ�Ա���ٵ�
				$am_in_timestamp = strtotime($item['morning_in']);
				$am_out_timestamp = strtotime($item['morning_out']);
				$pm_in_timestamp = strtotime($item['afternoon_in']);
				$pm_out_timestamp = strtotime($item['afternoon_out']);
			}
		}else{
			return 0;
		}
		$i = 0;
		if(!$items)
			return 0;
		foreach($items as $sign_data)
		{
			if(strtotime($sign_data['am_in_time'])>$am_in_timestamp||
				strtotime($sign_data['pm_in_time'])>$pm_in_timestamp||
				strtotime($sign_data['am_in_time']) == strtotime('00:00:00')||
				strtotime($sign_data['pm_in_time']) == strtotime('00:00:00'))
			{//�жϳٵ�
				$sign_data['work_state'] = 1;
				$items[$i] = $sign_data;
			}
			if(strtotime($sign_data['am_out_time'])<$am_out_timestamp||
				strtotime($sign_data['pm_out_time'])<$pm_out_timestamp)
			{//�ж�����
				if($sign_data['work_state'] == 1)
				{
					$sign_data['work_state'] = 3;
				}else{
					$sign_data['work_state'] = 2;
				}		
				$items[$i] = $sign_data;
			}
			$i++;
		}
		return $items;
	}	

	//ע���˺�
	function handle_register($company_email,$company_password,$regtime,$activation,$activation_time)
	{
		$this->sql = "select company_email from company where company_email = '$company_email'";
		$res = $this->mysql->getVar($this->sql);
		if($res)
			return 0;
		$this->sql2 = "insert into app_ququsignin.company (company_email,company_password,register_time,activation,activation_time,status) value ('$company_email', '$company_password', '$regtime', '$activation', '$activation_time',0)";
		return $this->mysql->runSql($this->sql2);
	}

	//�˺ż����֤������
	function check_activation($activation)
	{
		$this->sql="select company_id, activation_time,company_email from company where activation = '$activation' and status = 0";
		$res = $this->mysql->getLine($this->sql);
		return $res;
	}
	
	function checkEmail($company_email)
	{
		$this->sql = "select company_email from company where company_email = '$company_email'";
		$res = $this->mysql->getVar($this->sql);
		return $res;
	}
	
	
	//�˺ż�����¼���״̬
	function handle_activation($company_id)
	{
		$this->sql = "update company set status = 1 where company_id = '$company_id'";
		return $this->mysql->runSql($this->sql);
	}
	
	function get_company_id($company_email)
	{
		$this->sql = "select company_id from company where company_email = '$company_email'";
		return $this->mysql->getVar($this->sql);
	}
	
	function get_company_name($company_id)
	{
		$this->sql = "select company_name from company where company_id = '$company_id'";
		return $this->mysql->getVar($this->sql);
	}
	
/*
*MySQL��Select��ѯ�����������Ĳ���Ϊ��˾id��
*���ذ�����˾�涨�ı�׼�������°�ʱ�䣬�������°�ʱ�������
*/
	 function select_standard_time($company_id)
	 {
			$this->sql = "select * from time_standard where company_id = '$company_id'";
			$res = $this->mysql->getData($this->sql);
			return $res;
	 }
	 
/*
*MySQL��Select��ѯ�����������Ĳ���ΪԱ��������
*����Ա��id������
*/	 
	function get_worker_id($worker_name)
	{
		$this->sql = "select worker_id from worker where woker_name = '$worker_name'";
		$res = $this->mysql->getData($this->sql);
		return $res;
	}
	
/*
*MySQL��Select��ѯ�����������Ĳ���Ϊ��˾id��
*���ذ�����˾id����˾���ƣ���˾����������°�ʱ�������
*/	
	function get_company_info($company_id)
	{
		$this->sql = "select * from company natural join time_standard where company_id = '$company_id'";
		$res = $this->mysql->getData($this->sql);
		return $res;
	}
	
	
/*
*���ù�˾��Ϣ�������Ĳ���Ϊ������˾id����˾���ƣ���˾����������°�ʱ������顣
*���سɹ���ʧ�ܡ�
*/	
	function set_company_info($company_info)
	{
		$company_name = $company_info['company_name'];
		$company_id = $company_info['company_id'];
		$morning_in = $company_info['morning_in'];
		$afternoon_in = $company_info['afternoon_in'];
		$morning_out = $company_info['morning_out'];
		$afternoon_out = $company_info['afternoon_out'];
		$this->sql = "UPDATE company set company_name = '$company_name' where company_id = '$company_id'";
		$res = $this->mysql->runSql($this->sql);
		$this->sql = "select * from time_standard where company_id = '$company_id'";
		$data = $this->mysql->getData($this->sql);
		if($data)
		{
			$this->sql = "update time_standard set morning_in='$morning_in', afternoon_in='$afternoon_in', morning_out='$morning_out', afternoon_out='$afternoon_out'where company_id = '$company_id'";
		}else{
			$this->sql = "INSERT INTO `app_ququsignin`.`time_standard` (`standard_id`, `company_id`, `morning_in`, `morning_out`, `afternoon_in`, `afternoon_out`) VALUES (NULL, '$company_id','$morning_in','$morning_out','$afternoon_in','$afternoon_out')";
		}
		$result = $this->mysql->runSql($this->sql);
		if(!$result||!$res)
			return 0;
		else
			return 1;
	}
}
	 
?>