<?php 
    include('../config/constants.php');
    // Get id of admin
    $id = $_GET['id'];
    //Create sql query for deleting the admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //eXECUTE THE QUERY
    $res = mysqli_query($conn, $sql);
    //Check
    if($res==true)
    {
        $_SESSION['delete']="<div class='success'>Admin deleted successfully.</div>";
        header('location:' .SITEURL. 'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete']="<div class='error'>Failed to delete admin. Try again later.</div>";
        header('location:' .SITEURL. 'admin/manage-admin.php');
    }
    //Redirect to manage admin page with message



?>