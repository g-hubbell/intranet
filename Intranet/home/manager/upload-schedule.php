<?php
    error_reporting(E_ALL);
    
   if ($_FILES["userFile"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["userFile"]["error"] . "<br>";
    }
    else
    {

        if (file_exists("../../images/schedule2.PNG"))
        {
            unlink('../../images/schedule2.PNG');
            $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../images/schedule2.PNG");
            if(!$upload){
                echo('upload failed');
            }
            else{
               header("location: http://hsglobalinc.com/home/manager/home-manager.php"); 
            }
        }
        else{
        
            $upload= move_uploaded_file($_FILES["userFile"]["tmp_name"], "../../images/schedule2.PNG");
            if(!$upload){
                echo('upload failed');
            }
            else{
               header("location: http://hsglobalinc.com/home/manager/home-manager.php"); 
            }
        }
    }



    
?>