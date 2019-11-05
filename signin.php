<?php include 'header.php';
include 'config.php';
$name = $email = $password1 = $password2 = $phone = '';
$login_err = '';


function cleaner($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

//REQUEST:USED TO COLLECT DATA from a submitted html form.
//POST:USED TO COLLECT DATA from a submitted html form that used method = post
if(isset($_POST['signupBtn'])){
//    grabbing form data
    $name = $_POST['jina'];
    $phone = $_POST['contact'];
    $email = $_POST['arafa'];
    $password1 = $_POST['basswad1'];
    $password2 = $_POST['basswad2'];

//    clean the data
    $name = cleaner($name);
    $phone = cleaner($phone);
    $email = cleaner($email);
    $password1 = cleaner($password1);
    $password2 = cleaner($password2);

//    check if the user exists in the database: if true ask them to login instead
    $sql = "SELECT * FROM `customers` WHERE email ='$email' LIMIT 1";
    $results = mysqli_query($conn,$sql);


    if(mysqli_num_rows($results) > 0){

        //User found
        $login_err = "User exists. Login";
        header("location:login.php?error=$login_err");
        exit();
    }else{

        //Check if passwords match
        if($password1!==$password2){
            $password_err = 'Error, passwords not matching';

            header("location:signin.php?error=$password_err");
            exit();

        }else{

//            encrypt the password
            $password = md5($password2);

            //Insert user into the database
            $sql = "INSERT INTO `customers`(`id`, `name`, `phone`, `email`, `password`) VALUES (NULL ,'$name','$phone','$email','$password')";
            if (mysqli_query($conn,$sql)){
                echo "New record added";
                exit();
            }else{
                echo "Error: " .$sql . "<br>";
                header('location:signin.php');
            }

            //Redirect to the login page
            header("location:login.php");
        }
    }
    mysqli_close($conn);
}
?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="signin.php" method="post">
                <div class="form-group">
                    <h3 class="text text-warning">Welcome To Miami-Motors.</h3>
                    <p style="text-align: center; color: red">Create Your Account Now!</p>
                </div>
                <div class="form-group">
                    <label for ='username'>Username</label>
                    <input type="text" name="jina" placeholder="Enter Username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for =''>Phone</label>
                    <input type="tel" name="contact" placeholder="+254---" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for =''>Email</label>
                    <input type="email" name="arafa" placeholder="Enter Email" class="form-control" required>
                </div>
                <div>
                    <?php
                    if (isset($_GET['error'])){
                        echo "<p class='text-danger'>Error: Passwords didn't match.</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for =''>Password</label>
                    <input type="password" name="basswad1" placeholder="Enter Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for ='password'>Confirm Password</label>
                    <input type="password" name="basswad2" placeholder="Confirm Password" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="signupBtn" value="Signup" class="btn form-control btn-info">
                </div>

            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>











<?php include 'footer.php'?>
