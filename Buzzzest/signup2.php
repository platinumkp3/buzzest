<?php

?>
<link href="css/home.css" type="text/css" />
<div>
Buzzzest <br />
Lets Buzz & Zest Your World
<div style="float:right"><a href="index.php" >Home</a> </div>
</div>
<br />
<div id="divborder">
<table width="439" height="393"  align="center" cellpadding="0" cellspacing="0"  border="1">
  <tr>
    <td width="160">Select Your Account:</td>
    <td width="241">
    <select name="account" > 
    <option value="0" >Select</option>
    <option value="1" >Individual</option>
    <option value="2" >Organization</option>    
    </select>
    </td>
  </tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="name" id="name" /></td>
  </tr>
  <tr>
    <td>Username :</td>
    <td><input type="text" name="user_name" id="user_name" /></td>
  </tr>
  <tr>
    <td>Email Id:</td>
    <td><input type="email" name="email" id="email" /></td>
  </tr>
  <tr>
    <td>Password :</td>
    <td><input type="password" name="password" id="password" /></td>
  </tr>
  <tr>
    <td>Description:</td>
    <td><textarea name="description" id="description" rows="3" cols="25"></textarea></td>
  </tr>
  <tr>
    <td>Website :</td>
    <td><input type="text" name="website" id="website" /></td>
  </tr>
  <tr>
   <td colspan="2" align="center"><input type="checkbox" checked="checked"  />I agree th terms of Services</td>
  </tr>
  <tr>
   <td align="center" ><input type="submit" value="Finish" name="Finish" id="Finish" /></td>
   <td>&nbsp;</td>
  </tr>
</table>
</div>