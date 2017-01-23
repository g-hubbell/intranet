<?php
    session_start();
    date_default_timezone_set('America/New_York');
    
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "intranet_posts";

    if(isset($_SESSION['user']) and $tablename == "owners_managers_list"){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        mysql_select_db($database,$link);
    }
    elseif(isset($_SESSION['user']) and $tablename == "employee_list"){
        header("location: http://hsglobalinc.com/home/employee/home.php");
        exit();
    }
    else{
            header('location: http://hsglobalinc.com');
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
        <link rel="icon"type="image/png" href="http://hsglobalinc.com/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
        <title>Holy Smokes Employee Portal</title>
    </head>
    
    
    <body>
       
        <div class = "headerlogo">
            <a href="http://hsglobalinc.com/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        <a class="menu-drop" href="http://hsglobalinc.com/home/manager/home-manager.php#action">Menu</a>
        
        
        <div id ="action" class = "actions">

            <ul class = "actions">
               <li> <a class="first" href = "http://hsglobalinc.com/home/manager/new-post.php"><br>New Post</a></li>
               <li><a href="submit-request.php"><br>Send New Request</a></li>
               <li><a href ="../../images/schedule.PNG" ><br>View Schedule</a></li>
               <li><a href="../messaging.php">
                  <?php
                    echo("Direct Messaging ");
                    $i=0;
                    mysql_select_db('portal_messages',$link);
                    $sql = "SELECT * FROM messages WHERE Recipient='$username'";
                    $result = mysql_query($sql);
                    while($row = mysql_fetch_assoc($result)){
                        if($row['Readyet'] !== 'Read'){
                            $i++;
                        }
                    }
                    if($i>0){
                       echo("<p class='color-red'>(".$i.")</p>");
                    }
                   else{
                    echo("(".$i.")");
                   }
                    
                    ?>
                   </a></li>
                <li><a href="../product-check-in.php"><br>Product Check-In</a></li>
                <li><a href="../defective-product.php#form"><br>Defective Products</a></li>
               <li><a href="../change-password.php"><br>Change Password</a></li>
               <li><a href="../knowledge-base.php"><br>Knowledge Base</a></li>
               <li><a href="../form-download.php"><br>Form Download</a></li>
               
            </ul>
            
        </div>
        
        <div class="homepage">
        
        
        
        <div class="acctinfo">
            <h3>Acct Info</h3>
            <h5>Username: <?php  echo($username);?> </h5>
            
               
            
               <h5>Account Type: Manager</h5>
            
        </div>
        
        
        
        
        <a href="../alerts.php" class="divlink">
            <div class = "alerts">
                <h3 class = "boxhead">Alerts</h3>
                <?php
                        
                        $table = "alert_post";
                        mysql_select_db('intranet_posts',$link);
                        $result = mysql_query("SELECT * FROM $table ORDER BY Date DESC LIMIT 1");
                        $date = date("m/d/Y");
                        $i=0;
                            while($row = mysql_fetch_assoc($result) and $i < 1){
                                echo('<h4 class = "boxhead">Latest Post: </h4> ');
                                echo ("<p class='recent-post");
                                if($date == $row["Date"]){
                                    echo(" color-red'>" );
                                    }
                                else{
                                    echo("'>");
                                }
                                echo($row["Date"]."</p>");
                                echo("<p class ='hovershow'>");
                                echo($row["Post"]."</p>");
                                $i++;
                                
                            }
                            
                        
                    
                    ?>
            </div>
        </a>
        
        
        <a href="../cc.php"class="divlink">
            <div class ="cc">
                <h3 class = "boxhead">CC</h3>
                <?php
                        
                        $table = "cc_post";
                        $result = mysql_query("SELECT * FROM $table ORDER BY Date DESC LIMIT 1");
                        $date = date("m/d/Y");
                        $i=0;
                            while($row = mysql_fetch_assoc($result) and $i < 1){
                                echo('<h4 class = "boxhead">Latest Post: </h4> ');
                                echo ("<p class='recent-post");
                                if($date == $row["Date"]){
                                    echo(" color-red'>" );
                                    }
                                else{
                                    echo("'>");
                                }
                                echo($row["Date"]."</p>");
                                echo("<p class ='hovershow'>");
                                echo($row["Post"]."</p>");
                                $i++;
                                
                            }
                            
                        
                    
                    ?>
            </div>
        </a>
        <br>
        <a href="../ne.php"class="divlink">
            <div class = "ne">
                <h3 class = "boxhead">NE</h3>
               <?php
                        
                        $table = "ne_post";
                        $result = mysql_query("SELECT * FROM $table ORDER BY Date DESC LIMIT 1");
                        $date = date("m/d/Y");
                        $i=0;
                            while($row = mysql_fetch_assoc($result) and $i < 1){
                                echo('<h4 class = "boxhead">Latest Post: </h4> ');
                                echo ("<p class='recent-post");
                                if($date == $row["Date"]){
                                    echo(" color-red'>" );
                                    }
                                else{
                                    echo("'>");
                                }
                                echo($row["Date"]."</p>");
                                echo("<p class ='hovershow'>");
                                echo($row["Post"]."</p>");
                                $i++;
                                
                            }
                            
                        
                    
                    ?>
            </div>
        </a>
        
        <a href ="../../images/schedule.PNG" download="schedule.PNG" class ='schedule'>
            <div class = "schedule">
                <h3 class = "managerschedule">Schedule</h3><br>
                    <form action ="upload-schedule.php" method = "POST" enctype="multipart/form-data">
                        <input type = "file" name="userFile" id="userFile">
                        <input type = "submit" value = "Upload" id ="submit" name = "submit">
                    </form>
                <?php 
                    $day=date("D");
                    if($day == "Thu" or $day == "Fri"){
                        echo("<img src='http://hsglobalinc.com/images/schedule.PNG' class = 'schedule-image'><br>");
                        echo("<h3>Next Week:</h3>");
                        echo("<img src='http://hsglobalinc.com/images/schedule2.PNG' class = 'schedule-image'>");
                        
                    }
                    elseif($day == "Sat"){
                        if(file_exists("../../images/schedule2.PNG")){
                            unlink("../../images/schedule.PNG");
                            rename("../../images/schedule2.PNG","../../images/schedule.PNG");
                            echo("<img src='http://hsglobalinc.com/images/schedule.PNG' class = 'schedule-image'>");
                        }
                        else{
                            echo("<img src='http://hsglobalinc.com/images/schedule.PNG' class = 'schedule-image'>");
                        }
                    }
                    else{
                        echo("<img src='http://hsglobalinc.com/images/schedule.PNG' class = 'schedule-image'>");
                    }
                ?>
                
            </div>
        </a>
    </div> 
    </body>
    
</html>