<?php

require_once dirname(__FILE__)."/dbconn.php";
require_once dirname(__DIR__)."/include/helper.php";

if(isset($_GET['token']) && !empty($_GET['token'])){
    $userId = base64_decode($_GET['token']);

    $del = "DELETE FROM `user` WHERE `id` = '{$userId}'";
    $exe = $conn->query($del);

    if($exe){
        SUCCESS_MSG("DELETED RECORD SUCCESSFULLY");
    }else{
        ERROR_MSG("ERROR: User could not be deleted");
    }
    redirect_url(DASHBOARD);
}else{

    ERROR_MSG("ERROR: INVALID OR MISSING TOKEN");
}

