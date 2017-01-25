
   
<?php
    session_start();
    date_default_timezone_set('America/New_York');
    
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $iterator=$_GET['i'];
    $tofrm=$_GET['tofrom'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "portal_messages";
    

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
         mysql_select_db($database,$link);
      
                    
    }
    else{
            header('location: http://vapeshop.direct');
            exit();

        
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
        
        <div class="viewmesg">
           <h2>View Message</h2>
            <?php
                $i=0;
                if($tofrm =="to"){
                   $sql = "SELECT * FROM messages WHERE Recipient ='$username'"; 
                }
                elseif($tofrm =="from"){
                    $sql = "SELECT * FROM messages WHERE Sender ='$username'";
                }
                $result = mysql_query($sql);
                while($row = mysql_fetch_assoc($result)){
                    if($i == $iterator){
                        echo ("     <h4>Date: ".$row["Date"]."</h4>
                                    <h4>From: ".$row["Sender"]."</h4>
                                    <h4>To: ".$row["Recipient"]."</h4>
                                    <h4>Subject: ".$row["Subject"]."</h4>
                                    <h4>Message:</h4>
                                    <p>".$row['Message']."</p>");
                                    $i++;
                        if($tofrm == "to" and $row['Readyet'] != "Read"){
                            $mes = $row['Message'];
                            $sql = "UPDATE messages SET Readyet = 'Read' WHERE Message='$mes'";
                            mysql_query($sql);
                        }
                    }
                    
                    else{
                        $i++;
                    }
                }
                
            ?>
        </div>
        <div class="sendfrm">
            <h2>Reply</h2>
            <form action ="messaging.php" method ="POST">
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
        </div>
    </body>
</html>