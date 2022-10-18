<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<?php
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $whatsapp = $_POST['whatsapp'];
  $address = $_POST['address'];
  $website = $_POST['website'];

  $sql = "UPDATE invoice_setting SET name='$name',email='$email',phone='$phone',whatsapp='$whatsapp',address='$address',website='$website' WHERE id=1";
  $query = mysqli_query($conn,$sql);
  if($query){
   $msg = "Successfully Updated Setting!";
   header("location:invoice-setting.php?msg=$msg");
  }else{
   $msg = "Something is worng!";
  }
}


$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM invoice_setting WHERE id=1"));
?>
<!-- Main Content -->
<main class="main_content">
    <!-- Side Navbar Links -->
    <?php include("common/sidebar.php");?>
    <!-- Side Navbar Links -->

    <!-- Page Content -->
    <section class="content_wrapper">

        <!-- Page Main Content -->
        <div class="add_page_main_content">
            <h1 class="add_page_title">UPDATE Invoice INFORMATIONS</h1>
            <form id="setting_form" action="" method="POST">
                <div>
                    <label>Company Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']?>" class="input" />
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $row['email']?>" class="input" />
                </div>
                <div>
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?php echo $row['phone']?>" class="input" />
                </div>
                <div>
                    <label>What's app</label>
                    <input type="text" name="whatsapp" value="<?php echo $row['whatsapp']?>" class="input" />
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" name="address" value="<?php echo $row['address']?>" class="input" />
                </div>
                <div>
                    <label>website</label>
                    <input type="text" name="website" value="<?php echo $row['website']?>" class="input" />
                </div>
                <input style="cursor:pointer" class="btn submit_btn" name="submit" type="submit" value="Save" />
            </form>

            <?php 
            if(isset($_POST['signature_submit'])){
              $file_name = $_FILES['file']['name'];
              $file_tmp = $_FILES['file']['tmp_name'];
              move_uploaded_file($file_tmp, "upload/$file_name");

              $update = mysqli_query($conn,"UPDATE invoice_setting SET signature='$file_name' WHERE id = 1");
              if($update){
                $msg = "Signature Updated Successfully";
                header("location:invoice-setting.php?msg=$msg");
              }
            }
            $invoice_signature = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM invoice_setting WHERE id=1"));
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
            <div>
              <p style="text-align:center;">Required Signature Size: 200*60px</p>
              <img style="width:100%;height:200px;" src="upload/<?php echo $invoice_signature['signature']?>" alt="logo">
                <label>Signature</label>
                <input type="file" name="file" class="input" />
            </div>
            <input style="cursor:pointer" class="btn submit_btn" name="signature_submit" type="submit" value="Save" />
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