<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM product WHERE id='$id'"));
?>
<!-- Main Content -->
<main class="main_content">
    <!-- Side Navbar Links -->
    <?php include("common/sidebar.php");?>
    <!-- Side Navbar Links -->

    <!-- Page Content -->
    <section class="content_wrapper">
        <!-- Page Details Title -->

        <!-- Page Main Content -->
        <div class="add_page_main_content">
            <div class="add_page_title">
                <span>Product view</span>               

                <?php if($admin_info['role']=='Moderator'){ ?>
                <a onclick="alert('Moderator now allowed.')">
                  <span class=" edit_icon"></span>
                </a>
                <?php }else{ ?>
                <a href="product-edit.php?id=<?php echo $id;?>">
                   <span class=" edit_icon"></span>
                </a>
                <?php } ?>





            </div>
            <form id="view_product_form">

                <div>
                    <b>Product Name</b>
                    <p><?php echo $row['product_name']?></p>
                </div>
                
                <div>
                    <b>Brand Name</b>
                    <p><?php echo $row['brand']?></p>
                </div>
                
                <div>
                    <b>Category Name</b>
                    <p><?php echo $row['category']?></p>
                </div>
                
                <div>
                    <b>Receive Date</b>
                    <p><?php echo $row['receive_date']?></p>
                </div>
                
                <div>
                    <b>Delivery Date</b>
                    <p><?php echo $row['delivery_date']?></p>
                </div>
                
                <div class="note">
              <label>Note:</label>
              <textarea disabled class="note_textarea" value="<?php echo $row['note']?>" rows="5"><?php echo $row['note']?></textarea>
            </div>

            </form>
        </div>
    </section>
    <!-- Page Content -->
</main>
<!-- Side Navbar Links -->
<?php include("common/footer.php");?>
<!-- Side Navbar Links -->