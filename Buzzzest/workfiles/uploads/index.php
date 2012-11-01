<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Ajax Upload - Show Image</title>
<style type="text/css">
  #uploadframe { display:none; }
</style>
<script type="text/javascript" src="functions.js"></script>
</head>
<body>

<div id="showimg"> </div>
<form id="uploadform" action="upload_img.php" method="post" enctype="multipart/form-data" target="uploadframe" onsubmit="uploadimg(this); return false">
  <input type="file" id="myfile" name="myfile" />
  <input type="submit" value="Submit" />
  <iframe id="uploadframe" name="uploadframe" src="upload_img.php" width="8" height="8" scrolling="no" frameborder="0"></iframe>
</form>

</body>
</html>
