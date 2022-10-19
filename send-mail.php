<!-- Header -->
<?php include("common/header.php"); ?>
<!-- Header -->
<?php
  if(isset($_GET['id'])){
   $id = $_GET['id'];
   $option = $_GET['option'];
  } 
  
  $customer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE warranty_id='$id'")); 
  $orders = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id='$id'"));

if($option=='receive'){
ob_start(); ?>
<main style="color:#000 !important;line-height:15px;">
  <section style="background:#fff;">
   <div>
    <div style="padding:2%">      
        <div >
            <div style="width:100%;display:inline-block;">
                <div style="float:left;">
                    <h2 style="color:#065CB6;font-size:30px;font-weight:700;margin:0px;"><?php echo $invoice['name'];?></h2>
                    <p><?php echo $invoice['address'];?></p>
                    <p><?php echo $invoice['email'];?></p>
                </div>
                <div style="float:right;padding-top:30px;text-align:right">
                    <p><?php echo $invoice['phone'];?></p>
                    <p style="margin:0;"><?php echo $invoice['whatsapp'];?></p>
                </div>                
            </div>
            <div><hr></div>

            <div style="padding-top:20px;">
                <p><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p><b>Status:</b> <span ><?php echo $option;?></span></p>
            </div>

            <div>
                <div style="color:#065CB6;padding:20px 0;font-size:22px;font-weight:700">Invoice Bill</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><b>Name: </b> <?php echo $customer['name'];?></p>
                    <p><b>Email: </b> <?php echo $customer['email'];?></p>
                    <p><b>Phone: </b> <?php echo $customer['phone'];?></p>
                    <p><b>Address: </b> <?php echo $customer['address'];?></p>
                </div>
            </div>
            
            <div style="overflow:auto;">
                <div >
                    <table style="text-align:left;margin:30px auto;width:100%;border-collapse: collapse;">
                        <thead>                     
                            <tr style="border:2px solid #dfdfdf;font-size:15px;">
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Product Name
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Brand
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Category
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Receive Date
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Delivery Date
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['product_name'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['brand'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['category'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['receive_date'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['delivery_date'];?></td>
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Total Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['due_amount'];?></b></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <div style="width:100%;display:inline-block;">
            <div style="float:left;width:40%">
                <!-- <div><img style="width:115px;height:30px" src="upload/<?php //echo $invoice['signature'];?>" alt=""></span></div> -->
                <div><img style="width:115px;height:30px" id="sign" src="cid:signature.png" alt="signature"></span></div>
                <div>Signature</div>
            </div>
            <div style="float:right;width:60%;text-align:right;padding-top:20px;">
                <div>Congratulations on the warranty.</div>
                <div>Copyright&copy; <?php echo $invoice['website'];?> </div>
            </div>
        </div>

        
      </div>
    </div>
  </section>
</main>

    <?php $my_var = ob_get_clean();

    $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
    
    $my_var;
    $imag =

    $customer_email = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id=$id"));
    $email =  $customer_email['email'];

    $mail = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mail_setting WHERE id=1"));

    $smtp_host = $mail['smtp_host'];
    $smtp_username = $mail['smtp_user_name'];
    $smtp_password = $mail['smtp_user_pass'];
    $smtp_port = $mail['smtp_port'];
    $smtp_secure = $mail['smtp_security'];
    $site_email = $mail['site_email'];
    $site_name = $mail['site_replay_email'];
    $address = $email;
    $body = $my_var;
    $subject = 'Your warranty has been Received';
    $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);

    $msg = 'Your Mail was sent successfully.';
    header("location:pending-status.php?msg=$msg");

}elseif($option=='courier'){
    ob_start(); ?>
<main style="color:#000 !important;line-height:15px;">
  <section style="background:#fff;">
   <div>
    <div style="padding:2%">      
        <div >
            <div style="width:100%;display:inline-block;">
                <div style="float:left;">
                    <h2 style="color:#065CB6;font-size:30px;font-weight:700;margin:0px;"><?php echo $invoice['name'];?></h2>
                    <p><?php echo $invoice['address'];?></p>
                    <p><?php echo $invoice['email'];?></p>
                </div>
                <div style="float:right;padding-top:30px;text-align:right">
                    <p><?php echo $invoice['phone'];?></p>
                    <p style="margin:0;"><?php echo $invoice['whatsapp'];?></p>
                </div>                
            </div>
            <div><hr></div>

            <div style="padding-top:20px;">
                <p><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p><b>Status:</b> <span ><?php echo $option;?></span></p>
            </div>

            <div>
                <div style="color:#065CB6;padding:20px 0;font-size:22px;font-weight:700">Invoice Bill</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><b>Name: </b> <?php echo $customer['name'];?></p>
                    <p><b>Email: </b> <?php echo $customer['email'];?></p>
                    <p><b>Phone: </b> <?php echo $customer['phone'];?></p>
                    <p><b>Address: </b> <?php echo $customer['address'];?></p>
                </div>
            </div>
            
            <div style="overflow:auto;">
                <div >
                    <table style="text-align:left;margin:30px auto;width:100%;border-collapse: collapse;">
                        <thead>                     
                            <tr style="border:2px solid #dfdfdf;font-size:15px;">
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Product Name
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Brand
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Category
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Receive Date
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Delivery Date
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['product_name'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['brand'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['category'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['receive_date'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['delivery_date'];?></td>
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Total Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['due_amount'];?></b></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <div style="width:100%;display:inline-block;">
            <div style="float:left;width:40%">
                <!-- <div><img style="width:115px;height:30px" src="upload/<?php //echo $invoice['signature'];?>" alt=""></span></div> -->
                <div><img style="width:115px;height:30px" id="sign" src="cid:signature.png" alt="signature"></span></div>
                <div>Signature</div>
            </div>
            <div style="float:right;width:60%;text-align:right;padding-top:20px;">
                <div>Congratulations on the warranty.</div>
                <div>Copyright&copy; <?php echo $invoice['website'];?> </div>
            </div>
        </div>

        
      </div>
    </div>
  </section>
</main>
    
        <?php $my_var = ob_get_clean();
    
        $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
        
        $my_var;
        $imag =
    
        $customer_email = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id=$id"));
        $email =  $customer_email['email'];
    
        $mail = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mail_setting WHERE id=1"));
    
        $smtp_host = $mail['smtp_host'];
        $smtp_username = $mail['smtp_user_name'];
        $smtp_password = $mail['smtp_user_pass'];
        $smtp_port = $mail['smtp_port'];
        $smtp_secure = $mail['smtp_security'];
        $site_email = $mail['site_email'];
        $site_name = $mail['site_replay_email'];
        $address = $email;
        $body = $my_var;
        $subject = 'Your Product Has been Couriar';
        $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
    
        header("location:pending-status.php?msg=$msg");
        $msg = 'Your Mail was sent successfully.';

    }elseif($option=='delivery'){
        ob_start(); ?>
<main style="color:#000 !important;line-height:15px;">
  <section style="background:#fff;">
   <div>
    <div style="padding:2%">      
        <div >
            <div style="width:100%;display:inline-block;">
                <div style="float:left;">
                    <h2 style="color:#065CB6;font-size:30px;font-weight:700;margin:0px;"><?php echo $invoice['name'];?></h2>
                    <p><?php echo $invoice['address'];?></p>
                    <p><?php echo $invoice['email'];?></p>
                </div>
                <div style="float:right;padding-top:30px;text-align:right">
                    <p><?php echo $invoice['phone'];?></p>
                    <p style="margin:0;"><?php echo $invoice['whatsapp'];?></p>
                </div>                
            </div>
            <div><hr></div>

            <div style="padding-top:20px;">
                <p><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p><b>Status:</b> <span ><?php echo $option;?></span></p>
            </div>

            <div>
                <div style="color:#065CB6;padding:20px 0;font-size:22px;font-weight:700">Invoice Bill</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><b>Name: </b> <?php echo $customer['name'];?></p>
                    <p><b>Email: </b> <?php echo $customer['email'];?></p>
                    <p><b>Phone: </b> <?php echo $customer['phone'];?></p>
                    <p><b>Address: </b> <?php echo $customer['address'];?></p>
                </div>
            </div>
            
            <div style="overflow:auto;">
                <div >
                    <table style="text-align:left;margin:30px auto;width:100%;border-collapse: collapse;">
                        <thead>                     
                            <tr style="border:2px solid #dfdfdf;font-size:15px;">
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Product Name
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Brand
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Category
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Receive Date
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Delivery Date
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['product_name'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['brand'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['category'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['receive_date'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['delivery_date'];?></td>
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Total Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['due_amount'];?></b></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <div style="width:100%;display:inline-block;">
            <div style="float:left;width:40%">
                <!-- <div><img style="width:115px;height:30px" src="upload/<?php //echo $invoice['signature'];?>" alt=""></span></div> -->
                <div><img style="width:115px;height:30px" id="sign" src="cid:signature.png" alt="signature"></span></div>
                <div>Signature</div>
            </div>
            <div style="float:right;width:60%;text-align:right;padding-top:20px;">
                <div>Congratulations on the warranty.</div>
                <div>Copyright&copy; <?php echo $invoice['website'];?> </div>
            </div>
        </div>

        
      </div>
    </div>
  </section>
</main>
        
            <?php $my_var = ob_get_clean();
        
            $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
            
            $my_var;
            $imag =
        
            $customer_email = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id=$id"));
            $email =  $customer_email['email'];
        
            $mail = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mail_setting WHERE id=1"));
        
            $smtp_host = $mail['smtp_host'];
            $smtp_username = $mail['smtp_user_name'];
            $smtp_password = $mail['smtp_user_pass'];
            $smtp_port = $mail['smtp_port'];
            $smtp_secure = $mail['smtp_security'];
            $site_email = $mail['site_email'];
            $site_name = $mail['site_replay_email'];
            $address = $email;
            $body = $my_var;
            $subject = 'Today is delivery day for your product!';
            $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
        
            $msg = 'Your Mail was sent successfully.';
            header("location:pending-status.php?msg=$msg");

        }elseif($option=='success'){
            ob_start(); ?>
<main style="color:#000 !important;line-height:15px;">
  <section style="background:#fff;">
   <div>
    <div style="padding:2%">      
        <div >
            <div style="width:100%;display:inline-block;">
                <div style="float:left;">
                    <h2 style="color:#065CB6;font-size:30px;font-weight:700;margin:0px;"><?php echo $invoice['name'];?></h2>
                    <p><?php echo $invoice['address'];?></p>
                    <p><?php echo $invoice['email'];?></p>
                </div>
                <div style="float:right;padding-top:30px;text-align:right">
                    <p><?php echo $invoice['phone'];?></p>
                    <p style="margin:0;"><?php echo $invoice['whatsapp'];?></p>
                </div>                
            </div>
            <div><hr></div>

            <div style="padding-top:20px;">
                <p><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p><b>Status:</b> <span ><?php echo $option;?></span></p>
            </div>

            <div>
                <div style="color:#065CB6;padding:20px 0;font-size:22px;font-weight:700">Invoice Bill</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><b>Name: </b> <?php echo $customer['name'];?></p>
                    <p><b>Email: </b> <?php echo $customer['email'];?></p>
                    <p><b>Phone: </b> <?php echo $customer['phone'];?></p>
                    <p><b>Address: </b> <?php echo $customer['address'];?></p>
                </div>
            </div>
            
            <div style="overflow:auto;">
                <div >
                    <table style="text-align:left;margin:30px auto;width:100%;border-collapse: collapse;">
                        <thead>                     
                            <tr style="border:2px solid #dfdfdf;font-size:15px;">
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Product Name
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Brand
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Category
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Receive Date
                                </th>
                                <th style="border:1px solid #dfdfdf;padding:5px;">
                                    Delivery Date
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['product_name'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['brand'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['category'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['receive_date'];?></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><?php echo $orders['delivery_date'];?></td>
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Total Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b>৳ <?php echo $orders['due_amount'];?></b></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <div style="width:100%;display:inline-block;">
            <div style="float:left;width:40%">
                <!-- <div><img style="width:115px;height:30px" src="upload/<?php //echo $invoice['signature'];?>" alt=""></span></div> -->
                <div><img style="width:115px;height:30px" id="sign" src="cid:signature.png" alt="signature"></span></div>
                <div>Signature</div>
            </div>
            <div style="float:right;width:60%;text-align:right;padding-top:20px;">
                <div>Congratulations on the warranty.</div>
                <div>Copyright&copy; <?php echo $invoice['website'];?> </div>
            </div>
        </div>

        
      </div>
    </div>
  </section>
</main>
            
                <?php $my_var = ob_get_clean();
            
                $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
                
                $my_var;
                $imag =
            
                $customer_email = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders WHERE warranty_id=$id"));
                $email =  $customer_email['email'];
            
                $mail = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mail_setting WHERE id=1"));
            
                $smtp_host = $mail['smtp_host'];
                $smtp_username = $mail['smtp_user_name'];
                $smtp_password = $mail['smtp_user_pass'];
                $smtp_port = $mail['smtp_port'];
                $smtp_secure = $mail['smtp_security'];
                $site_email = $mail['site_email'];
                $site_name = $mail['site_replay_email'];
                $address = $email;
                $body = $my_var;
                $subject = 'Congratulations!. Your warranty successfull';
                $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
            
                $msg = 'Your Mail was sent successfully.';
                header("location:pending-status.php?msg=$msg");
            }

?>
<!-- ===============send mail from===================== -->

<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->