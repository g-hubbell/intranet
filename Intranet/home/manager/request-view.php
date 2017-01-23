<?php
    session_start();
    date_default_timezone_set('America/New_York');
    
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "intranet_posts";
    $table="request_post";

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
        mysql_select_db($database,$link);
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
        <title>Holy Smokes Employee Portal</title>
        <link rel="icon"type="image/png" href="http://hsglobalinc.com/favicon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png" />
    </head>
    
    
    <body>
       
        <div class = "headerlogo">
            <a href="http://hsglobalinc.com/home/manager/home-manager.php"><img class = "headerimg" src="../../images/logo.png"></a>
        </div><br>
        
        
        <div class = "restock">
            <h3>Restock</h3>
            <?php
                        $section="restock";
                        $result = mysql_query("SELECT * FROM $table WHERE Requesttype ='$section'");
                        if(!$result){
                            echo('connection issue' . mysql_error());
                        }
                        $i=0;
            
                            echo("<table>  <tr>
                                    <th>Date: </th>
                                    <th>Posted By: </th>
                                    <th>Store Code: </th>
                                    <th>Request: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result) and $i<5){
                                
                                echo "<tr><td>".$row["Date"]."</td><td>".$row["Username"]."</td><td>".$row["Storecode"]."</td><td> ".$row["Request"]."</td></tr>";
                                $i++;
                                
                                }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
            
        </div>
        
        <div class="product">
            <h3>New Product</h3>
            <?php
                        $section="product";
                        $result = mysql_query("SELECT * FROM $table WHERE Requesttype ='$section'");
                        $i=0;
            
                            echo("<table>  <tr>
                                    <th>Date: </th>
                                    <th>Posted By: </th>
                                    <th>Store Code: </th>
                                    <th>Request: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result) and $i<5){
                                
                                echo "<tr><td>".$row["Date"]."</td><td>".$row["Username"]."</td><td>".$row["Storecode"]."</td><td> ".$row["Request"]."</td></tr>";
                                $i++;
                                
                                }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
            
            
        </div>
        
        
        <div class = "transfer">
            <h3>Transfer</h3>
            <?php
                        $section="transfer";
                        $result = mysql_query("SELECT * FROM $table WHERE Requesttype ='$section'");
                        $i=0;
            
                            echo("<table>  <tr>
                                    <th>Date: </th>
                                    <th>Posted By: </th>
                                    <th>Store Code: </th>
                                    <th>Request: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result) and $i<5){
                                
                                echo "<tr><td>".$row["Date"]."</td><td>".$row["Username"]."</td><td>".$row["Storecode"]."</td><td> ".$row["Request"]."</td></tr>";
                                $i++;
                                
                                }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
            
        </div>
        
        
        <div class = "signage">
            <h3>Signage</h3>
            <?php
                        $section="signage";
                        $result = mysql_query("SELECT * FROM $table WHERE Requesttype ='$section'");
                        $i=0;
            
                            echo("<table>  <tr>
                                    <th>Date: </th>
                                    <th>Posted By: </th>
                                    <th>Store Code: </th>
                                    <th>Request: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result) and $i<5){
                                
                                echo "<tr><td>".$row["Date"]."</td><td>".$row["Username"]."</td><td>".$row["Storecode"]."</td><td> ".$row["Request"]."</td></tr>";
                                $i++;
                                
                                }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
        </div>
        
        <div class ="time-off">
            <h3>Time-off</h3>
            <?php
                        $section="time-off";
                        $result = mysql_query("SELECT * FROM $table WHERE Requesttype ='$section'");
                        $i=0;
            
                            echo("<table>  <tr>
                                    <th>Date: </th>
                                    <th>Posted By: </th>
                                    <th>Store Code: </th>
                                    <th>Request: </th>
                                </tr>");
                            while($row = mysql_fetch_assoc($result) and $i<5){
                                
                                echo "<tr><td>".$row["Date"]."</td><td>".$row["Username"]."</td><td>".$row["Storecode"]."</td><td> ".$row["Request"]."</td></tr>";
                                $i++;
                                
                                }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
        </div>
        
        
    </body>
    
</html>