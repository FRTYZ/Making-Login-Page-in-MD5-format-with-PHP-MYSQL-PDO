<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	
	<script src="js/jquery-3.4.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/login.js"></script>	    
	<style>
		body {background-color:#343a40;}
	</style>
</head>
<body>
	<?php
session_start(); //We started the session
include("fonc.php"); //we included the database

//if there is Session available we redirect the page.
if (isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876") {
    header("location:index.php");
} //If "remember me" is checked beforehand, we create Session and redirect the page.
else if (isset($_COOKIE["cookie"])) {
    
    //Usernames are queried
    $query = $connect->prepare("select user from users");
    $query->execute();


    //We get the usernames one by one with the help of loop
    while ($result = $query->fetch()) {
        //If there is a user suitable for the structure we have determined, we look at it.
        if ($_COOKIE["cookie"] == md5("aa" . $result['user'] . "bb")) {

            //Session creation, you can make the values here different in terms of security. I also kept the username here
            $_SESSION["Session"] = "9876";
            $_SESSION["user"] = $result['user'];

            //Redirecting to index pagem
            header("location:index.php");
        }
    }
}
//We check if the login form has been filled
if ($_POST) {
    $txtuser = $_POST["txtuser"]; //We assigned the username to the variable
    $txtpassword = $_POST["txtpassword"]; //we assigned the password to the variable
}
?>
 <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
		<div class="col-md-12 text-center mb-5"><a href="https://github.com/FRTYZ">
            <img style="height:70%" src="img/logo.png"></a>
			</div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login -->
                    <div class="card rounded-0" id="login-form">
                        <div class="card-header">
                            <h3 class="mb-0">User Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" value="<?php echo @$txtuser ?>" class="form-control form-control-lg rounded-0" name="txtuser" id="inputuser" required name="txtpassword">
     
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" id="inputPassword" required name="txtpassword">
                        
                                </div>

                                      <label>
                            <input type="checkbox" ID="cbkremember" name="cbkremember"/>
                            Remember Me
                        	</label>
                        	<br>

                                <button type="submit" class="btn btn-warning btn-lg float-right" ID="btnlogin">Login</button> 
                                 <script type="text/javascript" src="js/sweetalert.min.js"></script>
                        <?php
                        //If there is a post, that is, if it is submitted, we control it from the database.
                        if ($_POST) {
                            //In the query, we take the username and see if there is a corresponding password.
                            $query = $connect->prepare("select password from users where user=:user");
                            $query->execute(array('user' => htmlspecialchars($txtuser)));
                            $result = $query->fetch();//executing query and getting data


                            //I encrypted the passwords with md5 and added my own to the beginning and the end.
                            if (md5("56" . $txtpassword . "23") == $result["password"]) {
                                $_SESSION["Session"] = "9876"; //Creating a session
                                $_SESSION["user"] = $txtuser;

                                //If "remember me" is selected, we create a cookie.
                                // I created it from the username by encrypting it in the cookie
                                if (isset($_POST["cbkremember"])) {
                                    setcookie("cookie", md5("aa" . $txtuser . "bb"), time() + (60 * 60 * 24 * 7));
                                }
                                  echo '<script>swal("Successful","Signed in Successfully","success").then((value)=>{ window.location.href = "index.php"}); </script>'; 
                                //If adding data is successful, it is written that it is successful with sweetalert.
                               // If the Add query worked it redirects to index.php page          


                            } else {
                                //If the username and password are not entered correctly, we get an error message.
                                 echo '<script>swal("Oops","Error, Please Check Your Information","error");</script>'; 
            // If the id is not found or there is an error in the query, we print an error.

                            }
                        }
                        ?>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>	
</body>
</html>