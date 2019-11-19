<?php include 'header.php';
include 'config.php';

//grabbing the id of the selected image
if (isset($_GET['id'])){
    $id = $_GET['id'];

//    Use the id grabbed to draw data from the db
    $sql = "SELECT * FROM `units` WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

//    Assign the collected data to variables
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $details = $row['description'];
    $link = $row['link'];







}

?>


<div class="container">
    <div class="row">
        <div class="col-sx-12 col-sm-12 col-md-4 col-lg-4">
            <form action="<?php echo htmlspecialchars($_SERVER['update_handler.php'])?>" method="post" >
                <div class="form-group">
                    <img src="<?php echo $link ?>" alt="" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <input type="text" name="id" value="<?php echo $id ?>" hidden>
                </div>
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="price" value="<?php echo $price ?>" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="link" value="<?php echo $link ?>" class="form-control">
                </div>
                <a href='<?php echo "update.php?id=$id"?>' class='btn btn-info'>Update</a>
                <a href='<?php echo  "delete.php?id=$id" ?>' class='btn btn-danger'>Delete</a>
            </form>
        </div>
        <div class="col-sx-12 col-sm-12 col-md-8 col-lg-8">
            <textarea name="details" id="" cols="90" rows="10" class="form-control"><?php echo $details ?></textarea>
        </div>
    </div>
</div>

<?php




