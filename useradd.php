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