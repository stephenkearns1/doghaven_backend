<?php


    
if(isset($_POST["Token"])) {
    
    $Token = $_POST ["Token"];
    
    $conn = mysqli_connect("localhost", "root","", "FB");
 
 
    $query = "INSERT INTO  USERS(Token) Values  ('$Token') ON DUPLICATE KEY
     UPDATE Token = '$token'; ";
    
    mysqli_query($conn,$query);
    
    mysqli_close($conn);
    

    
}

?>
