<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<base href="<?php echo"$base";?>">  
		<link rel="stylesheet"  href="<?php echo"$base/$css";?>">
		<script type="text/javascript" src="js/jquery1.8.js" ></script>
	    <script type="text/javascript"src="js/bootstrap.js"></script>
	    <script type="text/javascript" src="js/dateforbootstrap.js"></script>
		<link rel="stylesheet" type="text/css" media="screen"href="../../css/dateforbootstrap.css">
		<title>home</title>
		<style type="text/css">

		a:visited
		{
			color: #FFFFFF;
		}
		a:hover
		{
			color: #f2725f;
		}
		a:active
		{
			border-color: #F2725F;
			border-style: solid;
			border-width: 3px;
		}
		.background
		{
			background-color:;
		}
		.background-float-left
		{
			
			font-size: 25px;
			background-color: #264e66;
			color: #FFFFFF;
			height: 800px;
			
		}
		.background-left
		{
			font-size: 20px;  
		}
		.text-left
		{
			margin-top: 90px;
			margin-bottom: 300px;
			text-align: -moz-center;
		}
		.list-data
		{
			width: 700px;
			margin: 113px 85px; 
		}
		.list-data-dvide
		{
			margin: 40px 0px;
		}
		.list-data-member
		{
			width: 700px;
		}
		.list-data-search
		{
			width: 300px;
			float: left;
			margin-left: 5px;
			margin-right: 15px;
		}
		.input-date-space
		{
			width: 140px;
			float: left;
			margin-right: 10px;
		}
		.background-right.thumbnail
		{
			height: auto;
			border-bottom: 0px;
			border-right: 0px;
			border-top: 0px;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid background">
			<div class="row" style="margin:0px;">
			<div class="col-lg-3 background-float-left" style="background-color:#284e66">
				<img src="img/logo.png"style="margin-left:135px;margin-top:80px">
			
				<div class="text-left">
					<span class="glyphicon glyphicon-globe"></span><a href="/ququer/home/" style="margin: 10px 20px;color: #f2725f;border-color: #F2725F;border-style: solid;border-width: 3px">签到详情</a>
					<br><br>
					<span class="glyphicon glyphicon-wrench"></span><a href="/ququer/worker_manage/1" style="margin: 10px 20px;">员工管理</a>
					<br><br>
					<span class="glyphicon glyphicon-cog"></span><a href="/ququer/set_infor/" style="margin: 10px 20px;">公司信息</a>
				</div><!--text-left-->
			</div><!--col-sm-3 background-float-left-->
			<div class="col-lg-8 background-right thumbnail">
				<div class="list-data">
					<form action="/ququer/handle_sign_search/" method="get">
						<div class="list-data-dvide">
							<div class="input-date-space">
								<div id="datetimepicker1" class="input-group date">
								<input type="text" name="start_date" value="<?php echo $start_date;?>" class="form-control" placeholder="开始日期" style="background-color:#1abd9b;color:#fff"></input>
						   	   	<span class="add-on input-group-addon glyphicon glyphicon-calendar" style="background-color:#1abd9b;color:#fff"></span>
						    	</div>
							</div>
							<div class="input-date-space">
								<div id="datetimepicker2" class="input-group date">
							    	<input type="text" name="end_date" value="<?php echo $end_date;?>" class="form-control" placeholder="结束日期"style="background-color:#1abd9b;color:#fff"></input>
							   	   	<span class="add-on input-group-addon glyphicon glyphicon-calendar" style="background-color:#1abd9b;color:#fff">
							      	</span>
							    </div>
						  	</div>
							<div class="input-group list-data-search">
								<span class="input-group-addon"style="background-color:#1abd9b;color:#fff"><span class="glyphicon glyphicon-globe"></span></span>
								<input type="text" name="worker_info" value="<?php echo $worker_info;?>" class="form-control" placeholder="请输入员工姓名或ID,空为搜索全部" style="border-color:#1abd9b">
							</div><!--input-group-->
							<input type="hidden" name="num" value="<?php echo $num;?>">
							<button class="btn btn-info" type="submit" style="background-color:#1abd9b;color:#fff"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;查询</button>
						</div><!--list-data-dvide-->
					</form>
				  	<ul class="nav nav-tabs" role="tablist">
<?php 
	switch($num)
	{
		case 1:
		{
?>		
			<li class="active"><a style="background-color:#1abd9b;color:#fff">全部记录</a></li>
			 <li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=2" style="background-color:#a7a7a8;color:#fff">迟到记录</a></li>
			 <li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=3" style="background-color:#a7a7a8;color:#fff">早退记录</a></li>		
<?php	
			break;
		}
		case 2:
		{
?>		
			<li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=1" style="background-color:#a7a7a8;color:#fff">全部记录</a></li>	
			<li class="active"><a style="background-color:#1abd9b;color:#fff">迟到记录</a></li>
			<li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=3" style="background-color:#a7a7a8;color:#fff">早退记录</a></li>		
						
						
<?php	
			break;
		}
		case 3:
		{
?>		
			 <li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=1" style="background-color:#a7a7a8;color:#fff">全部记录</a></li>	
			 <li><a href="ququer/handle_sign_search/?start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>&worker_info=<?php echo $worker_info;?>&num=2" style="background-color:#a7a7a8;color:#fff">迟到记录</a></li>	
			<li class="active"><a style="background-color:#1abd9b;color:#fff">早退记录</a></li>

<?php	
		}
	}
?>
				  		
					</ul>
					<div class="list-data-member thumbnail" style="border-color:#1abd9b;border-width:3px;color:#284e66">
						<table class="table table-hover">
				   			<thead>
					 		<tr>
						        <th>ID</th>
						        <th>员工姓名</th>
						        <th>日期</th>
						        <th>上午签到</th>
						        <th>上午签退</th>
						        <th>下午签到</th>
						        <th>下午签退</th>
								
<?php
		if($num == 1)
			echo "<th>工作状态</th>";
?>								
						    </tr>
							</thead>
						   <tbody style="border-top-color:#1abd9b;border-width:3px">
<?php
	if(isset($sign_data) && $sign_data!=null)
	{
		foreach($sign_data as $item):
		if($num==1 || $item['work_state']==($num-1) || ($num!=1 && $item['work_state'] ==3))
		{
			echo "<tr>";
			echo "<td>".$item['worker_id']."</td>";
			echo "<td>".$item['worker_name']."</td>";
			echo "<td>".$item['in_date']."</td>";
			echo "<td>".$item['am_in_time']."</td>";
			echo "<td>".$item['am_out_time']."</td>";
			echo "<td>".$item['pm_in_time']."</td>";
			echo "<td>".$item['pm_out_time']."</td>";
		}
		if($num == 1)
		{
			switch($item['work_state'])
			{
				case 0:
				{
					echo "<td>正常</td>";
					break;
				}
				case 1:
				{
					echo "<td>迟到</td>";
					break;
				}
				case 2:
				{
					echo "<td>早退</td>";
					break;
				}
				case 3:
				{
					echo "<td>迟到早退</td>";
					break;
				}
			}
		}
		echo "</tr>";	
		endforeach;
	}else{
		echo "<tr><td colspan='8' align='center'>没有任何签到记录！</td></tr>";
	}	
?>		

						    </tbody>
						</table>
					</div><!--list-data-member thumbnail-->
				</div><!--list-data-->
			</div><!--col-sm-9 background-right thumbnail-->
			</div>
		</div><!--container background-->

	    <script type="text/javascript">
	      $('#datetimepicker1').datetimepicker({
	        format: 'yyyy-MM-dd',
	        language: 'en',
	        pickDate: true,
	        pickTime: false,
	        hourStep: 1,
	        minuteStep: 15,
	        secondStep: 30,
	        inputMask: true
	      });
	    </script>
	    <script type="text/javascript">
	      $('#datetimepicker2').datetimepicker({
	        format: 'yyyy-MM-dd',
	        language: 'en',
	        pickDate: true,
	        pickTime: false,
	        hourStep: 1,
	        minuteStep: 15,
	        secondStep: 30,
	        inputMask: true
	      });
	    </script>
	</body>
</html>