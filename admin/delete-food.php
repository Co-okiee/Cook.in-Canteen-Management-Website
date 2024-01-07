<?php

include('../config/constants.php');

if (isset($_GET['ID']) && isset($_GET['Image_name'])) {
    $id = $_GET['ID'];
    $image_name = $_GET['Image_name'];

    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
            header('location: ' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE ID=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
        header("location: " . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        header("location: " . SITEURL . "admin/manage-food.php");
    }
} else {
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access. </div>";
    header('location: ' . SITEURL . 'admin/manage-food.php');
}
?>