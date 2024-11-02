
<?php 
require_once dirname(__FILE__) . "/layout/header.php";
require_once dirname(__FILE__) . "/layout/nav.php";
?>

<?php 
if(isset($_GET["token"]) && !empty($_GET["token"])){
    $userId = base64_decode($_GET["token"]);
}else{
    redirect_url(DASHBOARD);
}

$update = "SELECT * FROM `user` WHERE `id` = '{$userId}'";
$exe = $conn->query($update);
if($exe->num_rows > 0){
    $update = $exe->fetch_assoc();
}else{
    redirect_url(DASHBOARD);
}

?>

<h1> UPDATE FROM </h1>
<div class="container">
<div class="mx-5  bg-info p-4 rounded ">
    <form action="<?php echo UPDATE_FROM_SUBMIT; ?>" method="post" class="p-3 pb-4"> 
        <input type="text" name="_token" value="<?php echo base64_encode($userId); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo $update['name']; ?>" class="form-control" id="name" aria-describedby="emailHelp">     
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email </label>
            <input type="email" name="email" value="<?php echo $update['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" value="<?php echo $update['name']; ?>" class="form-control" id="password" aria-describedby="emailHelp">
        </div>
        <input type="submit" name="update" value="SAVE ME" class="btn btn-dark px-3 fw-bold float-end">
    </form>
</div>
</div>

<?php
require_once dirname(__FILE__) . "/layout/footer.php";

?>