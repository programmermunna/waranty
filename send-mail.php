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
<main style="color:#000 !important;">
  <section style="background:#fff;">
   <div style="border:2px solid #dfdfdf;">
    <div>      
        <h2 style="background:#065CB6;color:#fff;padding:4% 2%;margin:0px;"><?php echo $setting['name'];?></h2>
      <div style="padding:2%">
            <div>
                <p ><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                <p ><b>Status:</b> <span ><?php echo $option;?></span></p>
            </div>

            <div style="overflow:auto;">
                <div style="color:#065CB6;padding:20px 0;font-size:25px;font-weight:700">Billing address</div>
                <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                    <p><?php echo $customer['name'];?></p>
                    <p><?php echo $customer['email'];?></p>
                    <p><?php echo $customer['phone'];?></p>
                    <p><?php echo $customer['address'];?></p>
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
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount'];?></b></td>  
                            </tr>
                            <tr style="border:2px solid #dfdfdf;">
                                <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['due_amount'];?></b></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="font-size:80%;overflow:auto">
             <div style="float:left">
                <div>Congratulations on the sale.</div>
                <div>Copyright&copy; <?php echo $setting['name'];?></div>
             </div>
             <div style="float:right;">
                <div><?php echo $setting['phone'];?></div>
                <div><?php echo $setting['email'];?></div>
            </div>
        </div>

      </div>
    </div>
  </section>
</main>
    <?php $my_var = ob_get_clean();

    $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
    
    $my_var;
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
    $subject = 'Your Order Has been Received';
    $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);

    if(!$send){
        $msg = 'Your Mail was sent successfully.';
        header("location:pending-delivery.php?msg=$msg");
    }
}elseif($option=='courier'){
    ob_start(); ?>
    <main style="color:#000 !important;">
      <section style="background:#fff;">
       <div style="border:2px solid #dfdfdf;">
        <div>      
            <h2 style="background:#065CB6;color:#fff;padding:4% 2%;margin:0px;"><?php echo $setting['name'];?></h2>
          <div style="padding:2%">
                <div>
                    <p ><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                    <p ><b>Status:</b> <span ><?php echo $option;?></span></p>
                </div>
    
                <div style="overflow:auto;">
                    <div style="color:#065CB6;padding:20px 0;font-size:25px;font-weight:700">Billing address</div>
                    <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                        <p><?php echo $customer['name'];?></p>
                        <p><?php echo $customer['email'];?></p>
                        <p><?php echo $customer['phone'];?></p>
                        <p><?php echo $customer['address'];?></p>
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
                                    <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                                </tr>
                                <tr style="border:2px solid #dfdfdf;">
                                    <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                    <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount'];?></b></td>  
                                </tr>
                                <tr style="border:2px solid #dfdfdf;">
                                    <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                    <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['due_amount'];?></b></td>  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <div style="font-size:80%;overflow:auto">
                 <div style="float:left">
                    <div>Congratulations on the sale.</div>
                    <div>Copyright&copy; <?php echo $setting['name'];?></div>
                 </div>
                 <div style="float:right;">
                    <div><?php echo $setting['phone'];?></div>
                    <div><?php echo $setting['email'];?></div>
                </div>
            </div>
    
          </div>
        </div>
      </section>
    </main>
        <?php $my_var = ob_get_clean();
    
        $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
    
        $my_var;
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
        $subject = 'Your product has been sent at courier';
        $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
    
        if(!$send){
            $msg = 'Your Mail was sent successfully.';
            header("location:pending-delivery.php?msg=$msg");
        }
    }elseif($option=='delivery'){
        ob_start(); ?>
        <main style="color:#000 !important;">
          <section style="background:#fff;">
           <div style="border:2px solid #dfdfdf;">
            <div>      
                <h2 style="background:#065CB6;color:#fff;padding:4% 2%;margin:0px;"><?php echo $setting['name'];?></h2>
              <div style="padding:2%">
                    <div>
                        <p ><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                        <p ><b>Status:</b> <span ><?php echo $option;?></span></p>
                    </div>
        
                    <div style="overflow:auto;">
                        <div style="color:#065CB6;padding:20px 0;font-size:25px;font-weight:700">Billing address</div>
                        <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                            <p><?php echo $customer['name'];?></p>
                            <p><?php echo $customer['email'];?></p>
                            <p><?php echo $customer['phone'];?></p>
                            <p><?php echo $customer['address'];?></p>
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
                                        <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                                    </tr>
                                    <tr style="border:2px solid #dfdfdf;">
                                        <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                        <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount'];?></b></td>  
                                    </tr>
                                    <tr style="border:2px solid #dfdfdf;">
                                        <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                        <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['due_amount'];?></b></td>  
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div style="font-size:80%;overflow:auto">
                     <div style="float:left">
                        <div>Congratulations on the sale.</div>
                        <div>Copyright&copy; <?php echo $setting['name'];?></div>
                     </div>
                     <div style="float:right;">
                        <div><?php echo $setting['phone'];?></div>
                        <div><?php echo $setting['email'];?></div>
                    </div>
                </div>
        
              </div>
            </div>
          </section>
        </main>
            <?php $my_var = ob_get_clean();
        
            $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
        
            $my_var;
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
            $subject = 'Confirmation your order';
            $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
        
            if(!$send){
                $msg = 'Delivery Day for your Product';
                header("location:pending-delivery.php?msg=$msg");
            }
        }elseif($option=='success'){
            ob_start(); ?>
            <main style="color:#000 !important;">
              <section style="background:#fff;">
               <div style="border:2px solid #dfdfdf;">
                <div>      
                    <h2 style="background:#065CB6;color:#fff;padding:4% 2%;margin:0px;"><?php echo $setting['name'];?></h2>
                  <div style="padding:2%">
                        <div>
                            <p ><b>Date:</b> <?php $time = time();echo date('d-m-y',$time);?></p>
                            <p ><b>Status:</b> <span ><?php echo $option;?></span></p>
                        </div>
            
                        <div style="overflow:auto;">
                            <div style="color:#065CB6;padding:20px 0;font-size:25px;font-weight:700">Billing address</div>
                            <div style="border:2px solid #E5E5E5;padding:3px 10px;">
                                <p><?php echo $customer['name'];?></p>
                                <p><?php echo $customer['email'];?></p>
                                <p><?php echo $customer['phone'];?></p>
                                <p><?php echo $customer['address'];?></p>
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
                                            <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount']+$orders['due_amount'];?></b></td>  
                                        </tr>
                                        <tr style="border:2px solid #dfdfdf;">
                                            <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Advance Fee</b></td>
                                            <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['advance_amount'];?></b></td>  
                                        </tr>
                                        <tr style="border:2px solid #dfdfdf;">
                                            <td style="border:1px solid #dfdfdf;padding:5px;" colspan="4"><b>Due</b></td>
                                            <td style="border:1px solid #dfdfdf;padding:5px;"><b><?php echo $orders['due_amount'];?></b></td>  
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        <div style="font-size:80%;overflow:auto">
                         <div style="float:left">
                            <div>Congratulations on the sale.</div>
                            <div>Copyright&copy; <?php echo $setting['name'];?></div>
                         </div>
                         <div style="float:right;">
                            <div><?php echo $setting['phone'];?></div>
                            <div><?php echo $setting['email'];?></div>
                        </div>
                    </div>
            
                  </div>
                </div>
              </section>
            </main>
                <?php $my_var = ob_get_clean();
            
                $query = mysqli_query($conn,"UPDATE orders SET status='$option' WHERE warranty_id='$id'");
            
                $my_var;
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
                $subject = 'Thank you for purchasing our products';
                $send = sendVarifyCode($smtp_host,$smtp_username,$smtp_password,$smtp_port,$smtp_secure,$site_email,$site_name,$address,$body,$subject);
            
                if(!$send){
                    $msg = 'Your Mail was sent successfully.';
                    header("location:pending-delivery.php?msg=$msg");
                }
            }

?>
<!-- ===============send mail from===================== -->

<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->