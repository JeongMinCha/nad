<?php
class MyDB extends SQLite3
{
  function __construct()
  {
    $this->open('/mnt/etc/db/nad.db');
  }
}

function num (){

}

function login ($username, $password){

        $db = new MyDB();

        $statement = $db->prepare('SELECT * FROM userinfo WHERE username=:username AND password=:password');
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);

        $result = $statement->execute();

        while ($row = $result->fetchArray()){
                $name_cmp = strcmp($username, $row['username'].PHP_EOL);
                $pass_cmp = strcmp($password, $row['password'].PHP_EOL);
                if ($name_cmp && pass_cmp){
                        //echo "login success!\n";
                        return true;
                }
        }
        throw new Exception('cannot log in.');
}

function name_exist_check ($username, $password){

        $exist = 0;
        $db = new MyDB();

        $statement = $db->prepare('SELECT * FROM userinfo WHERE username=:username AND password=:password');
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);

        $result = $statement->execute();

        while ($row = $result->fetchArray())
        {
                $cmp = strcmp($username, $row['username'].PHP_EOL);
                if ($cmp){
                        $exist = 1;
                }
       }
       return $exist;
}
function register ($username, $password){                                               
                                                                                        
        if(name_exist_check ($username, $password) == 1)                                
        {                                                                               
                //echo "already exist!!\n";                                               
        }                                                                               
        else                                                                            
        {                                                                               
                $db = new MyDB();                                                       
                //echo "ok - insert!\n";                                                  
                $statement = $db->prepare('INSERT INTO userinfo VALUES (:username, :password);');
                $statement->bindValue(':username', $username);                          
                $statement->bindValue(':password', $password);                          
                $statement->execute();                                                  
        }                                                                               
}

//make_db();
//register('cjm', '12345678');
?>
