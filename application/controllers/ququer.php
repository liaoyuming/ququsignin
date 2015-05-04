<?php session_start(); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ququer extends CI_Controller {

	 function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('sae_sql_model','sql_model');
	}
	
	//首页
	public function index()
	{
		$this->checkSession();
		//跳到主页
		redirect('/ququer/home/');
	}
	
	public function checkSession()
	{
		if(!isset($_SESSION['company_id']))
		{
			redirect('/ququer/login/');
		}
	}
	
	//登录页面
	public function login(){
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$this->load->view('login',$data);
	}
	
	//进入主页，此时的页面是签到详情，且默认为当天签到详情
	public function home(){
		
		$this->checkSession();
		$data['base'] = $this->config->item('base_url');  
		$data['css'] = $this->config->item('css');
		$data['num'] = 1;
//		$arr=array("company_id"=>$_SESSION['company_id']);
		$arr['company_id'] = $_SESSION['company_id'];
		$arr['worker_id'] = null;
		$arr['start_date'] = null;
		$arr['end_date'] = null;
		$sign_data = $this->sql_model->select_all_sign($arr);
		$data['sign_data'] = $sign_data;
		$data['start_date'] = $data['end_date'] = $data['worker_info'] = null;
		$this->load->view('home',$data);

	}
	
//处理签到详情搜索
	public function handle_sign_search()
	{
		$this->checkSession();
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$company_id = $_SESSION['company_id'];
		$start_date = $_GET['start_date'];
		$end_date = $_GET['end_date'];
		$worker_info = $_GET['worker_info'];
		$num = $_GET['num'];
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['worker_info'] = $worker_info;
		$arr['company_id'] = $company_id;
		$arr['start_date'] = $start_date;
		$arr['end_date'] = $end_date;
		if($worker_info)
		{
			if(is_numeric($worker_info)) 
			{//搜索员工id的情况
				$arr['worker_id'] =  $worker_info;
				$sign_data = $this->sql_model->select_all_sign($arr);
			}else{
				//搜索员工姓名的情况
				//此时，可能出现同名的问题
				$worker_ids = $this->sql_model->get_worker_id($worker_info);
				$temp['company_id'] = $company_id;
				$temp['start_date'] = $start_date;
				$temp['end_date'] = $end_date;
				$res;
				$i = 0;
				if(!empty($worker_ids)){
					foreach($worker_ids as $worker_id)
					{
						$temp['worker_id'] = $worker_id;
						$res[$i] = $this->sql_model->select_all_sign($arr);
						$i++;
					}
				}
				else{
					$res = null;
				}
				//合并同名员工签到记录
				$sign_data = null;
				for($n=0; $n<$i; $n++)
				{
					$sign_data = array_merge((array)$sign_data, (array)$res[$n]);
				}
			}
		}else{
			//只搜索指定日期内的签到情况
			$arr['worker_id'] = null;
			$sign_data = $this->sql_model->select_all_sign($arr);
		}
		$data['sign_data'] = $sign_data;
		$data['num'] = $num;//该值表示查询全部记录，或迟到记录，或早退记录
		$this->load->view('home',$data);
	}
	
	//处理注册页面
	public function handle_register(){
		$company_email = trim($_POST['company_email']); //邮箱
		$password = md5(trim($_POST['password']));//加密密码
		$regtime = time();//注册时间
		$activation = md5($company_email.$password.$regtime);//创建激活码
		$activation_time = time()+60*61*24;//过期时间为24小时后
		$res = $this->sql_model->handle_register($company_email,$password,$regtime,$activation,$activation_time);
		$data['reg_res'] = $res;
		$content = "感谢您在我站注册了新帐号。请点击链接激活您的帐号。"
				.site_url()."ququer/activate?activation=".$activation."
				如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
		$this->send_email($company_email,$content);
		$this->load->view('login',$data);
	}
		//检验Email是否可用
	function email_check(){
		$email = $_POST['company_email'];
		$result = $this->sql_model->checkEmail($email);
		if(!(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))){//正则表达式匹配邮箱格式是否正确
			echo "1";//邮箱格式不正确
		}else if($result){
			echo "2";//邮箱已经注册
		}
	}
	//检测登录
	function check_login(){
		$company_email = $_POST['company_id'];
		$password = md5($_POST['password']);
		$check_sql = "select * from company where `company_email` = '$company_email' and `company_password` = '$password' and status = 1";
		$mysql = new SaeMysql();
		$res = $mysql->getLine($check_sql);
		if($res){//登录成功输出1，失败输出2
			echo "1";
		}else{
			echo "2";
		}
	}
	//处理登录页面
	function handle_login(){
		$company_email = $_POST['company_id'];
		$_SESSION['company_id']=$this->sql_model->get_company_id($company_email);
		redirect('ququer/home/'); 
	}
	function send_email($email,$content){
		  $config=Array(
				'crlf'          => "\r\n",
				'newline'       => "\r\n",
				'charset'       => 'utf-8',
				'protocol' =>  'smtp',
                'smtp_host'=>  "smtp.163.com",                	 // SMTP Server.  Example: mail.earthlink.net
                'smtp_user'=>  "daolaqiandao@163.com",         	 // SMTP Username
                'smtp_pass'=>  "daolacaomao",           	 		 // SMTP Password
                'smtp_port'=>  "25",                        	 // SMTP Port,default
				'mailtype'=> "HTML"
                );
		$this->load->library('email',$config);
		$this->email->from('daolaqiandao@163.com');
		$this->email->to($email); 
		$this->email->subject('账户激活');
		$this->email->message($content); 
		if($this->email->send()){
			return true;
		}else{
			return false;
		} 
	}
	function activate(){
		$activation = $_GET['activation'];
		$nowtime = time();
		$row = $this->sql_model->check_activation($activation);
		if($row)
		{	
			if($nowtime > $row['activation_time'])
			{
				
				$msg = "您的激活有效期已过，请重新注册.";
				$data['success'] = 1;
			}else{
				$res = $this->sql_model->handle_activation($row['company_id']);
				if(!$res)
					$data['success'] = 3;
				$msg = "您好，您在到啦的账号，激活成功!。您的公司编号为".$row['company_id'].",公司员工需要这唯一ID，以及自己的员工ID登录账号。请记住这唯一ID！";
				$data['success'] = 2;
				
			}
			$content = $msg;
			$this->send_email($row['company_email'],$content);
		}else{
			$msg = '激活发生错误！';
			$data['success'] = 3;
		}
		redirect('ququer/login/');
	}
	
	function worker_manage($choice){
		//员工管理页面，1代表添加员工  2代表删除员工
		$this->checkSession();
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');			
		if($choice==1){
			$data['result'] = null;//1代表不需要显示信息；
			$this->load->view('worker_manage_add',$data);	
		}else if($choice==2){
			//$res是搜索结果，这里不需要搜索所以为1
			$res = 1;
			$data['res'] = $res;
			$data['status'] = -1;//还未进行删除操作，不需要显示成功或者失败
			$this->load->view('worker_manage_delete',$data);
		}else{
			//如果用户不输入1或者2，新写一个页面提示url不存在
			redirect('/ququer/home/');
		}
	}
	
	function handle_add_worker(){
		$this->checkSession();
		//处理添加员工操作
		//将页面传送的五组数据放在两个数组里面，插入时候按照顺序分别加以判断后插入数据库
		$mysql = new SaeMysql();
		$id[0] = $_POST['id_1'];
		$name[0] = $_POST['name_1'];
		$id[1] = $_POST['id_2'];
		$name[1] = $_POST['name_2'];
		$id[2] = $_POST['id_3'];
		$name[2] = $_POST['name_3'];
		$id[3] = $_POST['id_4'];
		$name[3] = $_POST['name_4'];
		$id[4] = $_POST['id_5'];
		$name[4] = $_POST['name_5'];
		//循环插入数据库
		for($i=0;$i<5;$i++){
			//首先进行数据检验：当id和name都存在时才能插入数据库；
			if($id[$i] && $name[$i]){
				$worker_id = $id[$i];
				$worker_name = $name[$i];
				$company_id = $_SESSION['company_id'];
				$sql = "INSERT INTO  `app_ququsignin`.`worker` (`worker_id` ,`worker_name` ,`company_id`)VALUES ('$worker_id',  '$worker_name',  '$company_id')";
				$res = $mysql->RunSql($sql);
				//$result数组存放插入后的结果，成功为1，失败为0；
				if($res)
				{
					$result[$i] = 1;
				}
				else{
					$result[$i] = 0;
				}
			}
			else{
				$result[$i] = 0;
			}
		}
		//数据插入结束之后回到添加员工页面，准备数据
		//base,css是css文件路径
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$data['result'] = $result;
		$this->load->view('worker_manage_add',$data);
	}
	
	function handle_delete_worker(){
		$this->checkSession();
		//处理删除员工操作
		$worker_id = $_POST['worker_id'];
		$mysql = new SaeMysql();
		$delete_sql = "delete from worker where worker_id = $worker_id";
		$result = $mysql->Runsql($delete_sql);
		if($result){
			$status = 1;//删除成功；
		}else{
			$status = 0;//删除失败;
		}
		//为即将跳转的页面做数据准备
		//base,css是css文件路径
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$data['res'] = 1;//res=1，不需要显示搜索信息，
		//$status 是否删除成功的标志；
		$data['status'] = $status;
		$this->load->view('worker_manage_delete',$data);

	}
	function handle_search(){
		$this->checkSession();
		//删除页面的搜索处理；
		$worker_id = $_POST['worker_id'];
		$mysql = new SaeMysql();
		$sql = "select * from worker where worker_id = $worker_id";
		$res = $mysql->getLine($sql);
		//为即将跳转页面处理数据
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$data['res'] = $res;
		$data['status'] = -1;//-1表示淡出提示框
		$this->load->view('worker_manage_delete',$data);
	}
	//公司信息设置页面
	function set_infor()
	{
		$this->checkSession();
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$res= $this->sql_model->get_company_info($_SESSION['company_id']);
		$data['company_info'] = $res;
		$data['set_result'] = null;
		$this->load->view('set_infor',$data);
	}
	
	function handle_set_info()
	{
		$this->checkSession();
		$data['base'] = $this->config->item('base_url');  
		$data['css'] =$this->config->item('css');
		$arr['company_id'] = $_SESSION['company_id'];
		$arr['company_name'] = $_POST['company_name'];
		$arr['morning_in'] = $_POST['morning_in'];
		$arr['afternoon_in'] = $_POST['afternoon_in'];
		$arr['morning_out'] = $_POST['morning_out'];
		$arr['afternoon_out'] = $_POST['afternoon_out'];
		$data['set_result'] = $this->sql_model->set_company_info($arr);
		$res= $this->sql_model->get_company_info($_SESSION['company_id']);
		$data['company_info'] = $res;
		$this->load->view('set_infor',$data);

	}
	
	function download()
	{
		$type = $_GET['type'];
		$ch=curl_init();
		$stor = new SaeStorage();
		if($type == "pc")
			$url = $stor->getUrl("download","ingsignin.zip");
		else if($type == "apk")
			$url = $stor->getUrl("download","ingsignin.apk");
		 curl_setopt($ch,CURLOPT_URL, $url);
		 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		 $content=curl_exec($ch);
		 if(curl_errno($ch)){ 
			 echo curl_error($ch);
			 curl_close($ch);
		 }else {
			  curl_close($ch);
			  //提取文件名和文件类型
			  $nameArr=explode('/',$url);
			  $last_index=count($nameArr)-1;
			  $file_name=$nameArr[$last_index];
			  $typeArr=explode('.',$url);
			  $last_index=count($typeArr)-1;
			  $file_type=$typeArr[$last_index];
			  //获得文件大小
			  $file_size=strlen($content);
			  //通知浏览器下载文件
			  Header("Content-type: application/'$file_type'");
			  header("Content-Disposition: attachment; filename=".$file_name);
			  header("Content-Length:".$file_size);
			  exit($content); //输出数据流
		 }
	}
}
?>