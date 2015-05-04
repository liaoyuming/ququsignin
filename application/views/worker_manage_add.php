<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<base href="<?php echo"$base";?>">  
		<link rel="stylesheet" type="text/css" href="<?php echo"$base/$css";?>">
		<title>添加</title>
		<style type="text/css">

		.background
		{
			background-color:;
		}
		.background-float-left
		{
			font-size: 25px;
			background-color: #264e66;
			color: #FFFFFF;
			height: 800px
		}
		.background-left
		{
			font-size: 20px;
		}
		.text-left
		{
			margin-top: 90px;
			margin-bottom:300px;
			text-align: -moz-center;
		}
		.background-right.thumbnail
		{
			height: auto;
			border-bottom: 0px;
			border-right: 0px;
			border-top: 0px;
		}
		.but-group
		{
			margin-top: 20px;
			text-align: -moz-center;
		}
		.input-group
		{
			margin-left: 205px;
		}
		.nav
		{
			margin-top: 20px;
		}	
		.panel
		{
			margin-top: 100px;
		    margin-bottom: 100px;
		    margin-left: 80px;
			width: 700px;
		}
		.panel-body
		{
			width: 500px;
			margin-left: 100px;
			
		}
		.col-lg-6
		{
			margin-top: 20px;
		}
		</style>
	</head>
	<body>
		<div class="ccontainer-fluid background">
			<div class="row" style="margin:0px;">
			<div class="col-lg-3 background-float-left">
				<img src="img/logo.png"style="margin-left:135px;margin-top:80px">
				<div class="text-left">
					<span class="glyphicon glyphicon-globe"></span><a href="/ququer/home/" style="margin: 10px 20px;">签到详情</a>
					<br><br>
					<span class="glyphicon glyphicon-wrench"></span><a href="/ququer/worker_manage/1" style="margin: 10px 20px;color: #f2725f;border-color: #F2725F;border-style: solid;border-width: 3px">员工管理</a>
					<br><br>
					<span class="glyphicon glyphicon-cog"></span><a href="/ququer/set_infor/" style="margin: 10px 20px;">公司信息</a>
				</div><!--text-left-->
			</div><!--col-sm-3 background-float-left-->
			<div class="col-lg-8 col-sm-8 background-right thumbnail">
				<div class="panel" style="border-color:#1abd9b;border-width: 3px;">
						<ul class="nav nav-tabs" role="tablist"style="border-color:#1abd9b;border-width: 3px;">
							<li ><p style="width:110px;"></p></li>
							<li class="active"><a href="/ququer/worker_manage/1" style="width:80px;font-size: 20px;color:#fff;background-color:#1abd9b;">添加</a></li>
							<li><a href="/ququer/worker_manage/2" style="width:80px;font-size: 20px;color:#1abd9b">删除</a>
						</ul>
					
				    <div class="panel-body" >
						<form name="add_worker" action="/ququer/handle_add_worker/" method="post" >
							<div class="row">
								<div class="col-lg-6">
									<input name="id_1" type="text" class="form-control" placeholder="输入ID">
								</div>
								<div class="col-lg-6">
									<input name="name_1" type="text" class="form-control" placeholder="输入姓名">
								</div>
							</div><!--row五组-->
							<div class="row">
								<div class="col-lg-6">
									<input name="id_2" type="text" class="form-control" placeholder="输入ID">
								</div>
								<div class="col-lg-6">
									<input  name="name_2" type="text" class="form-control" placeholder="输入姓名">
								</div>
							</div><!--五组-->
							<div class="row">
								<div class="col-lg-6">
									<input name="id_3" type="text" class="form-control" placeholder="输入ID">
								</div>
								<div class="col-lg-6">
									<input name="name_3" type="text" class="form-control" placeholder="输入姓名">
								</div>
							</div><!--五组-->
							<div class="row">
								<div class="col-lg-6">
									<input name="id_4" type="text" class="form-control" placeholder="输入ID">
								</div>
								<div class="col-lg-6">
									<input name="name_4" type="text" class="form-control" placeholder="输入姓名">
								</div>
							</div><!--五组-->
							<div class="row">
								<div class="col-lg-6">
									<input  name="id_5" type="text" class="form-control" placeholder="输入ID">
								</div>
								<div class="col-lg-6">
									<input name="name_5" type="text" class="form-control" placeholder="输入姓名">
								</div>
							</div><!--五组-->
<?php
if($result!=null){
?>
							<div class="row">
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
									</button>
<?php
	$success="插入成功：";
	$fail="插入失败：";
	for($i=0;$i<5;$i++){
		$index = $i+1;
		if($result[$i]==1)
		{			
			$success = $success.$index;
		}
		else
		{
			$fail = $fail.$index;
		}
	}
	echo $success;
	echo $fail;
?>
								</div>
							</div>
<?php
	}
?>
							<div class="but-group">
								<button type="submit" class="btn btn-info" style="width: 150px;background-color:#f2725f;border-color: #a7a7a8;">确定</button>	
				    		</div><!--but-gro-->
						</form>
				    </div><!--panel-b-->
			    
				</div><!--panel-->		
			</div><!--8-->
			</div>
		</div><!--container-->
	</body>
</html>
