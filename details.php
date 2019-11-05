<?php include 'header.php';
include 'config.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];

//    Use the id to grab data from the DB
    $sql = "SELECT * FROM `units` WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

//    Assign DB data to variables
    $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $image = $row['link'];
        $details = $row['description'];
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <img src="<?php echo $image?>" alt="">
            <input type="text" name="">
            <h5><?php echo $name?></h5>
            <h5><?php echo "Ksh.".$price?></h5>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <textarea name="details" id="" cols="90" rows="10"><?php echo $details?></textarea>
        </div>
    </div>
</div>

<?php


?>
