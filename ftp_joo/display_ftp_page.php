<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko"  xml:lang="ko">
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<style type="text/css">
  span { vertical-align:middle;}
  .type { float:right;
          text-align:center;
        }
  .date { float:right;
          text-align:center;}
  .list {
          height:40px;
        }
  .del { float:right; text-align:center;}
  .nav { float:left; 
         margin-left:20px;
       }
  
  a:link {color:black;text-decoration:none;}
  a:visited {color:black;text-decoration:none;}
  a:hover {color:blue;text-decoration:underline;}
         
</style>

</head>
<body>
<?php
  require_once ('ftp_func.php');

  $sub_dir = $_GET['dir'];
  $pwd = $root.$sub_dir;
  $dir = dir($pwd);

  echo $sub_dir;
  echo "data dir <br/>";
  echo $pwd;
  echo "<br/>";
 
?>
<div data-role="page">
  <div data-role="header" data-position="fixed">
    <span class="nav"><h3>
      <?php 
      $sub = explode('/',$sub_dir);
      $count = count($sub);
      $history .= $sub[0];
      echo '<a href="display_ftp_page.php?dir='.urlencode($history).'">'.$sub[0]."</a>&nbsp;";
      $history .="/";
      for($i=1; $i<$count; $i++)
      {
        $history .= $sub[$i];
        echo '>&nbsp;<a href="display_ftp_page.php?dir='.
             urlencode($history).'">'.$sub[$i].'</a>&nbsp;';
        $history .="/";
      } 
      ?>
    </h3></span>
  </div>
  <div data-role="main" class="ui-content">
    <?php
    while(false !== ($file = $dir->read()))
    {
      $name = basename($file);

      if($name != "." && $name != "..")
      {
        // case of dir
        if(is_dir($pwd."/".$name))
        {
    ?> 
    <div class="ui-grid-c list"> 
      <div class="ui-block-a">
        <a href="display_ftp_page.php?dir=<?php echo $sub_dir.'/'.$name?>"><?php echo $name;?></a>
      </div>      
      <div class="ui-block-b">
        <span class="type"><b>폴더</b></span>
      </div>
      <div class="ui-block-c">
        <span class="date"><?php echo date("m-d H:i", filemtime($pwd.'/'.$name)); ?></span>
      </div>
      <div class="ui-block-d">
        <span class="del"><a href="rmdir.php?path=<?php echo $pwd.'/'.$name;?>">del</a></span>
      </div>
    </div>
    <?php
        }
        // case of file
        if(is_file($pwd."/".$name))
        {
    ?>
    <div class="ui-grid-c list">
      <div class="ui-block-a">
        <a href='download.php?pwd=<?php echo $pwd."&name=".$name; ?>'><?php echo $name ?></a>
      </div>
      <div class="ui-block-b">
        <span class="type"><b>파일</b></span>
      </div>
      <div class="ui-block-c">
        <span class="date"><?php echo date("m-d H:i", filemtime($pwd.'/'.$name)); ?></span>
      </div>
      <div class="ui-block-d">
        <span class="del"><a href="delete.php?path=<?php echo $pwd.'/'.$name;?>">del</a></span>
      </div>
    </div>
    <?php 
        }
      }
    }
    ?>
  </div>
  <div data-role="footer" data-position="fixed">
    <div class="ui-grid-a">
      <div class="ui-block-a">
        <form name="upload" enctype="multipart/form-data" action="upload.php" method=post>
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> 
          <input type="hidden" name="path" value='<?php echo $pwd; ?>'/>
          <input type="file" name="file"/>
          <input type="submit" value="Upload File"/>
        </form>
      </div>
      <div class="ui-block-b">
        <form name="mkdir" action="mkdir.php" method=post>
          <input type="hidden" name="path" value='<?php echo $pwd; ?>'/>
          <input type="text" name="dirname" />
          <input type="submit" class='ui-btn-inline' data-mini=true value="Make Dir"/>
        </form>
      </div>
    </div>
  </div>
</div>

<?php

 $dir->close();

?>
</body>
</html>
