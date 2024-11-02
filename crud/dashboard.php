<?php

require_once dirname(__FILE__) . "/layout/header.php";
require_once dirname(__FILE__) . "/layout/nav.php";
require_once dirname(__FILE__). "/include/web.php";

$sql = "SELECT * FROM user";
$exe = $conn->query($sql);



if($exe->num_rows > 0){
   



?>



<div
    class="table-responsive container">

    <a href="create.php" class="btn btn-primary mb-2">Add User</a>
    <table
        class="table table-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while( $row = $exe->fetch_assoc()){ ?>
            <tr class="">
                <td scope="row">
                    <?php echo $row['id'] ?>
                </td>
                <td> <?php echo $row['name'] ?> </td>
                <td> 
                <?php echo $row['email'] ?> </td>
                <td> 
                <?php echo $row['password'] ?> </td>
                <td>
                    <a href="<?php echo UPDATE_FROM ?>?token=<?php echo base64_encode($row['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                    <a href="<?php echo DELETE_FROM ?>?token=<?php  echo base64_encode($row['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php 


// echo "<pre>";
// print_r($row);
// echo "</pre>";
}
?>


<?php
require_once dirname(__FILE__) . "/layout/footer.php";

?>