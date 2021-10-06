<?php
$id = $_POST['id'];

$conn = mysqli_connect("localhost","root","","student") or die("Connection Error");
$sql = "SELECT * FROM intro WHERE id={$id}";
$result = mysqli_query($conn,$sql);

$output ="";
if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)){
        $output .=
            "<tr>
               <td>First Name</td>
               <td> <input type='text' id='edit_fname' value='{$row['first_name']}' > </td>
               <td> <input type='text' hidden id='edit_id' value='{$row['id']}'> </td>
            </tr>
           <tr>
             <td>Last Name</td>
             <td> <input type='text' id='edit_lname' value='{$row['last_name']}'>  </td>
          </tr>
          <tr>
          <td> <input type='submit' id='edit_submit' value='Save'> </td>
</tr> ";
    }
    mysqli_close($conn);
   echo  $output;
}else{
    echo "<h2>No Data Found</h2>";
}