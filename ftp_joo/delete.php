<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko"  xml:lang="ko">
<head>
</head>
<body>
<h1>delete file...</h1>
<?php
  $path = $_GET["path"];
  if ( is_file($path) ) { 
    if (is_writable($path) ) { 
        unlink($path); 
        echo '파일 삭제됨.'; 
    } else { 
        echo '파일에 대한 쓰기(삭제) 권한 없음.'; 
    } 
  } else { 
    echo '파일이 아니거나 없음.'; 
  }
?>
</body>
</html>
