<?php
class Sae_sql_model extends CI_Model
{
	var $mysql;
	var $sql;
	var $sql2;
	//构造函数；  
	function __construct()
	{
		parent::__construct();
		//初始化SAE的MySQL对象
		$this->mysql = new SaeMysql();
	}
	
/*
*MySQL的Select查询函数，函数的参数为数组data，数组包含company_id,worker_id,start_date,end_date.
*返回符合条件的全部签到情况
*/
	function select_all_sign($data)
	{	
		$company_id = $data['company_id'];
		if($data['start_date'] && $data['end_date'])
		{
			$start_date = $data['start_date'];
			$end_date = $data['end_date'];
			
		}else{
		//当没有start_time 和end_time时，默认为登录主页，显示今天的签到情况。所以start_date = end_date = today;
			$start_date = date('Y-m-d');
			$end_date = date('Y-m-d');
		}
		$start_date_timestamp = strtotime($start_date." 00:00:00");
		$end_date_timestamp = strtotime($end_date." 24:00:00");
		if($data['worker_id'])
			//搜索特定个人全部签到情况
		{
			$worker_id = $data['worker_id'];
			$this->sql="select * from worker natural join signin where company_id = '$company_id' and worker_id =	'$worker_id' order by in_date";
			$res = $this->mysql->getData($this->sql);
		}else{
			//搜索全部签到情况
			$this->sql="select * from worker natural join signin where company_id = '$company_id' order by in_date";
			$res = $this->mysql->getData($this->sql);
		}
		$items = null;
		$i = 0;
		if($res)
		{
			foreach($res as $item)
			{
				//挑选出特定时间内的员工签到信息,该特定时间是用户在web端选择的；
				if( strtotime($item['in_date']." ".$item['am_in_time'])>=$start_date_timestamp && 
						strtotime($item['in_date']." ".$item['am_in_time'])<$end_date_timestamp )
				{//添加工作状态这一项，0表示正常，1表示迟到，2表示早退，3表示迟到且早退，初始化为0
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
			{//得到公司规定的标准上午上下班时间，下午上下班时间的时间戳，用于比较判断是否员工迟到
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
			{//判断迟到
				$sign_data['work_state'] = 1;
				$items[$i] = $sign_data;
			}
			if(strtotime($sign_data['am_out_time'])<$am_out_timestamp||
				strtotime($sign_data['pm_out_time'])<$pm_out_timestamp)
			{//判断早退
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

	//注册账号
	function handle_register($company_email,$company_password,$regtime,$activation,$activation_time)
	{
		$this->sql = "select company_email from company where company_email = '$company_email'";
		$res = $this->mysql->getVar($this->sql);
		if($res)
			return 0;
		$this->sql2 = "insert into app_ququsignin.company (company_email,company_password,register_time,activation,activation_time,status) value ('$company_email', '$company_password', '$regtime', '$activation', '$activation_time',0)";
		return $this->mysql->runSql($this->sql2);
	}

	//账号激活，验证激活码
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
	
	
	//账号激活，更新激活状态
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
*MySQL的Select查询函数，函数的参数为公司id。
*返回包含公司规定的标准上午上下班时间，下午上下班时间的数组
*/
	 function select_standard_time($company_id)
	 {
			$this->sql = "select * from time_standard where company_id = '$company_id'";
			$res = $this->mysql->getData($this->sql);
			return $res;
	 }
	 
/*
*MySQL的Select查询函数，函数的参数为员工姓名。
*返回员工id的数组
*/	 
	function get_worker_id($worker_name)
	{
		$this->sql = "select worker_id from worker where woker_name = '$worker_name'";
		$res = $this->mysql->getData($this->sql);
		return $res;
	}
	
/*
*MySQL的Select查询函数，函数的参数为公司id。
*返回包含公司id，公司名称，公司上下午的上下班时间的数组
*/	
	function get_company_info($company_id)
	{
		$this->sql = "select * from company natural join time_standard where company_id = '$company_id'";
		$res = $this->mysql->getData($this->sql);
		return $res;
	}
	
	
/*
*设置公司信息，函数的参数为包含公司id，公司名称，公司上下午的上下班时间的数组。
*返回成功或失败。
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