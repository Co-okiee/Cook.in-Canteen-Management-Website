<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        } 
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="Title" placeholder="Title of the Food">
                    </td>
                </tr> 
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="Description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="Price">
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                        <?php
                        // Create PHP Code to display categories from Database
                        // 1. Create SQL to get all active categories from the database
                        $sql = "SELECT * FROM tbl_category";
                        
                        // Executing query
                        $res = mysqli_query($conn, $sql);
                        
                        // Count Rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);
                        
                        // If count is greater than zero, we have categories, else we do not have categories
                        if ($count > 0)
                        {
                            // We have categories
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                // Get the details of categories
                                $id = $row['ID'];
                                $title = $row['Title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            // We do not have categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes"> Yes
                        <input type="radio" name="Featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="Active" value="Yes"> Yes
                        <input type="radio" name="Active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
        if(isset($_POST['submit']))
        {
            // Add the Food in Database
            // 1. Get the Data from Form
            $title = $_POST['Title'];
            $description = $_POST['Description'];
            $price = $_POST['Price'];
            $category = $_POST['category'];
            
            // Check whether radio buttons for featured and active are checked or not
            $featured = isset($_POST['Featured']) ? $_POST['Featured'] : "No";
            $active = isset($_POST['Active']) ? $_POST['Active'] : "No";

            // 2. Upload the Image if selected
            if(isset($_FILES['image']['name']))
            {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // Check whether the Image is Selected or not and upload the image only if selected
                if($image_name != "")
                {
                    // Get the file extension
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; // New Image Name

                    // Destination Path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;

                    // Move the uploaded file to the destination directory
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $dst))
                    {
                        // Image uploaded successfully
                    }
                    else
                    {
                        // Image upload failed
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location: '.SITEURL.'admin/add-food.php');
                        // Stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name = ""; // Set Default Value as blank
            }
            
            // 3. Insert Into Database
            $sql2 = "INSERT INTO tbl_food SET
                Title = '$title',
                Description = '$description',
                Price = $price,
                Image_name = '$image_name',
                Category_id = $category,
                Featured = '$featured',
                Active = '$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

            // Check whether data inserted or not
            if($res2 == true)
            {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location: '.SITEURL.'admin/manage-food.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header('location: '.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
