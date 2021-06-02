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