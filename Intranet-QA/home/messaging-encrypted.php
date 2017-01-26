<?php
    session_start();
    date_default_timezone_set('America/New_York');
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "portal_messages";
    $date = date('m/d/Y');

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        mysql_select_db($database,$link);
    }
    else{
            header('location: http://vapeshop.direct');
            exit();

        
    }


/*SENDER IS KEY*/

    function EncryptMsg($user,$message){
        $gap=count($message);
        $splituser=str_split($user);
        for($i=0;$i<$gap;$i++){
            $splituser=array_push($splituser,$splituser[$i]);
        }
        for($i=0;$i<count($splituser);$i++){
            $asciiuser[$i]=ord($splituser[$i]);
        }
        $splitmsg=explode(" ",$message);
        $k=0;
        for($i=0;$i<count($splitmsg);$i++){
            $splitword=$splitmsg[$i];
            $splitwrdfinal=str_split($splitmsg[$i]);
            for($j=0;$j<count($splitwrdfinal);$j++){
                
                
                $asciimsg[$k]=ord($splitwrdfinal[$j]);
                $k++;
            }
            $asciimsg[$k]="47";
            $k++;
        }
        
        print_r($asciimsg);
        for($i=0;$i<count($asciimsg);$i++){
            
                $asciigap[$i]=$asciiuser[$i]-$asciimsg[$i];
            
        }
        $finalstring=implode(" ",$asciigap);
        echo($finalstring);
        return $finalstring;
        
        
    }

    function DecryptMsg($user,$encmessage){
        $asciimsg=explode(" ",$encmessage);
        print_r($asciimsg);
        $gap=count($asciimsg);
        $splituser=str_split($user);
        for($i=0;$i<$gap;$i++){
            $splituser=array_push($splituser,$splituser[$i]);
        }
        for($i=0;$i<count($splituser);$i++){
            $asciiuser[$i]=ord($splituser[$i]);
        }
        for($i=0;$i<count($asciimsg);$i++){
            
            
                $asciifinal[$i]=$asciiuser[$i]-$asciimsg[$i];
            
            
        }
        print_r($asciifinal);
        for($i=0;$i<count($asciifinal);$i++){
            if($asciifinal[$i] == "47"){
                $arrayplainmsg[$i]="/";
            }
            else{
                $arrayplainmsg[$i]=chr($asciifinal[$i]);
            }
        }
        print_r($arrayplainmsg);
        $finalstr=implode($arrayplainmsg);
        $finalstring=str_replace("/"," ",$finalstr);
        return $finalstring;
        
        
    }



    if(isset($_POST['subject'])){
        $sendto = $_POST['sendto'];
        $subject =$_POST['subject'];
        $message =$_POST['message'];
        
        $encmessage=EncryptMsg('dave',$message);
        echo($encmessage);
        $decmessage=DecryptMsg('dave',$encmessage);
        echo($decmessage);
        
    }
    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/stylesheet.min.css">
        <link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <style>
            body {
                font-family: 'Roboto';
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon"type="image/png" href="http://vapeshop.direct/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
        <title>Holy Smokes Employee Portal</title>
    </head>
    <body>
        <div class = "headerlogo">
            <a href="http://vapeshop.direct/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        <a class = "menu-drop" href="http://vapeshop.direct/home/messaging.php#sendform">Send Message</a>
        
        
        <?php
            echo("<div id='sendform' class ='sendform");
            
                echo("'>");
            
        ?>
            <h2>New Message</h2>
            <form action ="messaging-encrypted.php" method ="POST">
                <p>From: <?php echo($username);?></p><br>
                <?php 
                    
                    echo("<select name='sendto' id='sendto' placeholder='To:' >");
                    $database="user-db";
                    mysql_select_db($database,$link);
                    $sql="SELECT * FROM owners_managers_list WHERE 1=1";
                    $result=mysql_query($sql) or die(mysql_error());
                    while($row = mysql_fetch_assoc($result)){
                        if($row['Username'] !== $username){
                            echo("<option value='".$row['Username']."'>".$row['Username']."</option>" );
                        }
                    }
                
                    $sql="SELECT * FROM employee_list WHERE 1=1";
                    $result=mysql_query($sql);
                    while($row = mysql_fetch_assoc($result)){
                        if($row['Username'] !== $username){
                            echo("<option value='".$row['Username']."'>".$row['Username']."</option>" );
                        }
                    }
                    echo("</select>");
                ?>
                    
                <br>
                <input type="text" placeholder="Subject:" name="subject" id="subject"><br><br>
                <textarea name="message" id="message"></textarea><br>
                <input type="submit" value = "Send" name ="submit" id="submit">
            </form>
        <?php
            echo("</div>");
        ?>
        
        
        
        
        <div class = "inbox">
            <h2>Inbox</h2>
               <table class ='posttable'>  
                <tr>
                    <th>Date: </th>
                    <th>From: </th>
                    <th>To: </th>
                    <th>Subject: </th>
                    <th>Message: </th>
                    <th>Read:</th>
                </tr>
                <?php
                        $database = "portal_messages";
                        mysql_select_db($database,$link);
                        $table = "messages_enc";
                        $result = mysql_query("SELECT * FROM $table WHERE Recipient ='$username'");
                        $tofrom = "to";
                        $i=0;
                            
                            
                            while($row = mysql_fetch_assoc($result)){
                                if($row['Readyet'] == 'Read'){
                                    echo ("<tr>
                                    <td>".$row["Date"]."</td>
                                    <td>".$row["Sender"]."</td>
                                    <td>".$row["Recipient"]."</td>
                                    <td>".$row["Subject"]."</td>
                                    <td>"."<a href = 'http://vapeshop.direct/home/message-view.php?i=".$i."&tofrom=".$tofrom."'>Click to View</a>"."</td>
                                    <td>".$row['Readyet']."</td>
                                    </tr>");
                                    $i++;
                                }
                                else{
                                    echo ("<tr>
                                    <td>".$row["Date"]."</td>
                                    <td>".$row["Sender"]."</td>
                                    <td>".$row["Recipient"]."</td>
                                    <td>".$row["Subject"]."</td>
                                    <td>"."<a href = 'http://vapeshop.direct/home/message-view.php?i=".$i."&tofrom=".$tofrom."'>Click to View</a>"."</td>
                                    <td>".$row['Readyet']."</td>
                                    </tr>");
                                    $i++;
                                }
                                
                                }
                            
                            
                            
                            
                        
                    
                    ?>
                </table>
                
        </div>
                    
            
                    
                            
                                    
                                            
                                                            
        <div class ="outbox">
            <h2>Outbox</h2>
                <?php
                        
                        $table = "messages_enc";
                        $result = mysql_query("SELECT * FROM $table WHERE Sender ='$username'");
                        $tofrom = "from";
                        $i=0;
            
                            echo("<table class ='posttable'>  <tr>
                                    <th>Date: </th>
                                    <th>From: </th>
                                    <th>To: </th>
                                    <th>Subject: </th>
                                    <th>Message: </th>
                                    <th>Read: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result)){
                                
                                if($row['Readyet'] == 'Read'){
                                    echo ("<tr>
                                    <td>".$row["Date"]."</td>
                                    <td>".$row["Sender"]."</td>
                                    <td>".$row["Recipient"]."</td>
                                    <td>".$row["Subject"]."</td>
                                    <td>"."<a href = 'http://vapeshop.direct/home/message-view.php?i=".$i."&tofrom=".$tofrom."'>Click to View</a>"."</td>
                                    <td>".$row['Readyet']."</td>
                                    </tr>");
                                    $i++;
                                }
                                else{
                                    echo ("<tr>
                                    <td>".$row["Date"]."</td>
                                    <td>".$row["Sender"]."</td>
                                    <td>".$row["Recipient"]."</td>
                                    <td>".$row["Subject"]."</td>
                                    <td>"."<a href = 'http://vapeshop.direct/home/message-view.php?i=".$i."&tofrom=".$tofrom."'>Click to View</a>"."</td>
                                    <td>".$row['Readyet']."</td>
                                    </tr>");
                                    $i++;
                                }
                                }
                            
                            
                            
                            echo ("</table>");
                        
                    
                    ?>
        </div>
    </body>
</html>