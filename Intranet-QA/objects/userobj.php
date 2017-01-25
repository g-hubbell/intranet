<?php



class UserObj
{
    public $database;
    public $username;
    public $temppass;
    public $userexists;
    public $sql;
    public $empown;
    public $table;
    private $links;
    private $password;
    const SERVERNAME = "localhost:3306";
    const SERVERUSER = "manager-intra";
    const SERVERPASS = "Genie2222";
    
    
    public function __construct(){
        $this->database = "";
        $this->username = "";
        $this->password = "";
        $this->temppass="";
        $this->sql="";
        $this->empown="";
        $this->userexists=0;
        
    }
    
    public function __construct($database,$username,$temppass){
        $this->database=$database;
        $this->username=$username;
        $this->password=$temppass;
        $this->temppass="";
        $this->userexists=0;
    }
    
    public function __destruct(){
        echo("incorrect information", PHP_EOL);
    }
    
    public function SetUserPass($temppass){
        $this->password=$temppass;
        $this->temppass="";
    }
    public function GetUserPass(){
        return $this->password;
    }
    public function SelectDB($table){
        if($table == "employee_list"){
            $this->table="employee_list";
            $this->database="user_db";
        }
        elseif($table == "owners_managers_list"){
            $this->table="owners_managers_list";
            $this->database="user_db";
        }
        elseif($table == "messages"){
            $this->table="messages";
            $this->database="portal_messages";
        }
        elseif($table == "alert_post"){
            $this->table="alert_post";
            $this->database="intranet_posts";
        }
        elseif($table == "cc_post"){
            $this->table="cc_post";
            $this->database="intranet_posts";
        }
        elseif($table == "defective_post"){
            $this->table="defective_post";
            $this->database="intranet_posts";
        }
        elseif($table == "new_product_post"){
            $this->table="new_product_post";
            $this->database="intranet_posts";
        }
        elseif($table == "ne_post"){
            $this->table="ne_post";
            $this->database="intranet_posts";
        }
        elseif($table == "open_close_post"){
            $this->table="open_close_post";
            $this->database="intranet_posts";
        }
        elseif($table == "request_post"){
            $this->table="request_post";
            $this->database="intranet_posts";
        }
        elseif($table == "schedule_post"){
            $this->table="schedule_post";
            $this->database="intranet_posts";
        }
        
    }
    
    
    public function CheckUser(){
        
        $this->sql ="SELECT * FROM $this->table WHERE Username LIKE '$this->username'";
        
        $result = mysql_query($this->sql);
        $row = mysql_fetch_assoc($result);

        if ($row['Password'] == $this->password){
            
            return true;
        }
        else{
            return false;
        }
    }
    
    public function Connect($table){
            $this->SelectDB($table);
            if(isset($this->database)){

                $this->links = mysql_connect($this::SERVERNAME, $this::SERVERUSER, $this::SERVERPASS);
                mysql_select_db($this->database,$this->links);
                if(mysql_error()){
                    echo(mysql_error());

                }
                else{
                    if($this->userexists == 0){
                        if($this->CheckUser() == false){
                            $this = null;
                            return false;
                        }
                        else{
                            $this->userexists=1;
                            return true;
                        }

                    }
                }


            }
       
            
        
        
    }
}

?>
