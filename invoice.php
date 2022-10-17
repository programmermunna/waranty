<!-- Header -->
<?php include("common/header.php"); ?>
<!-- Header -->
<?php
  if(isset($_GET['id'])){
   $id = $_GET['id'];
  }

  $customer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE warranty_id='$id'")); 
  $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id='$id'"));
  
  if(isset($_POST['submit'])){   
    $option = $row['status'];
    header("location:send-mail.php?option=$option&&id=$id");
}

?>

<div style="display:block;">
<!-- Main Content -->
<main class="main_content">
  <!-- Side Navbar Links -->
  <?php include("common/sidebar.php"); ?>
  <!-- Side Navbar Links -->
  <!-- Page Content -->
  <section style="background:#fff;margin-top:2.6%;" class="content_wrapper">
   <div style="border:2px solid #dfdfdf;" class="w-full">
     <h3 style="width:100%;margin:0 auto;background:#065CB6;color:#fff;padding:20px;"><?php echo $invoice['name'];?></h3>
    <div class="invoice">      
      <div>
            <div style="padding:0 10px">
                <p ><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p ><b>Status:</b> <span ><?php echo $row['status'];?></span></p>
            </div>

            <div>
                <div style="color:#065CB6;padding:20px 0;font-size:25px;font-weight:700">Billing address</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><?php echo $customer['name'];?></p>
                    <p><?php echo $customer['email'];?></p>
                    <p><?php echo $customer['phone'];?></p>
                    <p><?php echo $customer['address'];?></p>
                </div>
            </div>
            
            <div >
                <div style="width: 100%; overflow:auto">
                    <table class="table" style="text-align:left;margin:30px auto;width:100%;border-collapse: collapse;">
                        <thead>                     
                            <tr style="border:2px solid #dfdfdf;font-size:15px;">
                                <th style="border:1px solid #dfdfdf;padding:10px">
                                    Product Name
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:10px">
                                    Brand
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:10px">
                                    Category
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:10px">
                                    Receive Date
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:10px">
                                    Delivery Date
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $row['product_name'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $row['brand'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $row['category'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $row['receive_date'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $row['delivery_date'];?></td>
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Total Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $row['advance_amount']+$row['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $row['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $row['due_amount'];?></b></td>  
                            </tr>                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-top:20px">Congratulations on the sale.<span style="float:right ;"><?php echo $invoice['phone'];?></span></div>
            <div style="margin-bottom:20px 0">Copyright&copy; <?php echo $invoice['website'];?> <span style="float:right ;"><?php echo $invoice['email'];?></span></div>

        </div>
    </div>
    </div>
    <form action="" method="POST">
    <div class="invoice_actions" style="text-align:center; padding-top:10px;">

<?php
if(isset($_GET['src'])){
    if($_GET['src']=='pending'){ ?>
       <a style="padding:10px 20px; background:#065CB6;color:#fff;border-radius:5px;margin:0 10px;" href="pending-delivery.php">Back</a>
 <?php  }elseif($_GET['src']=='success'){ ?>
      <a style="padding:10px 20px; background:#065CB6;color:#fff;border-radius:5px;margin:0 10px;" href="success-delivery.php">Back</a>
<?php }}else{?>
      <a  style="padding:10px 20px; background:#065CB6;color:#fff;border-radius:5px;margin:0 10px;" href="pos-index.php">Back</a>
<?php } ?>
      <button onclick='window.print()' style="padding:10px 20px; background:#065CB6;color:#fff;border-radius:5px;margin:0 10px;">Print</button>
      <button type="submit" name="submit" style="padding:10px 20px; background:#065CB6;color:#fff;border-radius:5px;margin:0 10px;">Send Mail</button>
    </div>
    </form>
  </section>

</main>
</div>


<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->
