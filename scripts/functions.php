<?php

/**
 *  Stephen kearns 
 */
include("config/dbcon.php");
class functions
{

    
    public function Signin($username, $password)
    {
        
      try {
          
       
            // ceates a new db connection instance
            $db = new dbcon();
            $dbcon= $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbcon->prepare("SELECT * FROM user WHERE username = ?");
           // $stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
           // $stmt->execute([$username, $password]);
            $stmt->execute([$username]);
           // echo"Fetched password", $fetched_password;
           //$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $data = $stmt->fetch(PDO::FETCH_ASSOC);
           $fetched_password = $data['password'];
           if(password_verify($password, $fetched_password)){
               $json = json_encode($data);
               print_r($json);
           }else{
               echo "failed";
           } 
           
           
           
          
            
          /* if(password_verify("password", $fetched_password)){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($data);
                print_r($json);
            }else{
                
                echo "failed";
            } */
            
            
           
            
      } catch (Exception $e) {
       
          print("error".$e);
      }   
      
      //close connection
      $stmt = null;

      
      
    }
    
    //Have to hash password so passwords are not sent & store in laintext in the databases 
    public function UserRegister($fname, $sname, $username,$email,$addr,$county, $dob, $password){
         try {
          
       
            // ceates a new db connection instance
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbcon->prepare("INSERT INTO user(fname, sname, username, email, addr,county, dob, password) 
            VALUES(:fname,:sname,:username,:email,:address,:county,:dob,:password)");
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':sname',$sname);
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':address',$addr);
            $stmt->bindParam(':county',$county);
            $stmt->bindParam(':dob',$dob);
            $stmt->bindParam(':password',$password);
            //$stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
            
            //checkes to see if data has been inserted sucessfully 
            if($stmt->execute()){
                echo 'success';
            }else{
                echo 'failed';
            }
            
      } catch (Exception $e) {
       
          print("error".$e);
      }   
      
      
        //close connection
      $stmt = null;
    }
    
public function breederSignin($companyname, $password){
    try{
        
         // ceates a new db connection instance
            $db = new dbcon();
            $dbcon= $db->getDBCon();
            $stmt = $dbcon->prepare("SELECT * FROM breeder WHERE companyname = ?");
            $stmt->execute([$companyname]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $fetched_password = $data['password'];
            
            if(password_verify($password, $fetched_password)){
               $json = json_encode($data);
               print_r($json);
           }else{
               echo "failed";
           } 
        
    }catch(Exception $error){
        print_r("Error occured, breedersignin". $error);
    }
    
    $stmt = null;
}


    
 public function BreederRegister($companyname, $companyvatnum, $email,$password, $addr,$county){
     
     try {
         
     
         //creates a new connection instance to the database
         $db = new dbcon();
         $dbcon = $db->getDBCon();
         //preparing statments to avoid sql injection 
         $stmt = $dbcon->prepare("INSERT INTO breeder(companyname, companyvat, email, password, address,county) 
                VALUES(:companyname,:companyvat,:email,:password,:address,:county)");
                
         //binding the data to the statment
          $stmt->bindParam(':companyname',$companyname);
          $stmt->bindParam(':companyvat',$companyvatnum);
          $stmt->bindParam(':email',$email);
          $stmt->bindParam(':password',$password);
          $stmt->bindParam(':address',$addr);
          $stmt->bindParam(':county',$county);
          
          /*
              
          $stmt->bindParam(':companyname',"GermanShepardsKennel");
          $stmt->bindParam(':companyvatnum',"345467AH");
          $stmt->bindParam(':email',"doglife@gmail.com");
          $stmt->bindParam(':password', "password");
          $stmt->bindParam(':address',"Sallynoggin");
          $stmt->bindParam(':county',"Dublin");
          
          */
          
          
          
          if($stmt->execute()){
                echo 'success';
            }else{
                echo 'failed';
            }
            
          
         }catch (PDOException $error) {
             print_r("Error occured".$error);
         } 
         
         //end conntection
         $stmt = null;
     
 }//end of breederReg
    
    public function UploadImage($image){
    
    $data = base64_encode($image);

    file_put_contents('../images/image.png', $data);
        
        try {
            
             
             $db = new dbcon();
             $dbcon = $db->getDBCon();
             $stmt = $dbcon->prepare("INSERT INTO images(image) VALUES(:image)");
            
             $stmt->bindParam(':image',$image);   
             
             if($stmt->execute()){
                    echo 'success';
                }else{
                    echo 'failed';
                }
                
              
             }catch (PDOException $error) {
                 print_r("Error occured".$error);
             } 
             
             //end conntection
             $stmt = null;
            
    }
    
    public function GetImage($image)
    
    {
        
        try {
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbcon->prepare("SELECT image FROM images WHERE dog_id = ");
        }catch (PDOException $e) {
                 print_r("Error occured".$error);
             } 
    }
    
    public function AddDog($dog_name, $dog_age, $dog_sex, $dog_breed, $dog_company, $dog_color,     
                            $dillcurr, $dillpast, $dvac, $dvacmiss, 
                            $size, $fur, $body, $tolerance, $neutered, 
                            $energy, $exercise, $intelligence, $playful, $instinct, 
                            $people, $family, $dogs, $emotion, $sociability)
                            
    {
                                
        
            
        
        try {
            
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // $stmt = $dbcon->beginTransaction();
        
            
            
            $stmt= $dbcon->prepare("INSERT INTO dogs(dog_name, dog_age, dog_sex, dog_breed, dog_company, dog_color) VALUES (:dog_name, :dog_age, :dog_sex, :dog_breed, :dog_company, :dog_color)");
            $stmt->bindParam(':dog_name',$dog_name);
            $stmt->bindParam(':dog_age',$dog_age);
            $stmt->bindParam(':dog_sex',$dog_sex);
            $stmt->bindParam(':dog_breed',$dog_breed);
            $stmt->bindParam(':dog_company',$dog_company);
            $stmt->bindParam(':dog_color',$dog_color);
            $stmt->execute();
             
            
            
            $stmt= $dbcon->prepare("INSERT INTO physical(size, fur, body, tolerance, neutered) VALUES(:size, :fur, :body, :tolerance, :neutered)");
            $stmt->bindParam(':size',$size);
            $stmt->bindParam(':fur',$fur);
            $stmt->bindParam(':body',$body);
            $stmt->bindParam(':tolerance',$tolerance);
            $stmt->bindParam(':neutered',$neutered);
            $stmt->execute();
              
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO social(people, family, dogs, emotion, sociability) VALUES(:people, :family, :dogs, :emotion, :sociability)");
            $stmt->bindParam(':people',$people);
            $stmt->bindParam(':family',$family);
            $stmt->bindParam(':dogs',$dogs);
            $stmt->bindParam(':emotion',$emotion);
            $stmt->bindParam(':sociability',$sociability);
            $stmt->execute();
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO behaviour(energy, exercise, intelligence, playful, instinct) VALUES(:energy, :exercise, :intelligence, :playful, :instinct)");
            $stmt->bindParam(':energy',$energy);
            $stmt->bindParam(':exercise',$exercise);
            $stmt->bindParam(':intelligence',$intelligence);
            $stmt->bindParam(':playful',$playful);
            $stmt->bindParam(':instinct',$instinct);
            $stmt->execute();
            
            
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO medical(dillcurr, dillpast, dvac, dvacmiss) VALUES(:dillcurr, :dillpast, :dvac, :dvacmiss)");
            $stmt->bindParam(':dillcurr',$dillcurr);
            $stmt->bindParam(':dillpast',$dillpast);
            $stmt->bindParam(':dvac',$dvac);
            $stmt->bindParam(':dvacmiss',$dvacmiss);
            $stmt->execute();
            
            
            //$stmt = $dbcon->commit();
            
          
         } catch (PDOException $error) {
            //roll back the transaction if something failed
            // $stmt = $dbcon->rollback();
               // echo "id".$physical_id;
                echo "Error: " . $error;
         
         } 
     
    }

         
         
    public function DisplayImage($dog_id){
        try {
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbcon->prepare("SELECT image FROM images WHERE images.dog_id = 7");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
               
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
    }
        
    
    
  

    

    public function CheckUserExist($username){
         try {
          
       
            // ceates a new db connection instance
            $db = new dbcon();
            $dbcon= $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$stmt = $dbcon->prepare("SELECT username FROM user WHERE username = ?");
            $stmt = $dbcon->prepare("SELECT username FROM user WHERE username = ?");
           // $stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
            
            //if the user name exists then notifie the user
            $stmt->execute([$username]);
            //$data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
           // $result =  $data['username']; 
            
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $result = $data['username'];
          
            
            if(strcasecmp($username, $result) != 0){
                printf("does not exist");
                
            }else if(strcasecmp($username, $result) == 0){
                printf("exists");   
            }else{
                printf("error occured");
            }
            
            
            
      } catch (Exception $e) {
       
          print("error".$e);
      }   
      
    
    
    //close the connection 
    $stmt = null;
    }
    
    
    
    
    public function CheckCompanyExist($companyname){
         try {
          
       
            // ceates a new db connection instance
            $db = new dbcon();
            $dbcon= $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$stmt = $dbcon->prepare("SELECT username FROM user WHERE username = ?");
            $stmt = $dbcon->prepare("SELECT compnayname FROM breeder WHERE companayname = ?");
           // $stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
            
            //if the user name exists then notifie the user
            $stmt->execute([$companyname]);
            //$data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //$data = $stmt->fetchAll(PDO::FETCH_COLUMN);
           // $result =  $data['username']; 
            
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $result = $data['compnayname'];
          
            
            if(strcasecmp($companyname, $result) != 0){
                printf("does not exist");
                
            }else if(strcasecmp($companyname, $result) == 0){
                printf("exists");   
            }else{
                printf("error occured");
            }
            
            
            
      } catch (Exception $e) {
       
          print("error".$e);
      }   
      
    
    
    //close the connection 
    $stmt = null;
    }
    
    
    
    public function UpdateUser($username, $newUsername,$newEmail, $newPassword){
         
         try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$stmt = $dbcon->prepare("SELECT username FROM user WHERE username = ?");
                $stmt = $dbcon->prepare("UPDATE user SET username = :newusername, email = :newemail, password = :newpassword WHERE username = :username");
               // $stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
                
                $stmt->bindParam(':username',$username);
                $stmt->bindParam(':newusername', $newUsername);
                $stmt->bindParam(':newpassword', $newPassword);
                $stmt->bindParam(':newemail', $newEmail);
                
                
               if($stmt->execute()){
                   print_r('success');
               }else{
                   print_r('failed');
               }
         
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
        
    }

    public function UpdateBreeder($companyname, $newcompanyname, $newemail, $newaddr, $newpassword){
          try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("UPDATE breeder SET companyname = :newcompanyname, email = :newemail, password = :newpassword, address = :newaddress WHERE companyname = :companyname");
                $stmt->bindParam(':companyname',$companyname);
                $stmt->bindParam(':newcompanyname', $newcompanyname);
                $stmt->bindParam(':newemail', $newemail);
                $stmt->bindParam(':newpassword', $newpassword);
                $stmt->bindParam(':newaddress', $newaddr);
                
                
               if($stmt->execute()){
                   print_r('success');
               }else{
                   print_r('failed');
               }
         
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
    }
    
    public function GetCompanyDogs($companyname){
          try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                            SELECT
                                                    dogs.dog_id, dogs.dog_name, dogs.dog_age, dogs.dog_breed,dogs.dog_sex, dogs.dog_company, dogs.dog_color,
                                            		physical.size, physical.fur, physical.body,physical.tolerance,physical.neutered,
                                            		behaviour.dog_id,behaviour.energy,behaviour.exercise,behaviour.intelligence,behaviour.playful,behaviour.instinct 
                                            		,social.people,social.family,social.dogs,social.emotion,social.sociability
                                            		,medical.dillcurr,medical.dillpast,medical.dvac,medical.dvacmiss
                                            FROM dogs
                                            INNER JOIN physical ON dogs.dog_id = physical.dog_id
                                            INNER JOIN behaviour ON dogs.dog_id = behaviour.dog_id
                                            INNER JOIN social ON dogs.dog_id = social.dog_id
                                            INNER JOIN medical ON dogs.dog_id = medical.dog_id
                                            WHERE dogs.dog_company = :companyname
                                            GROUP BY dogs.dog_id
                                            ORDER BY dog_name ASC;
                                        ");
               $stmt->bindParam(':companyname',$companyname);
               $stmt->execute();
               
               $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
               echo json_encode($data);  
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
    }
    
    public function GetAllDogs(){
        
        try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                            SELECT
                                                    dogs.dog_id, dogs.dog_name, dogs.dog_age, dogs.dog_breed,dogs.dog_sex, dogs.dog_company, dogs.dog_color,
                                            		physical.size, physical.fur, physical.body,physical.tolerance,physical.neutered,
                                            		behaviour.dog_id,behaviour.energy,behaviour.exercise,behaviour.intelligence,behaviour.playful,behaviour.instinct 
                                            		,social.people,social.family,social.dogs,social.emotion,social.sociability
                                            		,medical.dillcurr,medical.dillpast,medical.dvac,medical.dvacmiss
                                            FROM dogs
                                            INNER JOIN physical ON dogs.dog_id = physical.dog_id
                                            INNER JOIN behaviour ON dogs.dog_id = behaviour.dog_id
                                            INNER JOIN social ON dogs.dog_id = social.dog_id
                                            INNER JOIN medical ON dogs.dog_id = medical.dog_id
                                            GROUP BY dogs.dog_id;
                                        ");
                                        
               $stmt->execute();
               
               $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
               echo json_encode($data);    
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
        
    }
    
    
    function GetUserPerferances($userID){
             try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                            SELECT * FROM userprefs
                                            WHERE user_id = :user_id;
                                            
                                        ");
                                        
               $stmt->bindParam(':user_id',$userID);                            
               $stmt->execute();
                        
               $data = $stmt->fetch(PDO::FETCH_ASSOC);
               echo json_encode($data);    
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
    }
    
     function AddPref(  $user_id,$size, $fur, $body, $tolerance, $neutered, 
                        $energy, $exercise, $intelligence, $playful, $instinct, 
                        $people, $family, $dogs, $emotion, $sociability){
             try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                           DELETE FROM  userprefs
                                            WHERE user_id=:userID;
                                           
                                           
                                           
                                           
                                           INSERT INTO userprefs(user_id,size,fur,body,tolerance,
                                           neutered,energy,exercise,intelligence,playful,
                                           instinct,people,family,dogs,emotion,sociability)
                                           
                                           VALUES (:userID,:size,:fur,:body,:tolerance,:neutered,
                                                    :energy,:exercise,:intelligence,:playful,
                                           :instinct,:people,:family,:dogs,:emotion,:sociability);
                                           
                                           ");
                                           
                                           
                                           
                                        
            $stmt->bindParam(':userID',$user_id);  
            $stmt->bindParam(':size',$size);
            $stmt->bindParam(':fur',$fur);
            $stmt->bindParam(':body',$body);
            $stmt->bindParam(':tolerance',$tolerance);
            $stmt->bindParam(':neutered',$neutered);
            $stmt->bindParam(':energy',$energy);
            $stmt->bindParam(':exercise',$exercise);
            $stmt->bindParam(':intelligence',$intelligence);
            $stmt->bindParam(':playful',$playful);
            $stmt->bindParam(':instinct',$instinct);
            $stmt->bindParam(':people',$people);
            $stmt->bindParam(':family',$family);
            $stmt->bindParam(':dogs',$dogs);
            $stmt->bindParam(':emotion',$emotion);
            $stmt->bindParam(':sociability',$sociability);
            $stmt->execute();
                        
            
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
    }
    
    
    public function CheckCompanyDogExists($companyname){
         try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                            SELECT dog_company
                                            FROM dogs
                                            WHERE dog_company = :companyname;
                                        ");
                                        
                                       
                                           
                                           
                                       
               $stmt->bindParam(':companyname',$companyname);
                                        
               $stmt->execute();
               
               
              
               
               if($stmt->fetch(PDO::FETCH_ASSOC)){
                   echo "true";
               }else{
                   echo "false";
               }
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
        
    }
    
    
    
     public function DeleteDog($dog_id){
        
      
        try {
            
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // $stmt = $dbcon->beginTransaction();
        
             
            
            $stmt= $dbcon->prepare("DELETE  FROM physical WHERE dog_id = :dog_id;");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
            
            
            $stmt= $dbcon->prepare("DELETE FROM  behaviour WHERE dog_id = :dog_id;");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
              
            
            
            
            $stmt= $dbcon->prepare("DELETE  FROM  social WHERE dog_id = :dog_id;");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
            
            
            
            $stmt= $dbcon->prepare("DELETE  FROM medical  WHERE dog_id = :dog_id;");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
            
            
            
            
            $stmt= $dbcon->prepare("DELETE  FROM  images WHERE dog_id = :dog_id");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
            
            
            $stmt= $dbcon->prepare("DELETE  FROM  dogs WHERE dog_id = :dog_id");
            $stmt->bindParam(':dog_id',$dog_id);
            $stmt->execute();
            
           
        
            
           //$stmt = $dbcon->commit();
            
        
           
        
          
         } catch (PDOException $error) {
            //roll back the transaction if something failed
            //$stmt = $dbcon->rollback();
               // echo "id".$physical_id;
                echo "Error: " . $error;
         
         } 
     
         //end conntection
         $stmt = null;
     
    
        
    }
    
    public function GetStudDogs($dog_breed){
          try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("   
                                            SELECT
                                                    dogs.dog_id, dogs.dog_name, dogs.dog_age, dogs.dog_breed,dogs.dog_sex, dogs.dog_company, dogs.dog_color,
                                            		physical.size, physical.fur, physical.body,physical.tolerance,physical.neutered,
                                            		behaviour.dog_id,behaviour.energy,behaviour.exercise,behaviour.intelligence,behaviour.playful,behaviour.instinct 
                                            		,social.people,social.family,social.dogs,social.emotion,social.sociability
                                            		,medical.dillcurr,medical.dillpast,medical.dvac,medical.dvacmiss
                                            FROM dogs
                                            INNER JOIN physical ON dogs.dog_id = physical.dog_id
                                            INNER JOIN behaviour ON dogs.dog_id = behaviour.dog_id
                                            INNER JOIN social ON dogs.dog_id = social.dog_id
                                            INNER JOIN medical ON dogs.dog_id = medical.dog_id
                                            WHERE dogs.dog_breed = :breed;
                                        ");
                                        
                                        
               $stmt->bindParam(':breed',$dog_breed);
               $stmt->execute();
               
             //  if($stmt->fetchAll(PDO::FETCH_ASSOC)){
                   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   echo json_encode($data);  
             //  }else{
                   //does not exist 
               //   echo "false";
               //}
                 
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
        
    
    }
    
    
    public function getImage2($dog_id){
         try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $dbcon->prepare("SELECT * FROM images WHERE dog_id = :dog_id;");
                $stmt->bindParam(':dog_id',$dog_id);
                $stmt->execute();
               
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($data);    
           
            
            
           
            
          } catch (Exception $e) {
           
              print("error".$e);
          }   
          
        
        
        //close the connection 
        $stmt = null;
        
        
    }
    
    
     
    
}//end of function class 

