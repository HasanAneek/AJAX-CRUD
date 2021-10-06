<?php
$sid = $_POST['id'];
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];

$conn = mysqli_connect("localhost","root","","student") or die("Connection Error");
$sql = "UPDATE intro SET first_name='{$firstname}',last_name='{$lastname}' WHERE id={$sid}";

if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}