<?php 
include('../config/constants.php');
    //check whether id and image_name value is set or not
    if(isset($_GET['ID']) AND isset($_GET['Image_name']))
    {
        //echo "dlt";
        $id=$_GET['ID'];
        $image_name=$_GET['Image_name'];

        if($image_name != "")
        {
            $path="../images/category/".$image_name;
            $remove=unlink($path);

            if($remove==false)
            {
                $_SESSION['remove']="<div class='error'>Failed to remove category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die(); //Stop the process
            }
        }

        $sql= "DELETE FROM tbl_category WHERE ID=$id";
        $res = mysqli_query($conn,$sql);

        //check
        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>