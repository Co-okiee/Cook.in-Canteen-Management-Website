<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage order</h1>

            <br /><br /><br />

            <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }


?>
<br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date </th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Customer Address</th>
                    <th>Action</th>


                </tr>

                <?php 
                $sql="SELECT * FROM tbl_order ORDER BY ID DESC";
                $result=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($result);

                $sn=1;

                if($count> 0)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $id=$row['ID'];
                        $food=$row['Food'];
                        $price=$row['Price'];
                        $qty=$row['Qty'];
                        $total=$price*$qty;
                        $order_date=$row['Order_date'];
                        $status=$row['Status'];
                        $Customer_name=$row['Customer_name'];
                        $Customer_contact=$row['Customer_contact'];
                        $Customer_email=$row['Customer_email'];
                        $Customer_address=$row['Customer_address'];

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php 
                                        if($status=="Ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status== "On Delivery")
                                        {
                                            echo "<label style='color: orange'>$status</label>";
                                        }
                                        elseif($status== "Delivered")
                                        {
                                            echo "<label  style='color: green'>$status</label>";
                                        }
                                        elseif($status== "Cancelled")
                                        {
                                            echo "<label  style='color: red' >$status</label>";
                                        }
                                        ?>
        </td>
                                <td><?php echo $Customer_name; ?></td>
                                <td><?php echo $Customer_contact; ?></td>
                                <td><?php echo $Customer_email; ?></td>
                                <td><?php echo $Customer_address; ?></td>

                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?ID=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>

                        <?php

                    }
                }
                else
                {
                    echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                }
                
                
                
                ?>

                

                


            </table>
    </div>
</div>

<?php include('partials/footer.php') ?>