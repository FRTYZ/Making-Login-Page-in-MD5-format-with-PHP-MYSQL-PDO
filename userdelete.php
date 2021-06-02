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