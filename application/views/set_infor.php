<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<base href="<?php echo"$base";?>">  
		<link rel="stylesheet"  href="<?php echo"$base/$css";?>">
		<script type= "text/javascript" src = "../../js/Jquery.js"></script>
		<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
		<title>公司信息</title>
		<style type="text/css">
		
		.background
		{
			margin: 0px;
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
		.c-name
			{
				margin-left: 700px;
				font-size: 20px;
			}
    		.panel
    		{
    			margin-top: 100px;
			    margin-left: 80px;
    			width: 700px;
    		}
    		.panel-default
    		{
    			border-width: 0px;
    		}
    		.panel-body
    		{
    			width: 600px;
    			margin-left: 30px;
    		}
    		.form-group
    		{
    			margin-top: 20px;
    			margin-bottom: 0px;
    		}
    		.text-primary
    		{
    			font-size: 30px!important;
    		}
		</style>
	</head>
	<body>
	
<?php
	if($set_result != null)
	{
		if($set_result == 0)
		{
		   echo "<script language=\"javascript\"> ";
		   echo "alert(\"设置失败！\");";
		   echo "</script>";
		}else if($set_result == 1)
		{
			echo "<script language=\"javascript\"> ";
		   echo "alert(\"设置成功！\");";
		   echo "</script>";
		}
	}
?>

		<div class="container-fluid background">
			<div class="row" style="margin:0px;">
			<div class="col-lg-3 background-float-left">
				<img src="img/logo.png"style="margin-left:135px;margin-top:80px">
				<div class="text-left">
					<span class="glyphicon glyphicon-globe"></span><a href="/ququer/home/" style="margin: 10px 20px;">签到详情</a>
					<br><br>
					<span class="glyphicon glyphicon-wrench"></span><a href="/ququer/worker_manage/1" style="margin: 10px 20px;">员工管理</a>
					<br><br>
					<span class="glyphicon glyphicon-cog"></span><a href="/ququer/set_infor/" style="margin: 10px 20px;color: #f2725f;border-color: #F2725F;border-style: solid;border-width: 3px">公司信息</a>
				</div><!--text-left-->
			</div><!--col-sm-3 background-float-left-->
			<form action="/ququer/handle_set_info/" method="post">
<?php 
if(isset($company_info))
{
foreach($company_info as $item):
?>			
			
			<div class="col-lg-8 background-right thumbnail" style="border-width:0px;">
				<div class="form-horizontal form-size panel panel-default" style="padding-left:40px;">
					<div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;font-size:40px;margin-right:15px;">公司编号</label>
					    <div class="col-sm-5" style="padding-left:0px;padding-right: 0px;margin-top:0px;">
					        <span style="color:#1abd9b;font-size:30px;margin-top: 10px;"><?php echo $_SESSION['company_id'];?> <span>
					    </div><!--col-sm-4-->
				    </div><!--form-group-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;font-size:30px;margin-right:15px;">公司名称</label>
					    <div class="col-sm-5" style="padding-left:0px;padding-right: 0px;margin-top:12px;">
					        <input class="form-control" value="<?php echo $item['company_name'];?>" name="company_name" type="text"></input>
					    </div><!--col-sm-4-->
				    </div><!--form-group-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">上午上班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" name="morning_in" value="<?php echo $item['morning_in'];?>" size="36" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group1-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">上午下班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" value="<?php echo $item['morning_out'];?>" name="morning_out" size="16" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group2-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">下午上班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control"  value="<?php echo $item['afternoon_in'];?>" name="afternoon_in" size="16" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group3-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">下午下班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" value="<?php echo $item['afternoon_out'];?>" name="afternoon_out" size="16" type="text" value="" readonly style="background-color: #fff;margin-top: ;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group4-->
				    	<button type="submit" class="btn btn-success"  style="background-color:#f2725f;width: 130px;margin-bottom: 10px;margin-top: 20px;margin-left:300px ;font-size:20px;">保存</button>
				</div><!--panel-->					
				
<?php
endforeach;
}else{
?>
<div class="col-lg-8 background-right thumbnail" style="border-width:0px;">
				<div class="form-horizontal form-size panel panel-default" style="padding-left:40px;">
					 <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;font-size:40px;margin-right:15px;">公司编号</label>
					    <div class="col-sm-5" style="padding-left:0px;padding-right: 0px;margin-top:0px;">
					       <span style="color:#1abd9b;font-size:30px;margin-top: 10px;"><?php echo $_SESSION['company_id'];?> <span>
					    </div><!--col-sm-4-->
				    </div><!--form-group-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;font-size:40px;margin-right:15px;">公司名称</label>
					    <div class="col-sm-5" style="padding-left:0px;padding-right: 0px;margin-top:12px;">
					        <input class="form-control" value="" name="company_name" type="text"></input>
					    </div><!--col-sm-4-->
				    </div><!--form-group-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">上午上班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" name="morning_in" value="" size="36" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group1-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">上午下班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" value="" name="morning_out" size="16" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group2-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">下午上班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control"  value="" name="afternoon_in" size="16" type="text" value="" readonly style="background-color: #fff;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group3-->
				    <div class="form-group" style="margin-left:60px ;margin-right:0px ;">
					    <label class="col-sm-5 control-label text-primary" style="color:#1abd9b;margin-right:15px;font-size:30px">下午下班时间</label>
					    <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii" style="margin-top: 12px;">
		                    <input class="form-control" value="" name="afternoon_out" size="16" type="text" value="" readonly style="background-color: #fff;margin-top: ;">
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" id="dtp_input3" value="" /><br/>
				    </div><!--form-group4-->
				    	<button type="submit" class="btn btn-success"  style="background-color:#f2725f;width: 130px;margin-bottom: 10px;margin-top: 20px;margin-left:300px ;font-size:20px;">保存</button>
				</div><!--panel-->					
<?php
}
?>
			</form>		
			</div><!--8-->
			<div class="col-lg-1"></div>
			</div>
		</div><!--container-->

		<script type="text/javascript" src="../../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
		<script type="text/javascript">
		    $('.form_time').datetimepicker({
		        language:  'fr',
		        weekStart: 1,
		        todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 1,
				minView: 0,
				maxView: 1,
				forceParse: 0
		    });
		</script>
	</body>

</html>						
