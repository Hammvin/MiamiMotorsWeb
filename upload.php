<?php include 'header.php';
include 'config.php';

$name = $target_file= $price = $link = $details = '';
$target_dir = "uploads/";
$uploadOk = 1;

if(isset($_POST["submit"])||!empty($_FILES["fileToUpload"]["name"])) {
    $target_file =$target_dir.basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

//    Assign values to variables
    $name = $_POST['imgName'];
    $price = $_POST['price'];
    $details = $_POST['message'];

//    check if image is an image or fake
    if($check !== false) {
        $check["mime"];
        $uploadOk = 1;
        if (file_exists($target_file)) {
            echo "File already exists. ";
            $uploadOk = 0;
        }
//         Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

//    } else {

//        Check image type
//        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//            echo "Only JPG, JPEG & PNG files are allowed.";
//            $uploadOk = 0;


        }
//    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
            //Pull all data from the DB table
            $sql = "SELECT * FROM `units` WHERE link = '$target_file'";
            $result = mysqli_query($conn, $sql);

//            Check existence of the record.
            if (mysqli_num_rows($result) > 0){
                echo "Record exists in the DB. ";
            }else{
                //    throw the data to the db
                $sql = "INSERT INTO `units`(`id`, `name`, `price`, `link`, `description`) VALUES (NULL ,'$name','$price','$target_file','$details')";
                if (mysqli_query($conn, $sql)){
                    echo "Record inserted successfully. ";
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

    <!--Taking the image to upload and its details-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <form action="upload.php" method="post" enctype="multipart/form-data" >
                    Select image to upload:
                    <div class="form-group">
                        <input type="file" name="fileToUpload" id="fileToUpload" >
                    </div>
                    <div class="form-group">
                        <input type="text" name="imgName" placeholder="Enter image-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" placeholder="Place value" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="5" cols="20" placeholder="Say something.." class="form-control"></textarea>
                    </div>
                    <input type="submit" value="Upload" name="submit" class="btn btn-info ">
                </form>

           </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
        </div>
    </div>

