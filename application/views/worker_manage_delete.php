<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<base href="<?php echo"$base";?>">  
		<link rel="stylesheet" type="text/css" href="<?php echo"$base/$css";?>">
		<script src="<?php echo $base."/js/bootstrap.js"?>"></script>
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
				
    			text-align: -moz-center;	
    		}
    		.nav
    		{
    			margin-top: 20px;
    		}	
    		.list-data-member
    		{
    			margin-top: 20px;
    		}
    		.c-name
			{
				margin-left: 700px;
				font-size: 20px;
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
			form{
				width: 468px;
			}
		</style>
	</head>
	<script language="javascript">
		function check(form){
			if(form.worker_id.value==""){
				alert("请输入员工工号");
				form.worker_id.focus();
				return false;
			}
			else{
				form.submit();
			}
		}	
	</script>
	<body>
		<div class="container-fluid background">
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
			<div class="col-lg-8 background-right thumbnail">
				<div class="panel panel-default" style="border-color:#1abd9b;border-width: 3px;">
					<ul class="nav nav-tabs" role="tablist" style="border-color:#1abd9b;border-width: 3px;">
				    	<li><p style="width:110px;"></p></li>
						<li><a href="/ququer/worker_manage/1" style="width:80px;font-size: 20px;color:#1abd9b">添加</a></li>
				        <li class="active"><a href="/ququer/worker_manage/2" style="width:80px;font-size: 20px;color:#fff;background-color:#1abd9b;">删除</a></li>
					</ul>    
					<div class="panel-body">
						<div class="input-group">
							<form name="search" action="/ququer/handle_search/" method="post">
								<input style="width:410px;" name="worker_id" type="text" class="form-control"  placeholder="输入员工工号">
								<button class="btn btn-default" type="button" onclick="check(search)" style="background-color: #a7a7a8;">查询</button>
							</form>
						</div><!-- /input-group -->
						<div class="list-data-member thumbnail">
							<table class="table table-hover">
							    <thead>
								    <tr>
								        <th style="text-align: -moz-center;">ID</th>
								        <th style="text-align: -moz-center;">姓名</th>
								        <th style="text-align: -moz-center;">操作</th>
							        </tr>
								</thead>
								<tbody>
<?php
	if($res==1){	
		echo "";
	}else if($res){
?>
								<form style="text-align: -moz-center;" action="/ququer/handle_delete_worker/" method="post">
							    	<tr>
							            <td style="text-align: -moz-center;"><?php echo $res['worker_id'];?></td>
							            <td style="text-align: -moz-center;"><?php echo $res['worker_name'];?></td>
							            <td style="text-align: -moz-center;">	
											<input type="hidden" name="worker_id" value="<?php echo $res['worker_id'];?>">
											<button type="submit" class="btn btn-danger">删除</button>									
										</td>
							        </tr>
								</form>
<?php	
	}
	else{
		echo "<tr><td colspan='8' align='center'>没有该员工信息！</td></tr>";
	}
	
	if($status==1){
	//显示删除成功提示框
?>
									<tr>
										<div class="alert alert-success alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">&times;</span>
											<span class="sr-only">Close</span>
											</button>删除成功！
										</div>
									</tr>
<?php
	}
	else if($status ==0){//显示删除失败提示框							
?>
									<tr>
										<div class="alert alert-warning alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">&times;</span>
											<span class="sr-only">Close</span>
											</button>删除失败！
										</div>
									</tr>

<?php
	}
?>


							    </tbody>
							</table>
						</div><!--list--->
				    </div><!--panel-b-->
			    
				</div><!--panel-->		
			</div><!--8-->
			</div>
		</div><!--container-->
	</body>
</html>