<?php  include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
        if(isset($_GET['ID']))
        {
            $id = $_GET['ID'];
            $sql = "SELECT * FROM tbl_order WHERE ID=$id";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if($count == 1)
            {
                $row = mysqli_fetch_assoc($result);

                $food = $row['Food'];
                $price=$row['Price'];
                $qty=$row['Qty'];
                $total=$price*$qty;
                $status=$row['Status'];
                $Customer_name=$row['Customer_name'];
                $Customer_contact=$row['Customer_contact'];
                $Customer_email=$row['Customer_email'];
                $Customer_address=$row['Customer_address'];

            }
            else
            {
                header('location:' .SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            header('location:' .SITEURL.'admin/manage-order.php');
        }


?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Food Name</td>
                <td><b><?php echo $food;?></b></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><b>Rs. <?php echo $price;?></b></td>

            </tr>

            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty;?>">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status" >
                        <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name: </td>
                <td>
                    <input type="text" name="Customer_name" value="<?php echo $Customer_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Contact: </td>
                <td>
                    <input type="text" name="Customer_contact" value="<?php echo $Customer_contact;?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email: </td>
                <td>
                    <input type="email" name="Customer_email" value="<?php echo $Customer_email;?>">
                </td>
            </tr>

            <tr>
                <td>Customer Address: </td>
                <td>
                    <textarea name="Customer_address"  cols="30" rows="5"><?php echo $Customer_address;?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="ID" value="<?php echo $id; ?>">
                    
                    <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                </td>
            </tr>

        </table>
        </form>

        <?php 
            if(isset($_POST["submit"]))
            {
               $id=$_POST['ID'];
               
               $qty=$_POST['qty'];
               $total= $price * $qty;
               $status=$_POST['status'];
               $Customer_name=$_POST['Customer_name'];
               $Customer_contact=$_POST['Customer_contact'];
               $Customer_email=$_POST['Customer_email'];
               $Customer_address=$_POST['Customer_address'];

               $sql2= "UPDATE tbl_order SET
                    Qty=$qty,
                    Total=$total,
                    Status='$status',
                    Customer_name='$Customer_name',
                    Customer_contact='$Customer_contact',
                    Customer_email='$Customer_email',
                    Customer_address='$Customer_address'
                    WHERE ID=$id

               
               ";

               $result2=mysqli_query($conn,$sql2);

               if($result2==true)
               {
                $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                header("location:".SITEURL."admin/manage-order.php");
               }
               else
               {
                $_SESSION['update']="<div class='error'>Failed to Update Order</div>";
                header("location:".SITEURL."admin/manage-order.php");
               }

            }

        ?>

    </div>
</div>
