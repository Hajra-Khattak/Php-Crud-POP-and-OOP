<?php

require_once dirname(__DIR__)."/include/db.php";
require_once dirname(__DIR__)."/include/web.php";
require_once dirname(__DIR__)."/include/helper.php";

if(isset($_POST["submit"]) || !empty($_POST["submit"]) ){

    $name = filter_data($_POST["name"]);
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);

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
   
    if($status["errors"] > 0){
        foreach($status["msg"] as $msg){
            ERROR_MSG($msg);
        }
        refresh_url(2, DASHBOARD);
    }else{

 
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);

        $insert = "INSERT INTO `user`(`name`,`email`,`password`) VALUES('{$name}','{$email}','{$encrypt}')";
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
