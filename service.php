<?php
	//C#�˼�������󷵻�ǩ����Ϣ����ʽ��ǩ����ǩ�룩,��˾�ţ�Ա���ţ�ǩ�����ڣ�ǩ��ʱ�䣻
		$choice = $_GET['choice'];//1��ʾǩ����2��ʾǩ�룻
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
			//�õ���˾�涨�ı�׼�������°�ʱ�䣬�������°�ʱ��
	//			$morning_in = $item['morning_in'];
				$morning_out = $item['morning_out'];
				$afternoon_in = $item['afternoon_in'];
	//			$afternoon_out = $item['afternoon_out'];
			}
	
			//�������°�ʱ���ʱ������ж�����ǩ����������ǩ�����������ϰ�ʱ���ʱ������ж�����ǩ�뻹������ǩ�롣
			$jugde_in_timestamp = strtotime($date.' '.$morning_out);
			$jugde_out_timestamp = strtotime($date.' '.$afternoon_in);
			$time_timestamp = strtotime($date.' '.$time);		
			
			if($choice==1)//ǩ��
			{
			
				if($time_timestamp <= $jugde_in_timestamp)
				{  //�����ϰ�ǩ��
					$check_in_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_in_sql);
					if($data)
					{					
						//�ظ�ǩ����
						echo "again";
					}else{
						$sign_in_sql="INSERT INTO  `app_ququsignin`.`signin` (`in_id` ,`company_id` ,`worker_id` ,`in_date`,`am_in_time`) VALUES (NULL , $company_id,  $worker_id,  '$date', '$time')";
						$res = $mysql->runSql($sign_in_sql);
						if($res)
							echo 'ok';//ǩ���ɹ�
						else
							echo 'fail';//ǩ��ʧ��
					}
				}else{
				//�����ϰ�ǩ��
					$check_in_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_in_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['pm_in_time'] != "00:00:00")
							{	//�ظ�ǩ����
								echo "again";
							}else{
								//�����ϰ���ǩ�������Դ�ʱֻ�����pm_in_time
								$sign_in_sql="update signin set pm_in_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_in_sql);
								if($res)
									echo 'ok';
								else
									echo 'fail';
							}
						}
					}else{
					//�����ϰ�δǩ�������Դ�ʱ��Ҫִ�в������
						$sign_in_sql="INSERT INTO  `app_ququsignin`.`signin` (`in_id` ,`company_id` ,`worker_id` ,`in_date`,`pm_in_time`) VALUES (NULL , $company_id,  $worker_id,  '$date', '$time')";
						$res = $mysql->runSql($sign_in_sql);
						if($res)
							echo 'ok';
						else
							echo 'fail';
					}
				
				}
			}else{//ǩ��
				if($time_timestamp <= $jugde_out_timestamp)
				{  //�����°�ǩ��
					$check_out_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_out_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['am_out_time'] != "00:00:00")
							{	//�ظ�ǩ����
								echo "again";
							}else{
								//�����ϰ���ǩ�������Դ�ʱֻ�����pm_out_time
								$sign_out_sql="update signin set am_out_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_out_sql);
								if($res)
									echo 'ok';
								else
									echo 'fail';
							}
						}
					}else{
						//δǩ��������ǩ�롣����wrong
						echo 'wrong';
					}
				}else{
					//�����°�ǩ��
					$check_out_sql="select * from signin where `in_date`='$date' and `worker_id`=$worker_id";
					$data = $mysql->getData($check_out_sql);
					if($data)
					{
						foreach($data as $item)
						{
							if($item['pm_out_time'] != "00:00:00")
							{	//�ظ�ǩ����
								echo "again";
							}else{
								$sign_out_sql="update signin set pm_out_time = '$time' where in_date='$date' and worker_id=$worker_id";
								$res = $mysql->runSql($sign_out_sql);
								if($res)
									echo 'ok';//ǩ���ɹ�
								else
									echo 'fail';//ǩ��ʧ��
							}
						}
					}else{
						//δǩ��������ǩ�롣����wrong
						echo 'wrong';
					}
				
				}
			}
		}else{
		//�����˾δ�涨��׼�����°�ʱ�䣬�򷵻�fail;�ⰵ��Ҫ�󣬹�˾�涨���׼�ĵ����°�ʱ����Ҫ���Ƶģ����ܲ�ȱ��ȫ�����������ñ�׼ʱ��ʱ�������ơ�
			echo "fail";
		}
?>