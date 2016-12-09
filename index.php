<?php

include("scripts/functions.php");
$functionClass = new functions();
/*$behaviour_id = 'behaviour_id';
$physical_id = $physical_id++;
$social_id = 1;
$medical_id = 1;*/

if(isset($_POST['login'])){
        $username = $_POST['username'];
        $userpassword = $_POST['userpassword'];
        
        //$hashed_password = password_hash($userpassword, PASSWORD_DEFAULT);
         // $hashed_password = password_hash("password", PASSWORD_DEFAULT);
        //echo $hashed_password;
        //return the data 
        $functionClass->Signin($username, $userpassword);
       
      // $functionClass->Signin("stephenkearns", "password");
}

if(isset($_POST['userregister'])){
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $addr = $_POST['addr'];
        $county = $_POST['county'];
        $dob = $_POST['dob'];
        $password = $_POST['password'];
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
       //$functionClass->UserRegister("test", "k", "test","test@gmail.com","testhome","dublin","22/01/1994", "password");
        $functionClass->UserRegister($fname, $sname, $username,$email,$addr,$county,
                                      $dob, $hashed_password);
}
    
if(isset($_POST['adddog'])){
        $dog_name = $_POST['dog_name'];
        $dog_age = $_POST['dog_age'];
        $dog_breed = $_POST['dog_breed'];
        $dog_company = $_POST['dog_company'];
        $dog_color = $_POST['dog_color'];
        $dillcurr = $_POST['dillcurr'];
        $dillpast = $_POST['dillpast'];
        $dvac = $_POST['dvac'];
        $dvacmiss = $_POST['dvacmiss'];
        $phys1 = $POST['phys1'];
        $phys2 = $POST['phys2'];
        $phys3 = $POST['phys3'];
        $phys4 = $POST['phys4'];
        $phys5 = $POST['phys5'];
        $beha1 = $POST['beha1'];
        $beha2 = $POST['beha2'];
        $beha3 = $POST['beha3'];
        $beha4 = $POST['beha4'];
        $beha5 = $POST['beha5'];
        $soc1 = $POST['soc1'];
        $soc2 = $POST['soc2'];
        $soc3 = $POST['soc3'];
        $soc4 = $POST['soc4'];
        $soc5 = $POST['soc5'];
        
        // echo "hello marken";
        //$functionClass->AddDog("rex", "18", "marktussle");
       
       $functionClass->AddDog($dog_name, $dog_age, $dog_breed, $dog_company, $dog_color, 
                                $dillcurr, $dillpast, $dvac, $dvacmiss, 
                                $phys1, $phys2, $phys3, $phys4, $phys5, 
                                $beha1, $beha2, $beha3, $beha4, $beha5, 
                                $soc1, $soc2, $soc3, $soc4, $soc5);
                        
                        
       /* $functionClass->AddDog("ste", "12", "Akita","BreedWeedz", "blue",     
                                "fresh", "young", "but", "old", 
                                "yes", "gf", "gf", "gf", "gf", 
                                "gf", "gf", "gf", "gf", "gf", 
                                "gf", "gf", "gf", "gf", "gf");
                
      $physical_id++;
       $social_id++;
       $behaviour_id++;
       $medical_id++;*/
//}

}
    
 if(isset($_POST['breederregister'])){
        $username = $_POST['username'];
        $companyname = $_POST['companyname'];
        $companyvatnum = $_POST['companyvatnum'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $addr = $_POST['addr'];
        $county = $_POST['county'];
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        
       //$functionClass->BreederRegister("GermanShepardsKennel", "453256AH","stephenk@home.com","password","underbarrysbed","dublin");
        $functionClass->BreederRegister($companyname, $companyvatnum, $email,$hashed_password, $addr,$county);
   
      
 } 
if(isset($_POST['breederlogin'])){
        $companyname =$_POST['companyname'];
        $password =$_POST['password'];
        
        //return the data 
       // $functionClass->Signin($username, $userpassword);
       
      // $functionClass->breederSignin($username, $password);
       //$functionClass->breederSignin($companyname, $password);
       $functionClass->breederSignin($companyname, $password);
} 


if(isset($_POST['checkifuserexists'])){
        $username = $_POST['username'];
        
       // $functionClass->CheckIfUserExists($username);
      // $sfunctionClass->CheckIfUserExists("stephenkearns");
       //$functionClass->CheckUserExist("stephenkearns");
       $functionClass->CheckUserExist($username);
       
}



if(isset($_POST['checkifbreederexists'])){
        $companyname = $_POST['companyname'];
        
        $functionClass->CheckCompanyExist($companyname);
}



if(isset($_POST['updateUser'])){
      $original_username = $_POST['username'];
      $newEmail = $_POST['newpassword'];
      $new_username = $_POST['newusername'];
      $new_password = $_POST['newpassword'];
      
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);   
      $functionClass->UpdateUser($original_username, $new_username, $newEmail, $hashed_password);
      //$functionClass->UpdateUser("stephenk", "stephenj");
}
   
   

?>
