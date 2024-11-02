<?php

require_once dirname(__DIR__)."/include/helper.php";
require_once dirname(__DIR__)."/include/web.php";
// require_once "../include/helper.php";
// require_once  "../include/web.php";

if(isset($_POST["update"]) )
// if(isset($_POST["update"]) && !empty($_POST["update"]))
{

    $name = filter_data($_POST['name']);
    $email = filter_data($_POST['email']);
    $password = filter_data($_POST['password']);

    $userId = filter_data(base64_decode($_POST['_token']));

    // For all Errors in array
    $status = [
        "error" => 0,
        "msg" => []
    ];

    if(!isset($email) || empty($email)){
        $status["error"]++;
        array_push($status["msg"], "EMAIL IS REQUIRED");
        // ERROR_MSG("EMAIL IS REQUIRED");
    }else{

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            // ERROR_MSG("EMAIL IS NOT VALID");
            $status["error"]++;
            array_push($status["msg"], "EMAIL IS NOT VALID");
        }
    }

    if(!isset($password) || empty($password)){
        $status["error"]++;
        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }

    $sql = "SELECT * FROM `user` WHERE `email` = '{$email}' AND `id` <> '{$userId}'";
    $exe = $conn->query($sql);

    if($exe->num_rows > 0){
        $status["error"]++;
        array_push($status["msg"], "EMAIL IS ALREADY OCCUUPIED");
    }

    if($status["error"] > 0){
        foreach($status["msg"] as $value){
            ERROR_MSG($value);
        }
        refresh_url(2, DASHBOARD);
    }
    else{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $encrypt = base64_encode($password);

        $updat = "UPDATE `user` SET
        `name` = '{$name}', 
        `email` = '{$email}', 
        `password` = '{$password}'
        WHERE `id` = '{$userId}'
        ";
        $exe = $conn->query($updat);

        if($exe){
            if($conn->affected_rows > 0){
                SUCCESS_MSG("RECORD UPDATED SUCCESSFULLY");

            }else{
                ERROR_MSG("RECORD NOT UPDATED");
            }
        }else{
            ERROR_MSG("ERROR IN QUERY ");
        }
        refresh_url(2, DASHBOARD);
    }




}else{
    ERROR_MSG("METHOD IS NOT POST");
    refresh_url(3, DASHBOARD);
}


