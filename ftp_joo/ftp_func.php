<script type="text/javascript">
// iframe resize
function autoResize(i)
{
    var iframeHeight=
    (i).contentWindow.document.body.scrollHeight;
    (i).height=iframeHeight+20;
}
</script>

<?php
$root = "/share/";

function rmdirAll($dir) {
   $dirs = dir($dir);
   while(false !== ($entry = $dirs->read())) {
      if(($entry != '.') && ($entry != '..')) {
         if(is_dir($dir.'/'.$entry)) {
            rmdirAll($dir.'/'.$entry);
         } else {
            @unlink($dir.'/'.$entry);
         }
       }
    }
    $dirs->close();
    @rmdir($dir);
}

function display_list_ftp($servername, $username, $password, $ip, $port) {


  $command = "df | grep ".$ip;

  $result = shell_exec($command);


  if(is_null($result)){
    if(!is_dir("/share/".$servername)){
      shell_exec("mkdir /share/".$servername);
    } else {
    }
    $command = "mount -t cifs ".$ip." /share/".$servername." -o user=".trim($username).",password=".$password;
    if(strlen($port)>1){
      $command = $command."port=".$port;
    }
    

    $result = shell_exec($command);
    $command = "df | grep ".$ip;
    $result = shell_exec($command);
 
  }

  if(is_null($result)){
    echo "mount is fail...<br/>";
  } else {

?>
<iframe src="./ftp_joo/display_ftp_page.php?dir=<?php echo $servername ?>" scrolling="yes" frameborder="0" width="100%" height=800px></iframe>
<?php
  }
}
?>
