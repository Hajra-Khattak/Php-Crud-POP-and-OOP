<?php 
require_once dirname(__DIR__)."/include/helper.php";
require_once dirname(__DIR__)."/include/web.php";


if(isset($_GET["token"]) && !empty($_GET["token"])){
    $userId = base64_decode($_GET["token"]);

    $sql = "DELETE FROM `user` WHERE `id` = '{$userId}'";
    $exe = $conn->query($sql);

    if($exe){
        if($conn->affected_rows >  0){
            SUCCESS_MSG("RECORD HAVE BEEN DELETED SUCCESSFULLY");
        }else{
            ERROR_MSG("RECORD HAVE NOT DELETED ");

        }
    }else{
        ERROR_MSG("ERROR IN QUERY");

    }
    refresh_url(2, DASHBOARD);

}else{
    ERROR_MSG("ERROR: INVALID OR MISSING TOKEN ");
    refresh_url(2, DASHBOARD);
}