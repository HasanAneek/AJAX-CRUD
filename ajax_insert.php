<?php
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];

$conn = mysqli_connect("localhost","root","","student") or die("Connection Error");
$sql = "INSERT INTO intro(first_name,last_name) VALUES('{$firstName}','{$lastName}') ";
if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}