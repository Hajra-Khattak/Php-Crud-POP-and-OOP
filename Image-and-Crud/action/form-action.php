<?php

require_once dirname(__DIR__)."/include/db.php";
require_once dirname(__DIR__)."/include/web.php";
require_once dirname(__DIR__)."/include/helper.php";

if(isset($_POST["submit"]) || !empty($_POST["submit"]) ){

    $name = filter_data($_POST["name"]);
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);

    $inputFile = "image";
    
    $status = [
        "errors" => 0,
        "msg" => []
    ];

   


    // Check if Email is set and not empty 
    if(!isset($email) || empty($email)){
        $status['errors']++;

        array_push($status['msg'], "EMAIL is REQUIRED");
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $status['errors']++;
            array_push($status['msg'], "EMAIL IS NOT VALID");
        }
    }

    // Check if Password is set and not empty 

    if(!isset($password) || empty($password)){
        $status['errors']++;
        array_push($status['msg'], "PASSWORD IS REQUIRED");
    }

    // Check if Email is already occuupied 
    $sql = "SELECT * FROM `user` WHERE `email` = '{$email}'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        $status['errors']++;
        array_push($status['msg'], "EMAIL ALREADY EXIST");
    }

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    
    $file = File_upload("image", $validImageExtension, "assets/images/" );
   if($file == 1){
    $string = strtoupper(implode(",", $validImageExtension));
    echo "{$string} ONLY ALLOWED"; 
   }else{
    $encode = json_encode($file);

   }
   if($file == false){
    $status['errors']++;
    array_push($status["msg"], "UPLOADING ERROR");
   }


    /*
    if($_FILES["image"]["error"] === 4){
        $status['errors']++;
        array_push($status['msg'], "Image Doesn't found");
    }else{


        $file = $_FILES[$inputFile];
        // $file = $_FILES["image"];
        $fileName = $_FILES["image"]["name"];
        $fileSize = $file . ["size"];
        $tempName = $file["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $ImageExtension = explode('.', $fileName);

        $ImageExtension = strtolower(end($ImageExtension));
        if(!in_array($ImageExtension, $validImageExtension)){
            $status['errors']++;
            array_push($status['msg'], "Invalid Image Extension");
        }
        elseif($fileSize > 1000000) {
            $status['errors']++;
            array_push($status['msg'], "Invalid Image Size");
        }else{
            $newImageName = uniqid();
            $newImageName = '.' . $ImageExtension;

            move_uploaded_file($tempName, 'assets/images/' . $newImageName);
            // $query = "INSERT INTO `user`(`image`) VALUES '{$newImageName}'";

            // $exe = $conn->query($query);

            // if($exe){
            // echo "Successfully Added";
            // refresh_url(3, DASHBOARD);
            // }
        }

    }   
      
*/
        if($status["errors"] > 0){
            foreach($status["msg"] as $msg){
                ERROR_MSG($msg);
            }
            // refresh_url(2, DASHBOARD);
        }else{

 
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);

        $insert = "INSERT INTO `user`(`name`,`email`,`image`,`password`) VALUES('{$name}','{$email}','{$newImageName}','{$encrypt}')";
        $result = $conn->query($insert);

        if($result){
            if($conn->affected_rows > 0){
                SUCCESS_MSG("RECORD IS INSERTED");
            }else{
                ERROR_MSG("ERROR RECORD IS NOT INSERTED {$insert}");
            }
        }else{
            ERROR_MSG("ERROR IN QUERY {$insert}");
        }

        refresh_url(2, DASHBOARD);
    }

}
