<?php  
		require_once ('connection.php');  
		require_once ("mailclass.php");  
  
		$userid = trim($_POST['userid']);  
  
		$sql="select userid,email,password from member where userid='$userid'";  
  
		$query=mysql_query($sql,$conn);  
		$num=mysql_num_rows($query);  
		$userinfo=mysql_fetch_array($query);  
  
		if($num<=0){  
			echo "<mce:script type="text/javascript">alert('Username does not exist！');history.back(-1);</mce:script>";  
		exit;  
		}
		else
		{  
  
		$user_id = $userinfo['userid'];  
		$password = $userinfo['password'];  
		$user_email = $userinfo['email'];  
  
		$x = md5($userid.'+'.$password);  
		$string = base64_encode($userid.".".$x);  
		$smtpserver = "ssl://smtp.gmail.com";//SMTP服务器  
		$smtpserverport =465;//SMTP服务器端口    
		$smtpusermail = "app.buma@gmail.com";//SMTP服务器的用户邮箱  
  
		$smtpemailto =$user_email;//发送给谁  
  
  
		$smtpuser = "app.buma@gmail.com";//SMTP服务器的用户帐号  
  
  
		$smtppass = "bumabuma";//SMTP服务器的用户密码  
  
  
		$mailsubject = "[BUMA] Reset Password ";//邮件主题  
  
  
		$mailbody = "Dear ".$userid."：<br />   Please cilck the link to reset the password<br /><a href="http://localhost/in-te/resetUserPass.php?p=".$string."" mce_href="http://localhost/in-te/resetUserPass.php?p=".$string."">http://localhost/in-te/resetUserPass.php?p=".$string."</a><br>(If not working，Please copy the link and paste it into address tag)  
		<br><br>Automatic message.Please do not reply this email";    
	
  
			$mailtype = "HTML";  
			$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass); 
			$smtp->debug = false;  
			$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);  
  
			?>  
              <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">  
                <tr>  
                  <td height="35" align="center"><?  
				echo "<div style="font-size:16px;font-weight:bold;" mce_style="font-size:16px;font-weight:bold;">The password has been sent to:<span style="color=#ff0000" mce_style="color=#ff0000">".$user_email."</span>Please check!</div>";  
   
			}  
			?>