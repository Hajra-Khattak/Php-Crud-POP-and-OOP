
<?php 
require_once dirname(__FILE__) . "/layout/header.php";
require_once dirname(__FILE__) . "/layout/nav.php";
?>

<div class="container">
<div class="mx-5  bg-info p-4 rounded ">
    <form action="<?php echo INSERT_FROM; ?>" method="post" class="p-3 pb-4"> 
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">     
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email </label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp">
        </div>
        <input type="submit" name="submit" value="SAVE ME" class="btn btn-dark px-3 fw-bold float-end">
    </form>
</div>
</div>

<?php
require_once dirname(__FILE__) . "/layout/footer.php";

?>