<?php
$student_id = $_POST['id'];
$conn = mysqli_connect("localhost","root","","student") or die("Connection Error");
$sql = "DELETE FROM intro WHERE id={$student_id}";
if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}