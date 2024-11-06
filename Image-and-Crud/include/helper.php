<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<?php

require_once dirname(__FILE__)."/db.php";

function filter_data($data){

    global $conn;
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

function ERROR_MSG($msg){
    $html = "<div class='alert alert-danger'  role='alert'> $msg </div>";
    echo $html;
     
}
function SUCCESS_MSG($msg){
    $html = "<div class='alert alert-success' role='alert'> $msg </div>";
    echo $html;

}

function refresh_url($sec, $url){
    header("Refresh:{$sec}, url='{$url}'");
}

function redirect_url($url){
    header("location: {$url}");
}

function File_upload($input, $exe, $destination ){

    if(!isset($_FILES[$input]) || $_FILES[$input]["error"]=== 4){
        return false;
    }

    $file = $_FILES[$input];
    // $file = $_FILES["image"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $tempName = $file["tmp_name"];

    $validImageExtension = $exe;
    $ImageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    // $validImageExtension = ['jpg', 'jpeg', 'png'];

    //  $ImageExtension = explode('.', $fileName);
    //  $ImageExtension = strtolower(end($ImageExtension));
    // $ImageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


     if(!in_array($ImageExtension, $validImageExtension)){
        
        return 1;
        // ERROR_MSG("Invalid Image Extension");
        // $status['errors']++;
        // array_push($status['msg'], "Invalid Image Extension");
    }
    elseif($fileSize > 1000000) {
        return 2;
        // ERROR_MSG("Invalid Image Size");

        // $status['errors']++;
        // array_push($status['msg'], "Invalid Image Size");
    }else{
        $newImageName = uniqid();
        $newImageName = '.' . $ImageExtension;

        $relative_path = DOMAIN2 . $destination . $fileName; // saving and removing

        $absolute_path = DOMAIN . $destination . $fileName; // fetch from database

        if(move_uploaded_file($tempName, $relative_path)){
            $status = [
                "relative_path" => $relative_path,
                "absolute_path" => $absolute_path
            ];
            return $status;
        }else{
            // ERROR_MSG("Image not Saved");
            return false;
        }
        
        // $query = "INSERT INTO `user`(`image`) VALUES '{$newImageName}'";
        // $exe = $conn->query($query);
        // if($exe){
        // echo "Successfully Added";
        // refresh_url(3, DASHBOARD);
        // }
    }

}

?>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>