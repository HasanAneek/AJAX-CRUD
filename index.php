<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax CRUD</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <table>
        <tr>
            <td>  <h1>PHP & Ajax CRUD</h1>
            <div id="search_bar">
                <label style="margin-left: 150px" >Search</label>
                <input type="text"  id="search" autocomplete="off">
            </div>
            </td>
        </tr>
        <tr>
            <td id="table_form">
                <form id="form_table">
                    First Name: <input type="text" id="fname">
                    Last Name : <input type="text" id="lname">
                    <input type="submit" id="save_button" value="Save">
                </form>
            </td>
        </tr>
        <tr>
            <td id="table_data"></td>
        </tr>
    </table>
    <div id="error_message"></div>
    <div id="success_message"></div>
    <div id="modal">
        <div id="modal_form">
            <h2>Edit Form</h2>
            <table cellpadding="10px" width="100%">
            </table>
            <div id="close_btn">X</div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
            // Load Data Record
            function loadTable() {
                $.ajax({
                    url: "ajax_load.php",
                    type: "POST",
                    success: function (data) {
                        $("#table_data").html(data);
                    }
                });
            }
            loadTable();
            //Insert data
            $("#save_button").on("click",function(e){
                e.preventDefault();
               var fname = $("#fname").val();
               var lname = $("#lname").val();
               if(fname == "" || lname ==""){
                    $("#error_message").html("All Files are Required").slideDown();
                    $("#success_message").slideUp();
               }else{
                   $.ajax({
                       url: "ajax_insert.php",
                       type: "POST",
                       data:{first_name:fname,last_name:lname},
                       success:function(data){
                           if(data == 1){
                               loadTable();
                               $("#form_table").trigger("reset");
                               $("#success_message").html("Record Updated Successfully").slideDown();
                               $("#error_message").slideUp();
                           }else{
                               $("#error_message").html("No Data Found!").slideDown();
                               $("#success_message").slideUp();
                           }
                       }
                   });
               }

            });
            //Delete data Record
            $(document).on("click",".delete_btn",function() {
                if (confirm("Are you sure you want to delete?")) {
                var studentId = $(this).data("id");
                var element = this;
                $.ajax({
                    url: "ajax_delete.php",
                    type: "POST",
                    data: {id: studentId},
                    success: function (data) {
                        if (data == 1) {
                            $(element).closest("tr").fadeOut();
                        } else {
                            $("#error_message").html("No File deleted").slideDown();
                            $("#success_message").slideUp();
                        }
                    }
                });
            }
            });
            //Show Modal form
            $(document).on("click",".edit_btn",function(){
               $("#modal").show();
               var studentId = $(this).data("eid");
               $.ajax({
                  url:"ajax_updateForm.php",
                   type:"POST",
                   data:{id:studentId},
                   success:function(data){
                       $("#modal_form table").html(data);
                   }
               });
            });
            //Hide Modal box
            $("#close_btn").on("click",function(){
               $("#modal").hide();
            });
            //Save button Modal form
            $(document).on("click","#edit_submit",function(){
               var stuId = $("#edit_id").val();
               var fname = $("#edit_fname").val();
               var lname = $("#edit_lname").val();

               $.ajax({
                  url:"ajax_update.php",
                  type:"POST",
                  data:{id:stuId,first_name:fname,last_name:lname},
                  success:function (data){
                      if(data == 1){
                          $("#modal").hide();
                          loadTable();
                      }
                  }
               });
            });
            //Live Search
            $("#search").on("keyup",function(){
               var search_term = $(this).val();
               $.ajax({
                  url:"ajax_search.php",
                   type:"POST",
                   data:{search:search_term},
                   success:function (data){
                        $("#table_data").html(data);
                   }
               });
            });
        });
    </script>
</body>
</html>