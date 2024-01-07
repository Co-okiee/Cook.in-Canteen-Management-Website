<?php include("partials-front/menu.php"); ?>

    <?php 
        if(isset($_GET['food_id']))
        {
            $food_id =$_GET['food_id'];

            $sql="SELECT * FROM tbl_food WHERE ID=$food_id";
            $result = mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);

            if($count> 0)
            {
                $row=mysqli_fetch_assoc($result);

                $title=$row['Title'];
                $price=$row['Price'];
                $image_name=$row['Image_name'];


            }
            else
            {
                header('location:' .SITEURL);
            }
        }
        else
        {
            header('location:' .SITEURL );
        }
    
    
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    
                                    ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="Food" value="<?php echo $title; ?>">
                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="Price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name"  class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact"  class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email"  class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            if(isset($_POST['submit']))
            {
                $food=$_POST['Food'];
                $price=$_POST['Price'];
                $qty=$_POST['qty'];

                $total=$price * $qty;
                $order_date=date('Y-m-d H:i:sa');
                $status = 'Ordered';
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                $sql2= "INSERT INTO tbl_order SET 
                    Food='$food',
                    Price=$price,
                    Qty=$qty,
                    Total=$total,
                    Order_date='$order_date',
                    Status='$status',
                    Customer_name='$customer_name',
                    Customer_contact='$customer_contact',
                    Customer_email='$customer_email',
                    Customer_address='$customer_address'
                    
                    ";

                    $result2=mysqli_query($conn,$sql2);

                    if($result2==true)
                    {
                        $_SESSION['Order']="<div class='success text-center'>Food ordered successfully</div>";
                        header('location:' .SITEURL);
                    }
                    else
                    {
                        $_SESSION['Order']="<div class='error text-center'>Failed to order foody</div>";
                    }
            }

            // Define the criteria for selecting orders to be archived
            $select_criteria = "Order_date < DATE_SUB(NOW(), INTERVAL 1 DAY)";

            // Create the SQL query to archive orders
            $insert_sql = "INSERT INTO tbl_orderhistory (OID, Food, Total, Customer_name, Order_date, Status)
                          SELECT NULL, Food, Total, Customer_name, Order_date, 'Archived'
                          FROM tbl_order
                          WHERE $select_criteria";
            
            // Archive orders
            if ($conn->query($insert_sql) === TRUE) {
                //echo "Orders archived successfully.";
                
                // Delete the selected orders from tbl_order
                $delete_sql = "DELETE FROM tbl_order WHERE $select_criteria";
                
                if ($conn->query($delete_sql) === TRUE) {
                    //echo "Orders deleted from tbl_order successfully.";
                } else {
                    echo "Error deleting orders from tbl_order: " . $conn->error;
                }
            } else {
                echo "Error archiving orders: " . $conn->error;
            }
            


            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

   

    <?php include("partials-front/footer.php"); ?>