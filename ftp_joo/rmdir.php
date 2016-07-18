<html xmlns="http://www.w3.org/1999/xhtml" lang="ko"  xml:lang="ko">
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<head>
</head>
<body>
<h1>Delete Directory...</h1>
<?php
  require_once ('ftp_func.php');
  $path = $_GET["path"];
  rmdirAll($path); 
?>
      
</body>
</html>
