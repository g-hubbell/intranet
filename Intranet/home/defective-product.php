<?php
    session_start();
    error_reporting(E_ALL);
    date_default_timezone_set('America/New_York');
    
    $username = $_SESSION['user'];
    $tablename = $_SESSION['table'];
    $servername = "localhost:3306";
    $serveruser = "manager-intra";
    $serverpass = "Genie2222";
    $database = "intranet_posts";
    $date=date('m/d/Y');
    

    if(isset($_SESSION['user'])){
        
        $link =  mysql_connect($servername, $serveruser, $serverpass);
         mysql_select_db($database,$link);
      
                    
    }
    else{
            header('location: http://hsglobalinc.com');
            exit();

        
    }

    if(isset($_POST['submit1'])){
        $sku=$_POST['sku'];
        $dept=$_POST['dept'];
        $defecttype=$_POST['defecttype'];
        $desc=$_POST['desc'];
        
        $sql="INSERT INTO defective_post (Date,Username,SKU,Department,Defecttype,Description,Resolved) VALUES ('$date','$username','$sku','$dept','$defecttype','$desc','')";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
            echo("Defect Submitted!");
        }
        
        
        
    }
    if(isset($_GET['skus'])){
        $SKU=$_GET['skus'];
        $sql="UPDATE defective_post SET Resolved = 'Resolved' WHERE SKU ='$SKU'";
        $result=mysql_query($sql);
        if(!$result){
            echo(mysql_error());
        }
        else{
            echo("defect resloved");
        }
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
        
       <div class = "splitpage">
           <ul>
               <li><a class="left" href = "http://hsglobalinc.com/home/defective-product.php#form">Defective Product Form</a></li>
               <li><a class="right" href ="http://hsglobalinc.com/home/defective-product.php#database">Defective Product List</a></li>
           </ul>
       </div>
       
      <div id="form">
          <form action="defective-product.php" method="POST">
              <p><?php echo($username);?></p>
              <p><?php echo($date);?></p>
              <input type="text" id ="sku" name="sku" placeholder="SKU">
              <input type="text" id ="dept" name="dept" placeholder="Department">
              <input type="text" id="defecttype" name="defecttype" placeholder="Defect Type">
              <p>Description of defect:</p>
              <textarea id="desc" name="desc"></textarea>
              <input type="submit" value="Submit" name="submit1" id="submit1">
          </form>
      </div>
      <div id="database">
          <?php
                        
                        $table = "defective_post";
                        $result = mysql_query("SELECT * FROM $table ORDER BY Date DESC");
            
                            echo("<table class ='posttable'>  <tr>
                                    <th>Date: </th>
                                    <th>Username : </th>
                                    <th>SKU: </th>
                                    <th>Department: </th>
                                    <th>Defect Type: </th>
                                    <th>Description: </th>
                                    <th>Resolved: </th>
                                </tr>");
          
                            while($row = mysql_fetch_assoc($result)){
                                
                                if($row['Resolved'] == "Resolved"){
                                    echo(
                                    "<tr>
                                    <td>".$row['Date']."</td>
                                    <td>".$row['Username']."</td>
                                    <td>".$row['SKU']."</td>
                                    <td>".$row['Department']."</td>
                                    <td>".$row['Defecttype']."</td>
                                    <td>".$row['Description']."</td>
                                    <td>".$row['Resolved']."</td>
                                    
                                    
                                    </tr>"
                                    );
                                }
                                else{
                                    $sku=$row['SKU'];
                                    echo(
                                        
                                    "<tr>
                                    <td>".$row['Date']."</td>
                                    <td>".$row['Username']."</td>
                                    <td>".$row['SKU']."</td>
                                    <td>".$row['Department']."</td>
                                    <td>".$row['Defecttype']."</td>
                                    <td>".$row['Description']."</td>
                                    <td><a href='http://hsglobalinc.com/home/defective-product.php?skus=".$sku."'>Not Resloved</a></td>
                                    </tr>" 
                                    );
                                }
                                
                                
                                
                            }
                            
                            
                            
                            echo "</table>";
                        
                    
                    ?>
      </div>
         
    
       </body>
       
      
</html>