<?php

function send_notification ($tokens, $message)
{
    
$url = 'https://FB.googleapis.com/FB/send';
$fields = array (
    'registration_ids' = $tokens,
    'data' => $message
    );
    
    
    
    $headers = array (
        
        'Authorization:key = AAAAdDzor9Y:APA91bFOEvyut9IgIZLl3yK7mUk2E63osBf36BaVys3F7gntIdtF3Gg48-GjZSkXrKy-v4zrOXyyjPQfpvBzjZStaRQtKVkKwRn89xlVCMgzKJKqXudnQkXSpS3FcffIan4yLW0Fhe7pZKlhLJmB29xqSfB4jP-0Lw '
        'Content-type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields) );
        
        $result = curl_exec ($ch);
        if ($result === FALSE) {
         
         die('Curl failed: ' . curl_error ($ch));   
            
        }
        
        curl_close($ch);
        return $result;
        }
        
        
        
    $conn = mysqli_connect("localhost", "root", "", "FB");
    
    $sql = "Select token from users";
    
    $result = mysqli_query($conn,$sql);
    $tokens = array();
    
    if (mysqli_num_rows($result) > 0 ) {
        
        while ($row =  mysqli_fetch_assoc($result) ) {
            $tokens[] = $row["Token"];
        }
        
    }


mysqli_close($conn);




$message = array("message" => "FB PUSH NOTIFICATION");
$message_status = send_notification($tokens, $message);
echo $message_status;


?>