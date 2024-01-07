<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" Name="Name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" Name="Username" placeholder="Enter your username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" Name="Password" placeholder="Enter your pass"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" Name="submit" value=" Add " class="btn-secondary" ></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    //Process the value from form and save it in data
    //Check if the button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        
        //Get the data 
        $name = $_POST['Name'];
        $username = $_POST['Username'];
        $password = md5($_POST['Password']); //Pass encryption with MD5

        //SQL Query to save the data in db
        $sql="INSERT INTO tbl_admin SET
            Name='$name',
            Username='$username',
            Password='$password'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Data is inserted or not and display message
        if($res==TRUE){
            //Data inserted
            //Creating session to display message
            $_SESSION['add']="<div class='success'>Admin Added Successfully :) </div>";
            //Redirect
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //Failed
            //Creating session to display message
            $_SESSION['add']="<div class='error'>Failed to add admin :( </div>";
            //Redirect
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>
