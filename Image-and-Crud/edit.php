<?php

require_once "include/db.php";
require_once "include/helper.php";
require_once "include/web.php";

if(isset($_GET['token']) && !empty($_GET['token'])){
    $userId = base64_decode($_GET['token']);

}else{
    ERROR_MSG("TOKEN NOT DEFINED");
    // redirect_url(DASHBOARD);
}

    $update = "SELECT * FROM `user` WHERE `id` = '{$userId}'";
    $exe = $conn->query($update);

    if($exe->num_rows > 0){
        $update = $exe->fetch_assoc();
    }else{
        ERROR_MSG("QUERY ERROR");
        // redirect_url(DASHBOARD);
    }


?>


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

<body>


    <!-- Nav tabs -->
    <nav class="  text-center bg-warning nav-warning">
        <ul class="nav container " id="navId" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link text-dark  " data-bs-toggle="tab">FORM</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#" class="nav-link text-dark  " data-bs-toggle="tab">TABLE</a>
            </li>
        </ul>
    </nav>

    <div class="container py-4 px-5 bg-warning my-3 rounded">
        <form class="bg-warning container" method="POST" action="<?php echo UPDATE_FROM; ?>">
           <input type="hidden" name="_token" value="<?php echo base64_encode($update['id']); ?>">
        <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="<?php echo $update['name']; ?>" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" value="<?php echo $update['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image </label>
                <input type="file" name="image" class="form-control" id="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" value="<?php echo $update['password']; ?>" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Submit</button>
        </form>
    </div>



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