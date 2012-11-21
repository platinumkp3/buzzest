<?php

$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 12) . ",12";

$con = mysql_connect("localhost", "username", "password");
mysql_select_db("database_name");


$result = mysql_query("select  * from scroll_images order by id asc limit $set_limit");



$html = '';

while ($row = mysql_fetch_array($result)) {
    $html .= "<div><img src='images/" . $row['name'] . ".jpg' /></div>";
}


echo $html;
exit;
?>
