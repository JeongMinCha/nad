<?php
  $db = new SQLite3("/mnt/etc/db/nad.db");
  $db->exec("
             CREATE TABLE userinfo ( username VARCHAR(30) NOT NULL,
                                     password VARCHAR(30) NOT NULL );
             CREATE TABLE ftpinfo ( ftpname VARCHAR(30) NOT NULL,
     	         		username VARCHAR(30) NOT NULL,
        	     		password VARCHAR(30) NOT NULL,
             			ip VARCHAR(30) NOT NULL,
             			port VARCHAR(30));
             INSERT INTO userinfo VALUES ('cjm', '1234');
            ");
?>
