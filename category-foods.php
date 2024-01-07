<?php include("partials-front/menu.php"); ?>


    <?php 
        if(isset($_GET['Category_id']))
        {
            $category_id = $_GET['Category_id'];
            $sql = "SELECT Title FROM tbl_category WHERE ID=$category_id";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $category_title = $row["Title"];
        }
        else
        {
            header('location:' .SITEURL);
        }
    
    
    
    ?>

    
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                $sql2 ="SELECT * FROM tbl_food WHERE Category_id=$category_id";
                $result2 = mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($result2);
                $counter = 0; 

                if($count2>0)
                {
                    while($row2 = mysqli_fetch_assoc($result2))
                    {   
                        $id= $row2["ID"];
                        $title=$row2["Title"];
                        $price=$row2['Price'];
                        $description=$row2['Description'];
                        $image_name=$row2['Image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            ?>
                                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    
                                    ?>
                                   
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php

                         $counter++;
                         if ($counter % 2 == 0) {
                            echo '<div class="clearfix"></div>';
                        }

                    }
                }
                else
                {
                    echo "<div class='error'>Food not available</div> ";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php"); ?>