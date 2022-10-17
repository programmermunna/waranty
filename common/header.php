<?php include("include/functions.php");?>
<?php

if(isset($_SESSION['admin_id'])){
   $id = $_SESSION['admin_id'];  
}elseif(isset($_COOKIE['admin_id'])){
  $id = $_COOKIE['admin_id'];
}else{
  $id = 0;
}
if(isset($_SESSION['admin_id'])){
  $id = $_SESSION['admin_id'];
}
if($id<1){
  header('location:login.php');
}

$setting = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM setting"));
$admin_info = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin_info WHERE id='$id'"));
$invoice = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM invoice_setting WHERE id='$id'"));

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php echo $setting['name']?></title>
    <link rel="icon" type="image/x-icon" href="upload/<?php echo $setting['favicon']?>">
    
    <script src="https://kit.fontawesome.com/20877c2550.js" crossorigin="anonymous"></script>
    
    <link href="dist/css/category.css" rel="stylesheet" />
    <link href="dist/css/styles.css" rel="stylesheet" />
    <link href="dist/css/custom.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Header -->
    <header class="header">
    <div id="popup_message"></div>
      <div class="header_container">
        <div class="header_left">
          <!-- LOGO -->
          <div class="header_brand">
            <a href="index.php" class="go_home">
              <div>
                <?php if($setting['logo']!=""){ ?>                
                  <img style="width:200px;height:60px" src="upload/<?php echo $setting['logo'];?>" alt="">
                 <?php }else{ ?>                  
                  <span style="font-size:19px;color:#fff;"><?php echo $setting['name'];?></span>
               <?php  } ?>
              </div>
            </a>
          </div>

          <button onclick="toggle_nav()" class="menu_icon"></button>

          <!-- Header Search Form -->
        </div>

        <div class="header_right">
          <button onclick="toggle_full_screen()" class="expand_icon"></button>

          <!-- Header Profile Image -->
          <div class="profile_image_wrapper">
            <button id="header_profile_image">
              <img
                src="upload/<?php echo $admin_info['file']?>"
                alt=""
              />
            </button>

         
            <!-- Profile Options -->
            <div id="profile_options_overlay"></div>
            <div id="profile_options">

            <?php if($admin_info['role']=='Moderator'){ ?>          
          <?php }else{ ?>
            <a href="admin-setting.php">
              <p>
                <span class="user_icon"></span>
                <span>Admin</span>
              </p>
            </a>
              <a href="website-setting.php">
                <p>
                  <span class="setting_icon"></span>
                  <span>Setting</span>
                </p>
              </a>
            <?php } ?>


              <?php 
              if(isset($_POST['logout'])){

              setcookie('admin_id', $id , time() - 86000);
              if(isset($_SESSION['admin_id'])){
                  unset($_SESSION['admin_id']);
                  session_destroy();
                  header('location:login.php');
              }
              header('location:login.php');
              } 
              ?>   
              <form action="" method="POST">
              <p>
                <span style="cursor:pointer;" class="logout_icon"></span>
                <input style="cursor:pointer;" type="submit" name="logout" value="Logout">
              </p>
            </form>
            </div>
          </div>
        </div>
      </div>
    </header>