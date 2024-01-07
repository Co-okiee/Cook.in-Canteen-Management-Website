<?php include('partials/menu.php'); ?>
        <!-- Main content section-->
        <div class="Main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>

            <div class="col-4 text-center">

                <?php 
                $sql= "SELECT * FROM tbl_category";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                ?>
                <h1><?php echo $count ?></h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
            <?php 
                $sql2= "SELECT * FROM tbl_food";
                $result2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($result2);
                ?>
                <h1><?php echo $count2 ?></h1>
                <br />
                Foods
            </div>
            <div class="col-4 text-center">
            <?php 
                $sql3= "SELECT * FROM tbl_order";
                $result3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($result3);
                ?>
                <h1><?php echo $count3 ?></h1>
                <br />
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php
                $sql4 = "SELECT SUM(Total) AS Total FROM (
                    SELECT Total FROM tbl_order WHERE Status='Delivered'
                    UNION ALL
                    SELECT Total FROM tbl_orderhistory WHERE Status='Delivered'
                ) AS CombinedTables";

                $result4 = mysqli_query($conn, $sql4);

                if ($result4) {
                    $row4 = mysqli_fetch_assoc($result4);
                    $total_revenue = $row4["Total"];
                    echo "<h1>$total_revenue</h1>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
                <br />
                Revenue generated
            </div>


            <div class="clearfix"></div>
        </div>
        </div>
    <?php include('partials/footer.php') ?>