<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="./css/main.css" type="text/css"/>
<script src="js/jquery-1.8.2.js" type="application/javascript" >
</script>

<title>Buzzzest</title>

<script type="application/javascript" >
 function chkLogin()
	 {	
	 	if($("#username").val()== "" )
		{
			$("#uname").text("Please Enter User Name");
			return false;
		}
		else if($("#passwrd").val()=="")
		{
			$("#psswrd").text("Please Enter Password");
			return false;
		}	 
		else
		{
			return true;
		}
	 }
</script>
</head>

<body>

	<div id="header" style="border-bottom:1px solid #000;">
		Become a Buzzzest today! <a href="signup.php" >Sign Up</a> 
		<div style="float:right;margin-right:1%;">
			Alreday a Buzzzest <a href="" >Sign In</a>
		</div>
	</div>

	<div style="display:block;float:left;margin-left:35%;margin-top:3%;">
		<!--<image src="./images/bee2.gif" width="150" height="" style="margin-left:8%;"/><br/>-->
		<b style="font-size:45px;margin-left:8%;">Buzzzest</b><br/>
		<b>Lets Buzz & Zest Your World.</b><br/>
		<div id="index_search">
			<input type="text" style="width:100%;"/>
		</div>
		
	</div>
	<div id="sign_in">
		<form name="frmlogin" id="frmlogin" method="post" action="checkaccount.php" onSubmit="return chkLogin();" >
			<table width="234" height="155" align="right"  cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">Username</td>
				</tr>
				<tr>
					<td colspan="2"><input type="text"  name="username" id="username" /></td>
				</tr>
                <tr>
					<td colspan="2"><label id="uname" /></td>
				</tr>
				<tr>
					<td colspan="2">Password</td></tr>
				<tr>
					<td colspan="2"><input type="password" name="passwrd" id="passwrd" /></td>
				</tr>
                 <tr>
					<td colspan="2"><label id="psswrd" /></td>
				</tr>
				<tr>
					<td ><input type="submit" value="login" name="SignIn" id="SignIn"  /></td><td><a href="" >Forget Password?</a></td>
				</tr>
                
				<!--<tr>
				<?php
				/*$error='';
					$error=$_REQUEST['error'];
					if ($error == 1)
					{ ?>
						<td colspan="2">Please check your username and password</td>		
			   <?php } */
					?>
				</tr>-->
			</table>
		</form>
	</div>
</body>
</html>