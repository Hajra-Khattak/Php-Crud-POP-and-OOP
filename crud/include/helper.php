<?php 

declare(strict_types=1);
require_once dirname(__DIR__) . "/layout/header.php";
require_once dirname(__DIR__)."/action/dbconn.php";


function Filter_data(string $data){
    global $conn;
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
}

function ERROR_MSG(string $msg){
    $html =  "<div class='alert alert-danger' role='alert'> $msg </div>";
    echo $html;
}

function SUCCESS_MSG(string $msg){
    $html =  "<div class='alert alert-success' role='alert'> $msg </div>";
    echo $html;

}

function refresh_url(int $sec,string $url){
    header("Refresh:{$sec}, url='{$url}'");
}

function redirect_url($url){
    header("Location: $url");
}

require_once dirname(__DIR__) . "/layout/footer.php";

?>