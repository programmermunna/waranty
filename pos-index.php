<!-- Header -->
<?php include("common/header.php"); ?>
<!-- Header -->

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE warranty_id = $id"));
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE warranty_id = $id"));
    $orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE warranty_id = $id"));


    $brand = mysqli_query($conn, "SELECT * FROM brand");

    if (isset($_POST['submit'])) {

        $time = time();

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $address = $_POST['address'];

        $product_name = $_POST['product_name'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $receive_date = $_POST['receive_date'];
        $delivery_date = $_POST['delivery_date'];
        $note = $_POST['note'];

        $warranty_fee = $_POST['warranty_fee'];
        $delivery_fee = $_POST['delivery_fee'];
        $advance_amount = $_POST['advanced_amount'];
        $due_amount = $_POST['due_amount'];
        $status = $_POST['status'];

        $cusomer_update = mysqli_query($conn, "UPDATE customer SET name='$name', phone='$phone', email='$email', city='$city', address='$address' WHERE warranty_id='$id'");

        $product_update = mysqli_query($conn, "UPDATE product SET product_name='$product_name', brand='$brand', category='$category', receive_date='$receive_date', delivery_date='$delivery_date', note='$note' WHERE warranty_id='$id'");

        $order_update = mysqli_query($conn, "UPDATE orders SET name='$name', phone='$phone', email='$email', product_name='$product_name', brand='$brand', category='$category', warranty_fee='$warranty_fee', delivery_fee='$delivery_fee', advance_amount='$advance_amount', due_amount='$due_amount', status='$status' WHERE warranty_id='$id'");

        $msg = "Order has update successfully!";
        header("location:pending-delivery.php?msg=$msg");
    }


?>
    <main class="main_content">

        <!-- Side Navbar Links -->
        <?php include("common/sidebar.php"); ?>
        <!-- Side Navbar Links -->

        <!-- Page Content -->
        <section class="content_wrapper">
            <!-- <h4 class="text-xl font-medium">Warranty POS</h4><br> -->
            <div class="w-full">
                <form action="" method="POST">
                    <div class="warranty_content">
                        <!--  User field -->
                        <div style="margin-right:30px;" class="add_page_main_content">
                            <div class="py-5">
                                <label>Full Name</label>
                                <input required type="text" name="name" placeholder="Full name" class="input required" value="<?php echo $orders['name'] ?>" />
                            </div>
                            <div class="py-5">
                                <label>Phone</label>
                                <input required type="text" name="phone" placeholder="Phone" class="input required" value="<?php echo $orders['phone'] ?>" />
                            </div>
                            <div class="py-5">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Email" class="input required" value="<?php echo $orders['email'] ?>" />
                            </div>
                            <div class="py-5">
                                <label>City</label>
                                <input type="text" name="city" placeholder="City" class="input required" value="<?php echo $customer['city'] ?>" />
                            </div>
                            <div class="py-5">
                                <label>Address</label>
                                <input required type="text" name="address" placeholder="Address" class="input required" value="<?php echo $customer['address'] ?>" />
                            </div>
                        </div>
                        <!-- =======================part==================== -->
                        <div class="add_page_main_content">
                            <div>
                                <div class="py-5">
                                    <label>Product Name</label>
                                    <input required type="text" name="product_name" placeholder="Produc Name" class="input required" value="<?php echo $orders['product_name'] ?>" />
                                </div>
                                <div class="py-5">
                                    <label>Brand</label>

                                    <div style="display: flex;">
                                        <select class="input" name="brand" id="">
                                            <option selected><?php echo $orders['brand'] ?></option>
                                            <?php while ($row = mysqli_fetch_assoc($brand)) { ?>
                                                <option value="<?php echo $row['name'] ?>">
                                                    <?php echo $row['name'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <button type="button" style="width:40px; height:40px;" class="brand_category_plus add_brand_btn">+</button>
                                    </div>

                                </div>

                                <div style="position: relative;" class="py-5">
                                    <label>Category</label>

                                    <div style="display: flex;">
                                        <input required id="parent_cat" name="category" placeholder="Select Category" type="search" class="input" value="<?php echo $orders['category'] ?>">
                                        <button type="button" class="brand_category_plus add_category_btn">+</button>
                                    </div>

                                    <div class="relative categories_ul_ref_parent" style="display: none;position: absolute;width:100%; overflow:hidden; max-width: 100%;background: white;z-index: 999 !important; overflow:auto;">
                                        <ul class="categories_ul_ref ring-2 mt-2 ring-gray-100 rounded"></ul>
                                        <button type="button" class="hide_categories_ul_ref_parent absolute right-2 top-2 text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">hide</button>
                                    </div>
                                </div>

                                <div class="note">
                                    <label>Problem:</label>
                                    <textarea class="note_textarea" name="note" id="" rows="5"><?php echo $product['note']; ?></textarea>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- --------------------------- -->

                    <div class="amount_box">
                        <div class="w-full mx-auto bg-white shadow-lg rounded-md border overflow-hidden border-gray-200">
                            <div class="bg-white">
                                <div class="p-5 flex flex-col items-left gap-3">

                                    <div class="pos_input_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Receive Date</b>
                                                <input required name="receive_date" type="date" class="input" value="<?php echo $orders['receive_date'] ?>">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Delivery Date</b>
                                                <input required name="delivery_date" type="date" class="input" value="<?php echo $orders['delivery_date'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pos_input_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Warranty Fee</b>
                                                <input name="warranty_fee" type="number" placeholder="Warranty Fee" class="input warranty_fee" value="<?php echo $orders['warranty_fee'] ?>">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Delivery Fee</b>
                                                <input name="delivery_fee" type="number" placeholder="Delivery Fee" class="input delivery_fee" value="<?php echo $orders['delivery_fee'] ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="pos_input_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Advanced Amount</b>
                                                <input required name="advanced_amount" type="number" placeholder="Advanced Amount" class="input advance_amount" value="<?php echo $orders['advance_amount'] ?>">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Due Amount</b>
                                                <input name="due_amount" type="number" placeholder="Due Amount" class="input due_amount" value="<?php echo $orders['due_amount'] ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <b>Status</b>
                                    <select name="status" class="input required">
                                            <?php echo "<option selected>" . $orders['status'] . "</option>" ?>
                                            <option value="receive">Receive</option>
                                            <option value="courier">Courier</option>
                                            <option value="delivery">Delivery</option>
                                            <option value="success">Success</option>
                                    </select>

                                    <input class="add_brand_btn btn bg-blue-500 active:bg-blue-700 hover:bg-blue-600 text-white p-2 rounded" type="submit" name="submit" value="Update Warranty">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
<!-- ============================end -->

            <!-- -------------add brand---------------- -->
            <?php
            if (isset($_POST['add_brand'])) {
                $add_brand = $_POST['add_brand_name'];

                $insert_brand = mysqli_query($conn, "INSERT INTO brand(name) VALUE('$add_brand')");
                if ($insert_brand) {
                    $msg = "Successfully created a new Brand";
                    header("location:pos-index.php?msg=$msg");
                }
            }
            ?>

            <form action="" method="POST">
                <div class="add_category_wrapper add_brand" style="display: none;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Add Brand
                        </h1>

                        <div class="p-4 space-y-2">
                            <label for="cat_name">Brand Name</label>
                            <input required name="add_brand_name" type="text" class="input">

                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_brand">Create Brand</button>
                            <button class="btn w-fit p-2 bg-red-400 text-white rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>


            <!-- -------------add category---------------- -->
            <form action="" method="POST">
                <div class="add_category_wrapper add_category" style="display: none; z-index:999; position:relative;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Add New Category
                        </h1>
                        <div class="p-4 relative">
                            <label for="parent_cat">Parent Category</label>
                            <input required id="parent_cat" placeholder="Select Category" type="search" class="input required mt-2">
                            <input name="parent_category" type="hidden" id="category-hidden-id">

                            <div class="relative categories_ul_ref_parent" style="display: none;">
                                <ul class="categories_ul_ref ring-2 mt-2 ring-gray-100 rounded"></ul>
                                <button class="hide_categories_ul_ref_parent absolute right-2 top-2 text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">hide</button>
                            </div>
                        </div>

                        <div class="p-4 space-y-2">
                            <label for="cat_name">Category Name</label>
                            <input required name="category" id="cat_name" placeholder="Select Category" type="text" class="input">
                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_category">Create</button>
                            <button type="button" class="btn w-fit p-2 bg-red-400 rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>


            </div>
        </section>
    </main>

    <!-- ============================= -->
    <!-- =============Break================ -->
    <!-- ============================= -->
<?php } else {
    $brand = mysqli_query($conn, "SELECT * FROM brand");

    if (isset($_POST['submit'])) {

        $time = time();
        $warranty_id = rand(1, 100000);

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $address = $_POST['address'];

        $product_name = $_POST['product_name'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $receive_date = $_POST['receive_date'];
        $delivery_date = $_POST['delivery_date'];
        $note = $_POST['note'];

        $warranty_fee = $_POST['warranty_fee'];
        $delivery_fee = $_POST['delivery_fee'];
        $advance_amount = $_POST['advanced_amount'];
        $due_amount = $_POST['due_amount'];
        $status = $_POST['status'];

        $cusomer_insert = mysqli_query($conn, "INSERT INTO customer(`name`, `email`, `phone`, `address`, `city`,`warranty_id`, `time`) VALUES('$name', '$email', '$phone', '$address', '$city','$warranty_id', '$time')");

        $product_insert = mysqli_query($conn, "INSERT INTO product(`product_name`, `brand`, `category`, `receive_date`, `delivery_date`, `note`,`warranty_id`, `time`) VALUES('$product_name', '$brand', '$category', '$receive_date', '$delivery_date', '$note','$warranty_id', '$time')");

        $order_insert_insert = mysqli_query($conn, "INSERT INTO orders( `name`, `phone`, `email`, `product_name`, `brand`, `category`, `receive_date`, `delivery_date`, `warranty_fee`, `delivery_fee`, `advance_amount`, `due_amount`, `status`, `warranty_id`, `time`) VALUES('$name', '$phone', '$email', '$product_name', '$brand', '$category', '$receive_date', '$delivery_date', '$warranty_fee', '$delivery_fee', '$advance_amount', '$due_amount', '$status','$warranty_id', '$time')");


        header("location:invoice.php?id=$warranty_id");
    }



?>

    <main class="main_content">

        <!-- Side Navbar Links -->
        <?php include("common/sidebar.php"); ?>
        <!-- Side Navbar Links -->

        <!-- Page Content -->
        <section class="content_wrapper">
            <!-- <h4 class="text-xl font-medium">Warranty POS</h4><br> -->
            <div class="w-full">
                <form action="" method="POST">
                    <div class="warranty_content">
                        <!--  User field -->
                        <div style="margin-right:30px;" class="add_page_main_content">
                            <div class="py-5">
                                <label>Full Name</label>
                                <input required type="text" name="name" placeholder="Full name" class="input required" />
                            </div>
                            <div class="py-5">
                                <label>Phone</label>
                                <input required type="text" name="phone" placeholder="Phone" class="input required" />
                            </div>
                            <div class="py-5">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Email" class="input required" />
                            </div>
                            <div class="py-5">
                                <label>City</label>
                                <input type="text" name="city" placeholder="City" class="input required" />
                            </div>
                            <div class="py-5">
                                <label>Address</label>
                                <input required type="text" name="address" placeholder="Address" class="input required" />
                            </div>
                        </div>
                        <!-- =======================part==================== -->
                        <div class="add_page_main_content">
                            <div>
                                <div class="py-5">
                                    <label>Product Name</label>
                                    <input required type="text" name="product_name" placeholder="Produc Name" class="input required" />
                                </div>
                                <div class="py-5">
                                    <label>Brand</label>

                                    <div style="display: flex;">
                                        <select class="input" name="brand" id="">
                                            <option style="display:none;" selected disabled>Selcect Brand Name</option>
                                            <?php while ($row = mysqli_fetch_assoc($brand)) { ?>
                                                <option value="<?php echo $row['name'] ?>">
                                                    <?php echo $row['name'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <button type="button" style="width:40px; height:40px;" class="brand_category_plus add_brand_btn">+</button>
                                    </div>

                                </div>

                                <div style="position: relative;" class="py-5">
                                    <label>Category</label>

                                    <div style="display: flex;">
                                        <input required id="parent_cat" placeholder="Select Category" type="search" class="input">
                                        <button type="button" class="brand_category_plus add_category_btn">+</button>
                                    </div>

                                    <div class="relative categories_ul_ref_parent" style="display: none;position: absolute;width:100%; overflow:hidden; max-width: 100%;background: white;z-index: 999 !important; overflow:auto;">
                                        <ul class="categories_ul_ref ring-2 mt-2 ring-gray-100 rounded"></ul>
                                        <button type="button" class="hide_categories_ul_ref_parent absolute right-2 top-2 text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">hide</button>
                                    </div>
                                </div>

                                <div class="note" class="py-5">
                                    <label>Problem:</label>
                                    <textarea class="note_textarea" name="note" id="" rows="5" placeholder="Write something about this product."></textarea>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- --------------------------- -->

                    <div class="amount_box">
                        <div class="w-full mx-auto bg-white shadow-lg rounded-md border overflow-hidden border-gray-200">
                            <div class="bg-white">
                                <div class="p-5 flex flex-col items-left gap-3">

                                    <div class="pos_input_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Receive Date</b>
                                                <input required name="receive_date" type="date" class="input">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Delivery Date</b>
                                                <input required name="delivery_date" type="date" class="input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pos_input required_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Warranty Fee</b>
                                                <input name="warranty_fee" type="number" placeholder="Warranty Fee" class="input warranty_fee">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Delivery Fee</b>
                                                <input name="delivery_fee" type="number" placeholder="Delivery Fee" class="input delivery_fee">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="pos_input_item">
                                        <div class="brand_categroy_content">
                                            <div class="brand_categroy_width">
                                                <b>Advanced Amount</b>
                                                <input required name="advanced_amount" type="number" placeholder="Advanced Amount" class="input advance_amount">
                                            </div>
                                            <div class="brand_categroy_width">
                                                <b>Due Amount</b>
                                                <input name="due_amount" type="number" placeholder="Due Amount" class="input due_amount">
                                            </div>
                                        </div>

                                    </div>

                                    <b>Status</b>
                                    <select name="status" class="input">
                                        <?php if ($orders['status'] != '') { ?>
                                            <?php echo "<option selected disabled>" . $orders['status'] . "</option>" ?>
                                        <?php  } else { ?>
                                            <option selected value="receive">Receive</option>
                                            <option value="courier">Qourier</option>
                                            <option value="delivery">Delivery</option>
                                            <option value="success">Success</option>
                                        <?php } ?>
                                    </select>

                                    <input class="add_brand_btn btn bg-blue-500 active:bg-blue-700 hover:bg-blue-600 text-white p-2 rounded" type="submit" name="submit" value="Create Warranty">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!-- -------------add brand---------------- -->
            <?php
            if (isset($_POST['add_brand'])) {
                $add_brand = $_POST['add_brand_name'];

                $insert_brand = mysqli_query($conn, "INSERT INTO brand(name) VALUE('$add_brand')");
                if ($insert_brand) {
                    $msg = "Successfully created a new Brand";
                    header("location:pos-index.php?msg=$msg");
                }
            }
            ?>

            <form action="" method="POST">
                <div class="add_category_wrapper add_brand" style="display: none;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Add Brand
                        </h1>

                        <div class="p-4 space-y-2">
                            <label for="cat_name">Brand Name</label>
                            <input required name="add_brand_name" type="text" class="input">

                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_brand">Create Brand</button>
                            <button class="btn w-fit p-2 bg-red-400 text-white rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>


            <!-- -------------add category---------------- -->
            <?php
            if (isset($_POST['add_category'])) {
                $parent_id = $_POST['parent_id'];
                $category = $_POST['category'];

                $insert_brand = mysqli_query($conn, "INSERT INTO category(`category`, `parent_id`) VALUE('$category', '$parent_id')");
                if ($insert_brand) {
                    $msg = "Successfully created a new Brand";
                    header("location:pos-index.php?msg=$msg");
                }
            }
            ?>

            <form action="" method="POST">
                <div class="add_category_wrapper add_category" style="display: none; z-index:999; position:relative;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Add New Category
                        </h1>
                        <div class="p-4 relative">
                            <label for="parent_cat">Parent Category</label>
                            <input required id="parent_cat" placeholder="Select Category" type="search" class="input required mt-2">
                            <input name="parent_id" type="hidden" id="category-hidden-id">

                            <div class="relative categories_ul_ref_parent" style="display: none;">
                                <ul class="categories_ul_ref ring-2 mt-2 ring-gray-100 rounded"></ul>
                                <button class="hide_categories_ul_ref_parent absolute right-2 top-2 text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded">hide</button>
                            </div>
                        </div>

                        <div class="p-4 space-y-2">
                            <label for="cat_name">Category Name</label>
                            <input required name="category" id="cat_name" placeholder="Select Category" type="text" class="input">
                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_category">Create</button>
                            <button style="background:#F87171;color:#fff;" type="button" class="btn w-fit p-2 bg-red-400 rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>


            </div>
        </section>
    </main>
<?php } ?>


    <script>
        let add_brand_btn = document.querySelector(".add_brand_btn");
        let add_brand = document.querySelector(".add_brand");

        add_brand_btn.addEventListener("click", () => {
            add_brand.style.display = "block";
        });

        let add_category_btn = document.querySelector(".add_category_btn");
        let add_category = document.querySelector(".add_category");

        add_category_btn.addEventListener("click", () => {
            add_category.style.display = "block";
        });

        //advance and due 
        let warranty_fee_input = document.querySelector(".warranty_fee");
        let delivery_fee_input = document.querySelector(".delivery_fee");
        let advance_amount_input = document.querySelector(".advance_amount");
        let due_amount_input = document.querySelector(".due_amount");

        let warranty_fee = 0;
        let delivery_fee = 0;
        let advance_amount = 0;

        warranty_fee_input.addEventListener('keyup', function() {
            warranty_fee = this.value
            calculate()
            calculate_due()
        })

        delivery_fee_input.addEventListener('keyup', function() {
            delivery_fee = this.value
            calculate()
            calculate_due()
        })

        advance_amount_input.addEventListener('keyup', function() {
            advance_amount = this.value
            calculate_due()
        })

        function calculate_due() {
            due_amount_input.value = (Number(warranty_fee) + Number(delivery_fee)) - Number(advance_amount_input.value)
        }

        function calculate() {
            if (warranty_fee ||
                delivery_fee) {
                advance_amount_input.value = (Number(warranty_fee) + Number(delivery_fee))
            } else {
                advance_amount_input.value = 0
            }
        }
    </script>



<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->
<!-- <?php if (isset($_GET['msg'])) { ?><script>swal("Good job!", "<?php echo $_GET['msg']; ?>", "success");</script><?php } ?> -->


<?php if (isset($_GET['msg'])) { ?><div id="munna" data-text="<?php echo $_GET['msg']; ?>"></div><?php } ?>
