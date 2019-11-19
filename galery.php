<?php
include 'header.php';
include 'config.php';
?>

<div class="container">
    <h2 style="text-align: center; font-family: 'DejaVu Serif'">Available Units</h2>
    <?php
    $sql = "SELECT * FROM `units`";

    //    store the data in a variable called results
    $result= mysqli_query($conn, $sql);

    echo "<div class='row'>";
    while($row = mysqli_fetch_array($result)){
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $details = $row['description'];
        $link = $row['link'];

//        presenting the data
        echo "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>";
        echo "<div class='img-thumbnail'>";
        echo "<a href='details.php?id=$id'>";
        echo "<img src='$link' class='img-thumbnail'>";
        echo "<h5>$name</h5>";
        echo "<h5>$price</h5>";
        echo "</a>";
        echo "</div>";
        echo "</div>";


    }
    echo "</div>";

    ?>

</div>