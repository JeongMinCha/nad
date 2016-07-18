<html xmlns="http://www.w3.org/1999/xhtml" lang="ko"  xml:lang="ko">
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<head>
</head>
<body>
<h1>Make dir...</h1>
<?php
  require_once ('ftp_func.php');
 
  $path = $_POST["path"];
  $dirname = $_POST["dirname"];
  
  $pwd=$path.'/'.$dirname;
 
  if(is_dir($pwd)){
    echo "폴더 가있습니다"; 
  } else {
    echo "폴더 생성!";
	@mkdir($pwd, 0777);
  }

?>
</body>
</html>
