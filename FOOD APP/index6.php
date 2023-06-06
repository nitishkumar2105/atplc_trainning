<?php

if(isset $_POST([`username`]))
{

$server="localhost";
$username="root";
$password="";

$con=mysqli_connect($server,$username,$password)

if(!$con){
    die("connection is failed".mysqli_connect_error());
}
// echo "succesfully connection"


$username=$_POST[`username`]
$number=$_POST[`number`]
$email=$_POST[`email`]
$password=$_POST[`password`]
$confirmpassword=$_POST[`confirmpassword`]


$sql="INSERT INTO `pizza_register`. `register detail` (`name`, `phone no.`, `email`, `password`, `confirm-password`, `date`) VALUES ('$username', '$number', '$email', '$password', '$confirmpassword', current_timestamp());
";

if($con->query($sql)==true){
echo "successfully registration";
}
else{
    echo "ERRORE";
}

$con->close();
}

?>




