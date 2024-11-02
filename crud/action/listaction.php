<?php 

require_once dirname(__DIR__) . "/include/helper.php";

if(isset($_POST["submit"]) && !empty($_POST["submit"])){

    $name = Filter_data($_POST["name"]);
    $email = Filter_data($_POST["email"]);
    $password = Filter_data($_POST["password"]);

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
            array_push($status["msg"], "EMAIL FORMAT INVALID");
        }
    }

    if(!isset($password) || empty($password)){
        $status["error"]++;

        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }

    $sql = "SELECT * FROM `user` WHERE `email` = '{$email}'";
    // $check_email = $conn->query($sql);
    $check_email = mysqli_query($conn, $sql);


    if($check_email->num_rows > 0){
        $status["error"]++;

        array_push($staus["msg"], "EMAIL ALREADY EXIST");
    }



    if($status["error"]>0){
        foreach($status["msg"] as $value){
            ERROR_MSG($value);
        }
    }else{

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $encrypt = base64_encode($password);

        $insert = "INSERT INTO `user`(`name`,`email`,`password`) VALUES('{$name}', '{$email}', '{$encrypt}')";

        $exe = mysqli_query($conn, $insert);

        if($exe){
            if($conn->affected_rows > 0){
                SUCCESS_MSG("RECORD INSERTED");
            }else{
                ERROR_MSG("RECORD IS NOT INSERTED {$insert}");
            }
            
        }else{
            ERROR_MSG("ERROR IN EXECUTION {$insert}");     
        }

        refresh_url(2, DASHBOARD);


    }

}else{
    ERROR_MSG("THE METHOD IS NOT POST");
}


