<?php  
/** 
 * 用base64_decode解开$_GET['p']的值 
*/  
$p=$_GET['p'];  
$array = explode('.',base64_decode($p));  
//echo "<br>";  
/** 
 * 这时，我们会得到一个数组，$array，里面分别存放了用户名和我们需要一段字符串 
 * $array[0] 为用户名 
 * $array[1] 为我们生成的字符串 
*/  
//好了，我们开始进行匹配工作吧。  
  
$sql = "select password from member where username = '".trim($array['0'])."'";  
//echo $sql;  
$query=mysql_query($sql,$conn);  
$rs=mysql_fetch_array($query);  
  
$password = $rs['password'];  
/** 
 * 产生配置码  
*/  
 $checkCode = md5($array['0'].'+'.$password);  
/** 
 * 进行配置验证： =>  
*/  
?>  
<?  
if( $array['1'] === $checkCode ){  
  
       //执行重置程序，一般给出三个输入框。   
       echo "<form name='form1' id='form1' method='post' action='' onSubmit='return CheckForm()'>";  
       echo "<table width='80%' border='0' cellspacing='0' cellpadding='0'>";  
              echo "<tr>";  
                echo "<td width='28%' align='right'> </td>";  
                echo "<td width='10%' height='30' align='right'>用 户 名：</td>";  
                echo "<td width='62%' align='left'>".$array['0']."<input name='username' type='hidden' id='username' value='".$array['0']."'/></td>";  
              echo "</tr>";  
              echo "<tr>";  
                echo "<td align='right'> </td>";  
                echo "<td height='30' align='right'>新 密 码：</td>";  
                echo "<td align='left'><input name='newpassword' type='password' id='newpassword' class='in'/></td>";  
             echo " </tr>";  
              echo "<tr>";  
                echo "<td align='right'> </td>";  
                echo "<td height='30' align='right'>确认密码：</td>";  
                echo "<td align='left'><input name='conpassword' type='password' id='conpassword' class='in'/></td>";  
              echo "</tr>";  
              echo "<tr>";  
                echo "<td align='right'> </td>";  
                echo "<td height='50' colspan='2' align='left'><div style="margin-left:30px" mce_style="margin-left:30px"><input type='submit' name='update' style='background:url(images/bo2.jpg); height:36px; width:113px; border:none; font-size:14px; font-weight:bold; color:#FFFFFF' value=' 修改密码 ' /></div></td>";  
             echo " </tr>";  
            echo "</table> ";  
       echo "</form>";  
}else{  
       //给出定义错误页面  
       //header('location:error.php');  
       print"<mce:script type="text/javascript"><!--  
location.href='error.php';  
// --></mce:script>";//*/  
}  
  
if($_POST['username']){  
        $username = trim($_POST['username']);  
       $newpassword=trim($_POST['newpassword']);  
       $newpassword=md5("$newpassword".ALL_PS);  
      
    $sql="update member set password='$newpassword' where username='$username'";  
    //echo $sql;  
    //exit;  
    mysql_query($sql,$conn);  
    print"<mce:script type="text/javascript"><!--  
alert('密码修改成功!');location.href='login.php';  
// --></mce:script>";//*/  
    }  
?> 