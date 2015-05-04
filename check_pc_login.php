<?php
//C#ถหตฤตวยฝผ์ฒโฃป
		$company_id = trim($_GET['company_id']);
		$password=  trim($_GET['password']);
		$mysql = new SaeMysql();
		$check_sql="select company_name from company where company_id = '$company_id' and company_password = '$password' ";
		$company_name = $mysql->getVar($check_sql);
		if($company_name)
			echo $company_name;
		else
			echo "0";
?>