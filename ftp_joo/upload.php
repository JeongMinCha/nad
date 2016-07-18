<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko"  xml:lang="ko">
<head>
</head>
<body>
<h1>Uploading file...</h1>
<?php
  $path = $_POST["path"];
  echo $file['name'];

  // upload the file
    echo "업로드한 파일명 : ".$_FILES["file"]["tmp_name"]."<br/>";
    echo $path;
    echo basename($_FILES['file']['name']);
  if(is_uploaded_file($_FILES['file']["tmp_name"]))
  {
    echo "업로드한 파일명 : ".$_FILES["userfile"]["name"]."<br/>";
	$dest=$path."/".basename($_FILES['userfile']['name']);
  
    if(!move_uploaded_file($_FILES["userfile"]["tmp_name"], $dest)){
      echo "파일 업로드 실패";
    }
  }

?>
</body>
</html>
