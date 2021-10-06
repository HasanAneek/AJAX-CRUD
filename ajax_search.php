<?php
$searchValue = $_POST['search'];

$conn = mysqli_connect("localhost","root","","student") or die("Connection Error");
$sql = "SELECT * FROM intro WHERE first_name LIKE '%{$searchValue}%' OR last_name LIKE'%{$searchValue}%' ";

$result = mysqli_query($conn,$sql);
$output ="";
if(mysqli_num_rows($result)>0){
    $output ='<table border="1" cellspacing="0" cellpadding="10px" width="100%" >
        <tr>
           <th>Id</th>
           <th> Name </th>
           <th width="90px">Edit</th>
           <th width="90px">Delete</th>
       </tr> ';
    while($row=mysqli_fetch_assoc($result)){
        $output .= "<tr> <td>{$row['id']}</td><td>{$row['first_name']} {$row['last_name']}</td> 
        <td><button  class='edit_btn' data-eid='{$row['id']}'>Edit</button></td>
        <td><button  class='delete_btn' data-id='{$row['id']}'>Delete</button></td> </tr>";
    }
    $output .="</table>";
    mysqli_close($conn);
    echo $output;
}else{
    echo "No Data Found In DB";
}