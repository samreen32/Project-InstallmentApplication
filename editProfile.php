<?php

require("user_timestamp.php");
require_once('database.php');
$id = $_SESSION['user_id'];

 if(isset($_REQUEST['submit'])){

    $fname = $database->sanitize($_POST['fname']);
    $email = $database->sanitize($_POST['email']);
    $address = $database->sanitize($_POST['address']);
    $phone = $database->sanitize($_POST['phone']);

    $result = $database->editProfileInfo($fname, $email, $address, $phone, $id);
    if($result){
        $_SESSION['status'] = "Your Profile has been Updated.";
    }else{
        $_SESSION['status'] = "Not updated.";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--=============== REMIX ICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Customer Installment-Application</title>

    <style>
    .profile-pic {
        color: transparent;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        transition: all 0.3s ease;
    }

    .profile-pic input {
        display: none;
    }

    .profile-pic img {
        position: absolute;
        object-fit: cover;
        width: 165px;
        height: 165px;
        box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.35);
        border-radius: 100px;
        z-index: 0;
    }

    .profile-pic .-label {
        cursor: pointer;
        height: 165px;
        width: 165px;
    }

    .profile-pic:hover .-label {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: "rgba(0, 0, 0, 0.8)";
        z-index: 10000;
        color: #fafafa;
        transition: background-color 0.2s ease-in-out;
        border-radius: 100px;
        margin-bottom: 0;
    }

    .profile-pic span {
        display: inline-flex;
        padding: 0.2em;
        height: 2em;
    }
    </style>

</head>


<body>

    <!-- header -->
    <div class="container my-5">
        <div class="nav__bar">
            <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
                <div class="container-fluid my-3" style="margin-left: 30px;">
                    <span style="margin-left: 20px">
                        <a type="button" style="color: white;" href="Profile.php">
                            <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                        <a class="navbar-brand nav__logo mx-3 my-1" href="#">Edit Profile</a>
                    </span>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <span style="margin-left: 980px">
                        <a style="color: white;" href="logout.php"> 
                            <span class="fa fa-sign-in fa-lg img-fluid mx-2 button__icon"></span>Logout</a>
                    </span>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!--Body -->
    <div class="main" style="background-color: #9575CD;">
        <div class="row my-5">
            <div class="col" style="margin-top: 40px;">
                <div class="col mx-5">
                    <div class="row row-header my-3">
                        <?php
                            if(isset($_SESSION['status']) && $_SESSION != ''){ 
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong><?php echo " ".$_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php 
                            unset($_SESSION['status']); 
                                } 
                        ?>
                        <div class="card modal-body" style="width: 55rem;">
                            <div class="my-4 mx-3">
                                <a type="button" href="profile.php" style="color: black;">
                                    <i class="fa fa-angle-left fa-4x img-fluid" aria-hidden="true"></i>
                                </a>

                                <!--Form Adding -->
                                <form method="post" style="text-align: center; ">
                                    <h3 style="color: black; text-align: center">Edit Profile</h3><br />
                                    <div class="form-row my-5">
                                    <?php
                                        $id = $_SESSION['user_id'];
                                        $res = $database->view($id);
                                        while($row = mysqli_fetch_assoc($res)){ 
                                    ?>
                                        <div class="form-group col-md-5 my-2" style="margin: auto">
                                            <label for="fname" class="form-label">User Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" 
                                            value="<?php echo $row['fname'] ?>" />
                                        </div>

                                        <div class="form-group col-md-5 my-2" style="margin: auto">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email" 
                                            value="<?php echo $row['email'] ?>"
                                                aria-describedby="emailHelp" />
                                        </div>
                                        <div class="form-group col-md-5 my-2" style="margin: auto">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                value="<?php echo $row['address'] ?>" />
                                        </div>
                                        <div class="form-group col-md-5 my-2" style="margin: auto">
                                            <label for="phone" class="form-label">Personal Number</label>
                                            <input type="number" name="phone" class="form-control" id="phone"
                                                value="<?php echo $row['phone'] ?>" />
                                        </div>

                                        <input name="submit" type="submit" class="button button--flex mx-3 my-4"
                                            value="Update Profile" />
                                    </div>
                                    <?php  }?>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="assets/js/scripts.js"></script>
<script src="jquery-3.6.3.js"></script>

<script>
$(document).ready(function() {
    setInterval(function() {
        check_user(1);
    }, 500);
});

function check_user(id) {
    console.log(id);
    $.ajax({
        type: 'post',
        url: 'user_timestamp.php',
        dataType: 'html',
        data: {
            id: id
        },
        success: function(response) {
            if (response == 'logout') {
                window.location.href = 'logout.php';
            }
        }
    });
}
</script>

</html>