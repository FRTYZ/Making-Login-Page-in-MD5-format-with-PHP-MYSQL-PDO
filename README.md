# Making Login Page in MD5 format with PHP MYSQL PDO

## Hello there,
In this Project, it has all the features that can be found in PHP MYSQL (PDO) Login operations.

#### Our Project Content
* Encrypt passwords with MD5 format (Available in Add, Edit)
* Making "Remember Me"
* 2 Checking passwords on input
* Alerts with SweatAlert
* User Deletion
* Add User
* Editing User
* When you open the page, first redirect to the login page

## Login Page (login.php)
* Remember ME Section
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-login.png?raw=true)

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-login-alert.png?raw=true)

## Home Page (index.php)
* Listing Data
* Applying Add, Edit, Delete Operations

![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-home.png?raw=true)

## User ADD Page (useradd.php)
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-add.png?raw=true) 

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-add-alert.png?raw=true)

## User Update Page (userupdate.php)
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-update.png?raw=true) 

#### Alert with SweatAlert
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-update-alert.png?raw=true)
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-update-alert2.png?raw=true)

## Alert with SweatAlert (userdelete.php)
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-delete.png?raw=true)

## Database
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-database.png?raw=true)

#### Database Data
* As you can see, our passwords are saved in the database in MD5 format.
![alt text](https://github.com/FRTYZ/Making-Login-Page-in-MD5-format-with-PHP-MYSQL-PDO/blob/main/img/ss/user-database.png?raw=true)

## Source Codes
* Related explanations are in the source code

#### fonc.php (Our Database Settings) 
```
<?php
$host = '127.0.0.1';
$dbname = 'loginpdo';
$username = 'root';
$password = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   
];
try {
    $connect = new PDO($dsn, $username, $password, $options);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connect error: ' . $e->getMessage();
    exit;
}
?>
```

#### login.php (Login Page) 
* We are pulling the "users" and "passwords" data from the database.
* Redirect to "index.php" page if logged in before
```
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
```

#### login.php (Checking your login)
```
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
```




#### index.php (When you open the page, first redirect to the login page) 
* Place it at the top of our <html> tag.
```
<?php
//When you open the project, we first provide redirection to the login page.
session_start(); //We started the session

//if there is Session available we redirect the page.
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //If remember me is checked beforehand, we create Session and direct the page.
?>
```


#### index.php (Printing Data from Database) 
```
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <th>ID</th>
                            <th>User name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            include('fonc.php');
            $query = $connect->prepare("SELECT * from users"); // We Wrote Our Query
            $query->execute();
            while ($result = $query->fetch()) {   // Returning Our Query with While
                ?>
                <tr>
                    <td><?=$result['id']?></td>
                    <td><?=$result['user']?></td>
                    <td><a href="userupdate.php?id=<?= $result["id"] ?>"><img height="25" width="25" src="img/edit.png"/></a></td>    
                    <td>

                    </a>
                    <a data-toggle="modal" href="#" data-target="#delete<?php echo $result["id"] ?>">
                        <img height="25" width="25" src="img/delete.png"/></a>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $result["id"] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Deletion Of User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h2 style="color: red; text-align: center">Important Warning !</h2>

                                            <h4 style="text-align: center">
                                                Are you sure you want to delete<br><b><?php echo $result["user"] ?><br>
                                               </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <a href="userdelete.php?page=users&amp;id=<?= $result["id"] ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <?php
        } // While End
        ?>
    </tr>
</tbody>
</table>
</div>                   
</tbody>
</table>
```



## index.php (All Codes) 
```
<?php
//When you open the project, we first provide redirection to the login page.
session_start(); //We started the session

//if there is Session available we redirect the page.
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //If remember me is checked beforehand, we create Session and direct the page.
?>
<!DOCTYPE html>
<html>
<head>
    <title>LOGİN PDO MD5</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <html lang="en">
</head>
<body>
<div class="container">      
        <div class="col-md-6">
            <div class="text-center">
                <h3>LOGİN PDO MD5</h3>
                <a class="btn btn-danger" href="logout.php">Sign OUT</a>            
            </div>
            <br/>
        </div>
        <div class="col-md-6">
         <div class="card">
            <a class="btn btn-success" href="useradd.php">New User ADD</a> 
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <th>ID</th>
                            <th>User name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            include('fonc.php');
            $query = $connect->prepare("SELECT * from users"); // We Wrote Our Query
            $query->execute();
            while ($result = $query->fetch()) {   // Returning Our Query with While
                ?>
                <tr>
                    <td><?=$result['id']?></td>
                    <td><?=$result['user']?></td>
                    <td><a href="userupdate.php?id=<?= $result["id"] ?>"><img height="25" width="25" src="img/edit.png"/></a></td>    
                    <td>

                    </a>
                    <a data-toggle="modal" href="#" data-target="#delete<?php echo $result["id"] ?>">
                        <img height="25" width="25" src="img/delete.png"/></a>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $result["id"] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Deletion Of User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h2 style="color: red; text-align: center">Important Warning !</h2>

                                            <h4 style="text-align: center">
                                                Are you sure you want to delete<br><b><?php echo $result["user"] ?><br>
                                               </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <a href="userdelete.php?page=users&amp;id=<?= $result["id"] ?>" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <?php
        } // While End
        ?>
    </tr>
</tbody>
</table>
</div>                   
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

    <script src="js/jquery-3.4.1.min.js"></script>  
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
```




#### useradd.php (All Codes)(Adding New User) 
```
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title></title>
</head>
<body>
<body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">     
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home Page</a>
                        </li>
                        <li class="breadcrumb-item active">New User ADD</li>
                    </ol>            
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input required type="text" class="form-control" name="user" placeholder="New User Name">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input required type="password" class="form-control" name="password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input required type="password" class="form-control" name="passwordagain" placeholder="Confirm New Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <script type="text/javascript" src="js/sweetalert.min.js"></script>
                                    <?php
                                    include('fonc.php');
                                    
if ($_POST) { // We check if there is a post on the page.

    $user = $_POST['user'];// After the page is refreshed, we assign the posted values to the variables
    $password = md5('56' . $_POST['password'] . '23'); 
     // We encrypt variables with MD5 Format according to specified ranges
    $passwordagain = md5('56' . $_POST['passwordagain'] . '23'); // We encrypt variables with MD5 Format   
    $error = "";  // We print our mistakes

    
    
    if ($user <> "" && $password <> "" && $error == "") { // // We check if the data fields are empty. You can do it in other controls.
        //Data to change
        $line = [                       
            'user' => $user,
            'password' => $password, 

        ];

        if ($password == $passwordagain && $password != '' && $user != '') {   // Checking if New Password and Repeat Password are the same


            $sql = "INSERT INTO users SET user=:user, password=:password;";   
                  // If all conditions are positive, we write our data insertion query.
            $status = $connect->prepare($sql)->execute($line);

            if ($status) {
                echo '<script>swal("New User Added.","New User Added.","success").then((value)=>{ window.location.href = "index.php"}); </script>'; 
                //If adding data is successful, it is written that it is successful with sweetalert.
                // If the Add query works, it redirects to the index.php page.

            }
        }
        else {
            echo '<script>swal("Error","Error , Please check your information","error");</script>'; 
            // If the id is not found or there is an error in the query, we print an error
        }
    }
    if ($error != "") {
        echo '<script>swal("Error","' . $error . '","Error");</script>'; // We print our errors that may occur in queries and database
    }
}
?>                        
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
```



#### userupdate.php (Transferring Data to Inputs in Database)(with md5 encryption format)
* Veritabanındaki Verilerin input lardaki value bölümüne aktarıyoruz

```
value="<?= $result["user"] ?>"
```
```
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title></title>
</head>
<?php
include('fonc.php');  // We Connected Our Database

$query = $connect->prepare("SELECT * FROM users Where id=:id");
    // We transfer the incoming IDs to variables and inputs.
$query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//executing query and getting data
?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home Page</a>
                    </li>
                    <li class="breadcrumb-item active">User Update</li>
                </ol>
                <div class="card mb-3">

                    <div class="card-body">

                        <form method="post" action="" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>User Name</label>
                                <input required type="text" value="<?= $result["user"] ?>" class="form-control" name="user"
                                placeholder="New User Name">
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input required type="password" class="form-control" name="password"
                                placeholder="Enter New Password">
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input required type="password" class="form-control" name="passwordagain"
                                placeholder="Enter Confirm New Password">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <script type="text/javascript" src="js/sweetalert.min.js"></script>
```

#### userupdate.php (Importing new User data into database)(with md5 encryption format)
* Pay attention to the "name" of the inputs
```
 <?php
                                
if ($_POST) { // We check if there is a post on the page.

    $user = $_POST['user'];// After the page is refreshed, we assign the posted values to the variables
    $password = md5('56' . $_POST['password'] . '23');  
    // We encrypt variables with MD5 Format according to specified ranges
    $passwordagain = md5('56' . $_POST['passwordagain'] . '23'); // We encrypt variables with MD5 Format   
    $error = "";

    // We make sure that the data fields are not empty. You can do it in other controls.
    
    if ($user <> "" && $password <> "" && $error == "") { // We make sure that the data fields are not empty.
        //Data to change
        $line = [
            'id' => $_GET['id'],            
            'user' => $user,
            'password' => $password, 


        ];

        if ($password == $passwordagain && $password != '' && $user != '') {
         // We make sure that the data fields are not empty. You can do it in other controls.

            $sql = "UPDATE users SET user=:user,password=:password WHERE id=:id;";
            $status = $connect->prepare($sql)->execute($line);

            if ($status) {
                echo '<script>swal("Successfull","User Updated","success").then((value)=>{ window.location.href = "index.php"});

                </script>';
            // If the update query is working, it redirects to the products.php page.
            } 
        }
        else {
            echo '<script>swal("Oops","Error, Please make sure you entered your information correctly.","error");</script>'; // If the id is not found or there is an error in the query, we print an error.
        }
    }
    if ($error != "") {
        echo '<script>swal("Oops","' . $error . '","error");</script>'; // We print out any errors that may occur in queries and databases.
    }
}

?>
```


#### userdelete.php (Deleting users) 
```
<?php
session_start(); //we started a session

//redirects page if current session exists
if (!(isset($_SESSION["Session"]) && $_SESSION["Session"] == "9876")) {
    header("location:login.php");
} //If remember me is checked beforehand, we create a session and redirect the page.

if ($_GET) {

    $page = $_GET["page"];
    include("fonc.php"); // we include our database connection on our page.
    $query = $connect->prepare("SELECT * FROM $page Where id=:id");
    $query->execute(['id' => (int)$_GET["id"]]);
    $result = $query->fetch();//executing query and getting data   

    // We write our query to delete the data whose id is selected.
    $where = ['id' => (int)$_GET['id']];
    $status = $connect->prepare("DELETE FROM $page WHERE id=:id")->execute($where);
    if ($status) {
        header("location:index.php"); // If the query works, we send it to the index.php page.
    }
}
?>
```



#### logout.php (Sign out) 
```
<?php
session_start();
session_destroy();
setcookie("Session", md5("aa" . $txtuser . "bb"), time() - 1);

header("location:index.php");

?>
```


Good Encodings
