<?php
	//C#端检测声波后返回签到信息：方式（签到？签离）,公司号，员工号，签到日期，签到时间；
		$choice = $_GET['choice'];//1表示签到；2表示签离；
		$company_id = $_GET['company_id'];
		$worker_id = $_GET['worker_id'];
		$date = $_GET['date'];
		$time = $_GET['time'];		
		
		$mysql = new SaeMysql();
		$get_time_sql = "select * from time_standard where company_id = $company_id";
		$res = $mysql->getData($get_time_sql);
		if($res)
		{
			foreach($res as $item){
			//得到公司规定的标准上午上下班时间，下午上下班时间
	//			$morning_in = $item['morning_in'];
				$morning_out = $item['morning_out'];
				$afternoon_in = $item['afternoon_in'];
	//			$afternoon_out = $item['afternoon_out'];
			}
	
			//用上午下班时间的时间戳来判断上午签到还是下午签到，用下午上班时间的时间戳来判断上午签离还是下午签离。
			$jugde_in_timestamp = strtotime($date.' '.$morning_out);
			$jugde_out_timestamp = strtotime($date.' '.$afternoon_in);
			$time_timestamp = strtotime($date.' '.$time);		
			
			if($choice==1)//签到
			{
			
				if($time_timestamp <= $jugde_in_timestamp)
				{  //上午上班签到
					$check_in_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_in_sql);
					if($data)
					{					
						//重复签到，
						echo "again";
					}else{
						$sign_in_sql="INSERT INTO  `app_ququsignin`.`signin` (`in_id` ,`company_id` ,`worker_id` ,`in_date`,`am_in_time`) VALUES (NULL , $company_id,  $worker_id,  '$date', '$time')";
						$res = $mysql->runSql($sign_in_sql);
						if($res)
							echo 'ok';//签到成功
						else
							echo 'fail';//签到失败
					}
				}else{
				//下午上班签到
					$check_in_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_in_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['pm_in_time'] != "00:00:00")
							{	//重复签到，
								echo "again";
							}else{
								//上午上班已签到，所以此时只需更新pm_in_time
								$sign_in_sql="update signin set pm_in_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_in_sql);
								if($res)
									echo 'ok';
								else
									echo 'fail';
							}
						}
					}else{
					//上午上班未签到，所以此时需要执行插入操作
						$sign_in_sql="INSERT INTO  `app_ququsignin`.`signin` (`in_id` ,`company_id` ,`worker_id` ,`in_date`,`pm_in_time`) VALUES (NULL , $company_id,  $worker_id,  '$date', '$time')";
						$res = $mysql->runSql($sign_in_sql);
						if($res)
							echo 'ok';
						else
							echo 'fail';
					}
				
				}
			}else{//签离
				if($time_timestamp <= $jugde_out_timestamp)
				{  //上午下班签到
					$check_out_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_out_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['am_out_time'] != "00:00:00")
							{	//重复签到，
								echo "again";
							}else{
								//上午上班已签到，所以此时只需更新pm_out_time
								$sign_out_sql="update signin set am_out_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_out_sql);
								if($res)
									echo 'ok';
								else
									echo 'fail';
							}
						}
					}else{
						//未签到，不能签离。返回wrong
						echo 'wrong';
					}
				}else{
					//下午下班签到
					$check_out_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_out_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['pm_out_time'] != "00:00:00")
							{	//重复签到，
								echo "again";
							}else{
								$sign_out_sql="update signin set pm_out_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_out_sql);
								if($res)
									echo 'ok';//签到成功
								else
									echo 'fail';//签到失败
							}
						}
					}else{
						//未签到，不能签离。返回wrong
						echo 'wrong';
					}
				
				}
			}
		}else{
		//如果公司未规定标准的上下班时间，则返回fail;这暗含要求，公司规定这标准的的上下班时间需要完善的，不能残缺不全，可以在设置标准时间时加以限制。
			echo "fail";
		}
?>