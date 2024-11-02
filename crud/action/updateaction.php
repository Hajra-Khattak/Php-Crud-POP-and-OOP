<?php
require_once dirname(__DIR__) . "/include/helper.php";


if(isset($_POST["update"]) || !empty($_POST["update"])){

    $name = filter_data($_POST["name"]);
    $email = filter_data($_POST["email"]);
    $password = filter_data($_POST["password"]);

    $userId = filter_data(base64_decode($_POST["_token"]));

    $status = [
        "error" => 0,
        "msg" => []
    ];

    if(!isset($email) || empty($email)){
        $status["error"]++;

        array_push($status["msg"], "EMAIL IS REQUIRED");
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $status["error"]++;
            array_push($status["msg"], "EMAIL IS NOT VALID");
        }
    }

    if(!isset($password) || empty($password)){
        $status["error"]++;

        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }
    

    $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `id` <> '$userId' ";
    $result = $conn->query($sql);

    if($result){
        if($conn->affected_rows > 0){
            $status["error"]++;
            array_push($status["msg"], "EMAIL IS ALREADY EXIST");
        }
    }

    if($status["error"] > 0){

        foreach($status["msg"] as $msg){
            ERROR_MSG($msg);
        }
        refresh_url(2, DASHBOARD);
    }
    else{
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $encrypt = base64_encode($password);

        $update = "UPDATE `user` SET
        `name` = '{$name}',
        `email` = '{$email}',
        `password` = '{$encrypt}' 
        WHERE `id` = '{$userId}'";
        $res = $conn->query($update);

        if($res){
            if($conn->affected_rows > 0){
                SUCCESS_MSG("Record updated ");

            }else{
                ERROR_MSG("Record Now updated ");

            }
        }else{
            ERROR_MSG("Record Now updated ");

        }
        refresh_url(2, DASHBOARD);

    }
}


