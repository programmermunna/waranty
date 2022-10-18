<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM product WHERE id='$id'"));

if(isset($_POST['submit'])){
  $product_name = $_POST['product_name'];
  $brand = $_POST['brand'];
  $category = $_POST['category'];
  $receive_date = $_POST['receive_date'];
  $delivery_date = $_POST['delivery_date'];
  $note = $_POST['note'];
  

  $sql = "UPDATE product SET product_name='$product_name', brand='$brand', category='$category', receive_date='$receive_date', delivery_date='$delivery_date', note='$note' WHERE id='$id'";
  $query = mysqli_query($conn,$sql);
  if($query){
   $msg = "Successfully Updated Product!";
   header("location:product-edit.php?msg=$msg&&id=$id");
  }else{
   $msg = "Something is worng!";
  }
}
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
            <span>Product Information</span>
            <a href="product-view.php?id=<?php echo $id;?>">
              <span class="eye_icon"></span>
            </a>
          </div>
          <form id="edit_product_form" action="" method="POST" enctype="multipart/form-data">

             <div>
              <label>Product Name</label>
              <input type="text" value="<?php echo $row['product_name']?>" name="product_name" class="input" />
            </div>
            
             <div>
              <label> Brand</label>
              <input type="text" value="<?php echo $row['brand']?>" name="brand" class="input" />
            </div>
            
             <div>
              <label>Category</label>
              <input type="text" value="<?php echo $row['category']?>" name="category" class="input" />
            </div>
            
             <div>
              <label>	Receive Date</label>
              <input type="text" value="<?php echo $row['receive_date']?>" name="receive_date" class="input" />
            </div>
            
             <div>
              <label>Delivery Date</label>
              <input type="text" value="<?php echo $row['delivery_date']?>" name="delivery_date" class="input" />
            </div>
            
            <div class="note">
              <label>Note:</label>
              <textarea class="note_textarea" value="<?php echo $row['note']?>" name="note" id="" rows="5"><?php echo $row['note']?></textarea>
            </div>

            <input style="cursor:pointer" class="btn submit_btn" name="submit" type="submit" value="Update" />
          </form>
        </div>
      </section>
      <!-- Page Content -->
    </main>
<!-- Side Navbar Links -->
<?php include("common/footer.php");?>
<!-- Side Navbar Links -->
<!-- <?php if(isset($_GET['msg'])){ ?><script>swal("Good job!", "<?php echo $_GET['msg'];?>", "success");</script><?php }?> -->
<?php if (isset($_GET['msg'])) { ?><div id="munna" data-text="<?php echo $_GET['msg']; ?>"></div><?php } ?>

