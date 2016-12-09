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
    
    public function AddDog($dog_name, $dog_age, $dog_breed, $dog_company, $dog_color,     
                            $dillcurr, $dillpast, $dvac, $dvacmiss, 
                            $phys1, $phys2, $phys3, $phys4, $phys5, 
                            $beha1, $beha2, $beha3, $beha4, $beha5, 
                            $soc1, $soc2, $soc3, $soc4, $soc5){
                                
        
            
        
        try {
            
            $db = new dbcon();
            $dbcon = $db->getDBCon();
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbcon->beginTransaction();
        
           
            
            /*
               Values keep track of each of the records added so that the dog table can be updated 
            */
            /*$stmt = $dbcon->prepare("INSERT INTO dogs(dname, dage, dbreed, dcompany, dcolor, dillcurr, dillpast, dvac, dvacmiss) 
                VALUES(:dname,:dage,:dbreed,:dcompany,:dcolor,:dillcurr,:dillpast,:dvac,:dvacmiss)");*/
            //$stmt->query("INSERT INTO dim_medical(dillcurr, dillpast, dvac, dvacmiss) VALUES(:dillcurr, :dillpast, :dvac, :dvacmiss)");
            /*$physical_id = (int) $dbcon->query('SELECT MAX(physical_id) FROM dim_physical;');  
            echo "Max" + $physical_id;
            $physical_id++;
            echo "Max+1" + $physical_id;*/
            
            
            $stmt= $dbcon->prepare("INSERT INTO dogs(dog_name, dog_age, dog_breed, dog_company, dog_color) VALUES (:dog_name, :dog_age, :dog_breed, :dog_company, :dog_color)");
            $stmt->bindParam(':dog_name',$dog_name);
            $stmt->bindParam(':dog_age',$dog_age);
            $stmt->bindParam(':dog_breed',$dog_breed);
            $stmt->bindParam(':dog_company',$dog_company);
            $stmt->bindParam(':dog_color',$dog_color);
            $stmt->execute();
             
            
            
            $stmt= $dbcon->prepare("INSERT INTO physical(phys1, phys2, phys3, phys4, phys5) VALUES(:phys1, :phys2, :phys3, :phys4, :phys5)");
            $stmt->bindParam(':phys1',$phys1);
            $stmt->bindParam(':phys2',$phys2);
            $stmt->bindParam(':phys3',$phys3);
            $stmt->bindParam(':phys4',$phys4);
            $stmt->bindParam(':phys5',$phys5);
            $stmt->execute();
              
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO social(soc1, soc2, soc3, soc4, soc5) VALUES(:soc1, :soc2, :soc3, :soc4, :soc5)");
            $stmt->bindParam(':soc1',$soc1);
            $stmt->bindParam(':soc2',$soc2);
            $stmt->bindParam(':soc3',$soc3);
            $stmt->bindParam(':soc4',$soc4);
            $stmt->bindParam(':soc5',$soc5);
            $stmt->execute();
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO behaviour(beha1, beha2, beha3, beha4, beha5) VALUES(:beha1, :beha2, :beha3, :beha4, :beha5)");
            $stmt->bindParam(':beha1',$beha1);
            $stmt->bindParam(':beha2',$beha2);
            $stmt->bindParam(':beha3',$beha3);
            $stmt->bindParam(':beha4',$beha4);
            $stmt->bindParam(':beha5',$beha5);
            $stmt->execute();
            
            
            
            
            
            $stmt= $dbcon->prepare("INSERT INTO medical(dillcurr, dillpast, dvac, dvacmiss) VALUES(:dillcurr, :dillpast, :dvac, :dvacmiss)");
            $stmt->bindParam(':dillcurr',$dillcurr);
            $stmt->bindParam(':dillpast',$dillpast);
            $stmt->bindParam(':dvac',$vac);
            $stmt->bindParam(':dvacmiss',$dvacmiss);
            $stmt->execute();
            
            

            
            $stmt = $dbcon->commit();
            
        
            /*
               After each transaction increment the id's,
               so that they can be linked and relationships are maintained
            */
            
            //$stmt->bindParam(':dog_name',$dog_name);
            //$stmt->bindParam(':dog_age',$dog_age);
            //$stmt->bindParam(':dog_breed',$dog_breed);
            //$stmt->bindParam(':dog_color',$dog_color);
            //$stmt->bindParam(':dillcurr',$dillcurr);
        //    $stmt->bindParam(':dillpast',$dillpast);
          //  $stmt->bindParam(':dvac',$dvac);
            //$stmt->bindParam(':dvacmiss',$dvacmiss);
          
            
            //$stmt->query("INSERT INTO fact_dog(dog_name, dog_age, dog_breed, dog_color) VALUES(:dog_name, :dog_age, :dog_breed, :dog_color)");
             
            //$stmt = null;
        
        //       $dbcon->commit();
        
        
          
         } catch (PDOException $error) {
            //roll back the transaction if something failed
            $stmt = $dbcon->rollback();
                echo "id".$physical_id;
                echo "Error: " . $error;
         
         } 
         
        /*if($stmt->execute()){
                echo 'success';
            }else{
                echo 'failed';
            }*/
            
          
         /*}catch (PDOException $error) {
             print_r("Error occured".$error);
         } 
         
         //end conntection
         $stmt = null;*/
     
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
    
    
    
    public function UpdateUser($username, $newUsername, $newPassword){
         
         try{
             // ceates a new db connection instance
                $db = new dbcon();
                $dbcon= $db->getDBCon();
                $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$stmt = $dbcon->prepare("SELECT username FROM user WHERE username = ?");
                $stmt = $dbcon->prepare("UPDATE user SET username = :newusername, password = :newpassword WHERE username = :username");
               // $stmt = $con->prepare("SELECT name,sname,address,email,dob FROM users WHERE username = ? AND password = ?");
                
                $stmt->bindParam(':username',$username);
                $stmt->bindParam(':newusername', $newUsername);
                $stmt->bindParam(':newpassword', $newPassword);
                
                
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


}//end of function class 

