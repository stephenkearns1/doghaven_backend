<?php

include("scripts/functions.php");
//include("scripts/upload.php");
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
        $size = $_POST['size'];
        $fur = $_POST['fur'];
        $body = $_POST['body'];
        $tolerance = $_POST['tolerance'];
        $neutered = $_POST['neutered'];
        $energy = $_POST['energy'];
        $exercise = $_POST['exercise'];
        $intelligence = $_POST['intelligence'];
        $playful = $_POST['playful'];
        $instinct = $_POST['instinct'];
        $people = $_POST['people'];
        $family = $_POST['family'];
        $dogs = $_POST['dogs'];
        $emotion = $_POST['emotion'];
        $sociability = $_POST['sociability'];
        //$image = $_POST['image'];
        
       
     
     $functionClass->AddDog($dog_name, $dog_age, $dog_breed, $dog_company, $dog_color, 
                                $dillcurr, $dillpast, $dvac, $dvacmiss, 
                                $size, $fur, $body, $tolerance, $neutered, 
                                $energy, $exercise, $intelligence, $playful, $instinct, 
                                $people, $family, $dogs, $emotion, $sociability);
                                
}

if(isset($_POST['uploadimage'])){
        $image = $_POST['image'];
        
    $functionClass->UploadImage($image);
    
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


//Changing the name company is risky, due to to a copany not filling a promise and then changing there company name,
// but then again a company is physically able to change after following the right procedure so we will allow it 
if(isset($_POST['updateBreeder'])){
    $original_companyname = $_POST['companyname'];
    $new_companyname = $_POST['newcompanyname'];
    $new_companyemail = $_POST['newemail'];
    $new_address = $_POST['newaddr'];
    $new_password = $_POST['newpassword'];
    
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); 
    
    $functionClass->UpdateBreeder($original_companyname , $new_companyname,$new_companyemail
                                    ,$new_address, $hashed_password);
    
    
}


if(isset($_GET['GetCompanyDogs'])){

    $companyname = $_POST['companyname'];
    
    //$functionClass->GetCompanyDogs($companyname);
   $functionClass->GetCompanyDogs('BreedWeedz');
    

}

if(isset($_GET['GetAllDogs'])){
    //Get your variables 
    
    $functionClass->GetAllDogs(); 
    
    //call your function 
    
}

?>
