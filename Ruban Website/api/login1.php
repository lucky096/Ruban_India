<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
header("location: loginf.php");
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("ruban", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from user_info where password='$password' AND  username='$username'", $connection);
$rows1 = mysql_num_rows($query);
if ($rows1 == 1) {

$row = mysql_fetch_array($query); 


$_SESSION["username"]=$row["username"];
$_SESSION["user_id"]=$row["user_id"];
header("location: user.php"); // Redirecting To Other Page

}
else
	header("location: ../html/loginf.html");

mysql_close($connection); // Closing Connection
}
}
?>