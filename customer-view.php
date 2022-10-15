<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE id='$id'"));
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
                <span>Customer view</span>

                <?php if($admin_info['role']=='Moderator'){ ?>
                <a onclick="alert('Moderator now allowed.')">
                  <span class=" edit_icon"></span>
                </a>
                <?php }else{ ?>
                <a href="customer-edit.php?id=<?php echo $id;?>">
                   <span class=" edit_icon"></span>
                </a>
                <?php } ?>


            </div>
            <form id="view_customer_form">
                <div>
                    <b>Name</b>
                    <p><?php echo $row['name']?></p>
                </div>
                <div>
                    <b>Phone</b>
                    <p><?php echo $row['phone']?></p>
                </div>
                <div>
                    <b>Email</b>
                    <p><?php echo $row['email']?></p>
                </div>
                <div>
                    <b>City</b>
                    <p><?php echo $row['city']?></p>
                </div>
                <div>
                    <b>Address</b>
                    <p><?php echo $row['address']?></p>
                </div>
            </form>
        </div>


    </section>
    <!-- Page Content -->
</main>
<!-- Side Navbar Links -->
<?php include("common/footer.php");?>
<!-- Side Navbar Links -->