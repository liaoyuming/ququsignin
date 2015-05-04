<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>到啦</title>
		<script type= "text/javascript" src = "../../js/Jquery.js"></script>
		<script type="text/javascript" src="../../js/bootstrap.js" ></script>
		<link rel="stylesheet" href="../../css/bootstrap.css" />
		<style>
			.wrapper{
				width: 100%;
				text-align: center;
			}
			.head-line{
				width:100%;
				height:533px;
				background:url(../../img/签到-web-top_bg.png);
				background-size: 100% 100%;				
			}
			.box-bg{
				padding: 70px 10% 72px 65%;
			}
			#div1{
				display: none;
			}
			.box{
				width: 350px;
				height: 390px;
				background: url(../../img/签到-web-登陆边框.png);
				background-size: 100% 100%;				
			}
			.text{
				height: 29%;
				width: 100%;
			}
			.text a{
				text-decoration: none;
			}
			.text-l-r{
				float: left;
				width: 50%;
				height: 100%;
				padding:53px 10px 16px 35px; 
				text-align: center;
			    font-family: "黑体";
			    font-size: 30px;
			    color: #FFF;
			}
			.l-r-right{
				padding: 53px 30px 16px 0px;
			}
			.text-l-r img{
				width: 16px;
				height: 16px;
				margin-left:5px;
				margin-bottom: 7px;
			}
			.text-input{
				width: 260px;
				border: none;
				margin: 10px 30px 0 47px;
				color: #bebebe;
				font-family: "黑体";
				font-size: 23px;
			}
			.text-input input{
				width: 240px;
				height: 50px;
			}
			.text-input-1{
				border-radius:4px ;
				border-bottom: solid 1px;
				border-bottom-color: #F0AD4E;
			}
			.text-input-2{
				border-top: solid 1px;
				border-bottom: solid 1px;
				border-top-color: #F0AD4E;
				border-bottom-color: #F0AD4E;
			}
			.text-input-3{
				border-radius:4px ;
				border-top: solid 1px;
				border-top-color: #F0AD4E;
			}
			.text-btn-register{
				margin-top:70px ;
			}
			.text-radio-t{
				font-family: "黑体";
				font-size: 19px;
				color: #bebebe;
				padding:5px 180px 0 0;
			}
			.btn-pic{
				width: 225px;
				height: 45px;
				display: block;
				background-color: #f1715e;
				margin: 25px 30px 0 65px;
				font-family: "黑体";
				font-size: 30px;
				text-align: center;
				color:#FFFFFF;
				}
			.text a{
				text-align: center;
				font-size: 18px;
				font-family: "黑体";
				color: #bebebe;
				text-decoration: none;
				}
			.main{
				width: 100%;
				height: 980px;	
			}
			.main-pic1{
				background: url(../../img/签到-web-pc端图片.png);
				height: 490px;
				background-size: 100% 100%;
				padding: 120px 10% 54px 43%;
			}
			.main-pic2{
				background: url(../../img/签到-web-android下载介绍图.png);
				height:490px;
				background-size: 100% 100%;
				padding: 120px 7% 54px 40%;
			}
			.box1{
				width: 100%;
				height: 180px;
				text-align: left;
				font-family: "楷体";
				font-size: 35px;
			}
			.box1 a{
				text-decoration: none;
			}
			.box1-btn1{
				padding: 30px 0 0 300px;
			}
			.box1-btn2{
				padding: 50px 0 0 339px;
			}
			.check
			{
				margin: -100px -140px 120px 300px;
				text-align: initial;
				font-size: 20px;
			}
		</style>
	</head>
	
	<body>
		<div class="wrapper">
			
			<div class="head-line">
			  <div class="box-bg" id="div2">
			  <form id="sign_in" name="sign_in" action="/ququer/handle_login/" method="post">
			    <div class="box">
				  <div class="text">
				    <div class="text-l-r">登录</div>
				    <a href="#" onclick="toggle()">
				    	<div class="text-l-r l-r-right">
				    		注册<img src="../../img/签到-web-转到注册图标.png">				    		
				    	</div>
				    </a>			    
				  </div>
				  <div class="text">
					<div class="text-input">
						<input type="text" name="company_id" id="company_id" class="text-input-1" placeholder=" 用户邮箱">
						<input type="password" name="password" id="password" name="password" class="text-input-3" placeholder=" 密码">
						<div class = "check" id="username_warning"   hidden="true" >用户名或密码错误！</div>
					</div>
				  </div>
				  <div class="text">
				  	  <input type="radio" style="float: left;margin-left: 65px;margin-top: 11px;">
				  	  <div class="text-radio-t">记住密码</div>
				  	<button type= "button" class="btn-pic" id="login">登录</button>
				  </div>
				  <div class="text">
				  	<a href="#"><i>忘记密码？</i></a>
				  </div>
			    </div>
				</form>
			  </div>
			  <div class="box-bg" id="div1">
			  	<form name="log_in" id="registerForm" action="/ququer/handle_register/" method="post">
			    <div class="box">
				  <div class="text">
				    <div class="text-l-r">注册</div>
				    <a href="#" onclick="toggle()">
				    	<div class="text-l-r l-r-right">
				    		登录<img src="../../img/签到-web-转到注册图标.png">				    		
				    	</div>
				    </a>			    
				  </div>
				  <div class="text">
					<div class="text-input">
						<input type="text" name="company_email"  id="company_email"  class="text-input-1" placeholder=" 邮箱">
						<input type="password" name="password" id="password_signup" class="text-input-2" placeholder=" 密码">
						<input type="password" name="confirm" id="confirm" class="text-input-3" placeholder=" 重复密码">
						<div class = "check" id="email_illegal"   hidden="true" >邮箱不合法</div><div class = "check" id="email_legal" hidden="true">邮箱可用</div ><div class = "check" id="email_exist" hidden="true">邮箱被注册</div ><div class = "clear"></div>
						<div class = "check" id="confirm_illegal"  hidden="true" >两次密码不一致</div><div class = "check" id="confirm_legal"hidden="true">密码一致</div><div class = "check" id="confirm_none" hidden="true">密码不能为空</div><div class = "clear"></div>
						<div class = "check" id="password_illegal"  hidden="true">密码不足六位</div><div class = "check" id="password_legal"hidden="true">密码合法</div><div class = "clear"></div>
					</div>
				  </div>
				  <div class="text text-btn-register">
				  		<button type= "button" name="sub" id="sub" class="btn-pic">注册</button>
				  </div>
			    </div>
				</form>
			  </div>
			</div>
			<div class="main">
			  <div class="main-pic1">
			  	<div class="box1">
			  	  <p>pc签到</p>
			  	  <p>员工信息实时录入</p>
			  	</div>
			  	<div class="box1 box1-btn1">
				  <a href="http://ququsignin-download.stor.sinaapp.com/%E5%88%B0%E5%95%A6.exe"><div class="btn-pic">pc端下载</div></a>
			  	</div>
			  </div>
			  <div class="main-pic2">
			  	<div class="box1">
			  	  <p>手机签到</p>
			  	  <p>给你更快速便捷的工作体验</p>
			  	</div>
			  	<div class="box1 box1-btn2">
				  <a href="/ququer/download?type=apk"><div class="btn-pic">Android端下载</div></a>
			  	</div>
			  </div>
			</div>
		</div>
		
<script language="JavaScript" type="text/JavaScript">
//光标移开判断Email是否合法
			$("#company_email").blur(function(){
				var email = $("#company_email").val();
				$.post("<?php echo site_url();?>/ququer/email_check",{company_email:email},function(msg){
					if(msg == 1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_exist').hide();
					}else if(msg == 2){
						$('#email_illegal').hide();
						$('#email_exist').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_exist').hide();
						$('#email_legal').show();
					}
				});
			});	
//光标移开判断password是否合法
				$("#password_signup").blur(function(){
					var password = $("#password_signup").val();
					if(password.length<6){
						$('#password_illegal').show();
						$('#password_legal').hide();
						
					}else{
						$('#password_illegal').hide();
						$('#password_legal').show();
						
					}
				});	
//点击登录按钮进行的操作
			$("#login").click(function(){
				var company_id = $("#company_id").val();
				var password = $("#password").val();
				$.post("/ququer/check_login/",{company_id:company_id,password:password},function(msg){
					if(msg == 1){
						$("#username_warning").hide();
						$('#sign_in').submit();
					}
					else{
						$("#username_warning").show();
					}
				});
			});
//点击注册按钮进行的操作；
			$("#sub").click(function(){
				var email = $("#company_email").val();
				$.post("<?php echo site_url();?>/ququer/email_check",{company_email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_exist').hide();
					}else if(msg == 2){
						$('#email_illegal').hide();
						$('#email_exist').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_exist').hide();
						$('#email_legal').show();
					}
				});
				var password = $("#password_signup").val();
				var confirm = $("#confirm").val();
				if(confirm == ""){
					$('#confirm_none').show();
					$('#confirm_illegal').hide();
					$('#confirm_legal').hide();
				}else if(confirm!=password){
					$('#confirm_none').hide();
					$('#confirm_illegal').show();
					$('#confirm_legal').hide();
				}else{
					$('#confirm_none').hide();
					$('#confirm_illegal').hide();
					$('#confirm_legal').show();
				}
				if($("#email_legal").is(":visible")&&$("#password_legal").is(":visible")&&
				$("#confirm_legal").is(":visible")){
					$("#registerForm").submit();
					
				}
				
			});	
	function toggle(){
		if (document.getElementById){
			target1=document.getElementById('div1');
			target2=document.getElementById('div2');
				if (target1.style.display=="block"){
					target1.style.display="none";
					target2.style.display="block";
				} else {
					target1.style.display="block";
					target2.style.display="none";
        }
    }
}
</script>
		
	</body>
</html>
