<!DOCTYPE html>
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
</div>
</form>
</div>
</div>
</div>
</div>
</div>

</body>
</html>