<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Category </h1>
        <br> <br>

        <?php
        if(isset($_SESSION['add']) )
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

?>

<br><br>


        <!-- ADD category -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="Title" placeholder="Category Title">
                    </td>

                </tr>

                <tr>
                    <td>Select Image: </td>

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:   </td>
                    <td>
                        <input type="radio" name="Featured" value=" Yes"> Yes
                        <input type="radio" name="Featured" value=" No"> No
                    </td>

                </tr>

                <tr>
                    <td>Active:   </td>
                    <td>
                        <input type="radio" name="Active" value=" Yes"> Yes
                        <input type="radio" name="Active" value=" No"> No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add-catergory" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            //check if submit btn is clicked or not
            if(isset($_POST['submit'])) 
            {
                //Get the value
                $title=$_POST['Title'];

                //For radio input we need to check whether btn is selected or not
                if(isset($_POST['Featured']))
                {
                    $featured=$_POST['Featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($_POST['Active']))
                {
                    $active=$_POST['Active'];
                }
                else
                {
                    $active= 'No';
                }

                //Check if image is selected or not
               if(isset($_FILES['image']['name']))
               {
                //Upload the image
                //Image name, source path, destination paath
                $image_name=$_FILES['image']['name'];
                //Auto rename image
                $ext=end(explode('.', $image_name));
                $image_name="Food_category_".rand(000,999).'.'.$ext;

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;

                $upload= move_uploaded_file($source_path, $destination_path);

                if($upload==false)
                {
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                    header('location:'.SITEURL.'admin/add-category');
                }
               }
               else
               {
                $image_name="";
               }

                //Create sql query for inserting values
                $sql="INSERT INTO tbl_category SET
                    Title='$title',
                    Image_name='$image_name',
                    Featured='$featured',
                    Active='$active'
                    
                ";

                //Execute the query and save in db
                $res=mysqli_query($conn,$sql);

                //check wheether query is executed or not
                if ($res == true) {
                    // Executed
                    $_SESSION["add"] = "<div class='success'>Category added successfully</div>";
                    header('HTTP/1.1 303 See Other');
                    header('Location: ' . SITEURL . 'admin/manage-category.php');
                    exit();
                } else {
                    // Failed
                    $_SESSION["add"] = "<div class='error'>Failed to add category</div>";
                    header('Location: ' . SITEURL . 'admin/add-category.php');
                    exit();
                }
            }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>