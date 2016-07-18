<?php 
function download_file($file_name, $file_micro, $file_dir, $file_type ) 
{ 
        // 읽어올 파일명에 이상이있는지 검사한다. 
        if( !$file_name || !$file_micro || !$file_dir ) return 1; 
        if( eregi( "\\\\|\.\.|/", $file_micro ) ) return 2; 


        if( file_exists($file_dir.$file_micro) ) 
        { 
                $fp = fopen($file_dir.$file_micro,"r"); 

                if( $file_type ) 
                { 
                        header("Content-type: $file_type"); 
                        Header("Content-Length: ".filesize($file_dir.$file_micro));     
                        Header("Content-Disposition: attachment; filename=$file_name");   
                        Header("Content-Transfer-Encoding: binary"); 
                        header("Expires: 0"); 
                } 
                else 
                { 
                        if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) 
                        { 
                                Header("Content-type: application/octet-stream"); 
                                Header("Content-Length: ".filesize($file_dir.$file_micro));     
                                Header("Content-Disposition: attachment; filename=$file_name");   
                                Header("Content-Transfer-Encoding: binary");   
                                Header("Expires: 0");   
                        } 
                        else 
                        { 
                                Header("Content-type: file/unknown");     
                                Header("Content-Length: ".filesize($file_dir.$file_micro)); 
                                Header("Content-Disposition: attachment; filename=$file_name"); 
                                Header("Content-Description: PHP3 Generated Data"); 
                                Header("Expires: 0"); 
                        } 
                } 


                fpassthru($fp); 
                fclose($fp); 
        } 
        else return 1; 
} 



// 접근경로 확인 
if (!eregi($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) Error("외부에서는 다운로드 받으실수 없습니다."); 


// 다운로드 방식을 구한다. 
$ext = array_pop(explode(".", $_GET['name'])); 

if ($ext=="avi" || $ext=="asf")         $file_type = "video/x-msvideo"; 
else if ($ext=="mpg" || $ext=="mpeg")   $file_type = "video/mpeg"; 
else if ($ext=="jpg" || $ext=="jpeg")   $file_type = "image/jpeg"; 
else if ($ext=="gif")                   $file_type = "image/gif"; 
else if ($ext=="png")                   $file_type = "image/png"; 
else if ($ext=="txt")                   $file_type = "text/plain"; 
else if ($ext=="zip")                   $file_type = "application/x-zip-compressed"; 

// 실제로 다운로드 받는다. 
$ret = download_file( $_GET['name'], $_GET['name'], $_GET['pwd']."/", $file_type); 

if( $ret == 1 ) Error("지정하신 파일이 없습니다."); 
if( $ret == 2 ) Error("접근불가능 파일입니다. 정상 접근 하시기 바랍니다."); 
?> 
