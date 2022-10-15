<!-- Header -->
<?php include("common/header.php"); ?>
<!-- Header -->
<?php

if (isset($_POST['add_brand'])) {
    $add_brand = $_POST['add_brand_name'];

    $insert_brand = mysqli_query($conn, "INSERT INTO brand(name) VALUE('$add_brand')");
    if ($insert_brand) {
        $msg = "Successfully created a new Brand";
        header("location:brand.php?msg=$msg");
    }
}

if (isset($_POST['update'])) {
    echo $id = $_POST['brand_id'];
    echo $up_brand = $_POST['up_brand']; 

    $update_brand = mysqli_query($conn, "UPDATE brand SET name='$up_brand' WHERE id=$id");
    if ($update_brand) {
        $msg = "Successfully Updated a new Brand";
        header("location:brand.php?msg=$msg");
    }
}

?>

<!-- Main Content -->
<main class="main_content">
    <!-- Side Navbar Links -->
    <?php include("common/sidebar.php"); ?>
    <!-- Side Navbar Links -->

    <!-- Page Content -->
    <section class="content_wrapper">
        <h4 class="text-xl font-medium">Brand All</h4>
        <br>
        <!-- Page Details Title -->

        <!-- Page Main Content -->
        <section class="page_main_content">
            <div class="main_content_container">
                <!-- Table -->
                <div class="table_content_wrapper">
                    <header class="table_header">
                        <div class="table_header_left">
                            <button class="add_brand_btn show_add_new_cat px-4 py-2 text-sm bg-blue-600 text-white rounded focus:ring">Add New
                                Brand</button>
                        </div>

                        <form action="" method="POST">
                            <div class="table_header_right">
                                <input type="search" name="src_text" placeholder="Search All Order" />
                                <input style="cursor:pointer;" type="submit" name="search" class="btn" placeholder="Search" />
                            </div>
                        </form>
                    </header>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table_th">
                                    <div class="table_th_div"><span>Sl.</span></div>
                                </th>
                                <th class="table_th">
                                    <div class="table_th_div"><span>Brand Name</span></div>
                                </th>
                                <th class="table_th">
                                    <div class="table_th_div"><span>Action</span></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="customers_wrapper" class="text-sm">
                            <?php
                            if (isset($_POST['search'])) {
                                $src_text = trim($_POST['src_text']);
                                $sql = "SELECT * FROM brand WHERE name = '$src_text'";
                                $search_query = mysqli_query($conn, $sql);
                            }
                            if (isset($search_query)) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($search_query)) {
                                    $i++;

                            ?>
                                    <tr>
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="text-center"><?php echo $i ?></div>
                                        </td>
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="text-center"><?php echo $row['name'] ?></div>
                                        </td>
                                        <td class="p-3 border whitespace-nowrap">
                                            <?php if ($admin_info['role'] == 'Moderator') { ?>
                                                <div class="w-full flex_center gap-1">
                                                    <a class="btn table_edit_btn">Edit</a>
                                                    <a class="btn table_edit_btn" onclick="alert('Moderator now allowed.')">Delete</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="w-full flex_center gap-1">
                                                    <a class="edit_brand_btn btn table_edit_btn">Edit</a>
                                                    <a class="btn table_edit_btn" href="delete.php?src=brand&&id=<?php echo $row['id'] ?>">Delete</a>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            } else {
                                // ------------                                
                                $showRecordPerPage = 8;
                                if (isset($_GET['page']) && !empty($_GET['page'])) {
                                    $currentPage = $_GET['page'];
                                } else {
                                    $currentPage = 1;
                                }
                                $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                                $totalEmpSQL = "SELECT * FROM brand ORDER BY id DESC";
                                $allEmpResult = mysqli_query($conn, $totalEmpSQL);
                                $totalEmployee = mysqli_num_rows($allEmpResult);
                                $lastPage = ceil($totalEmployee / $showRecordPerPage);
                                $firstPage = 1;
                                $nextPage = $currentPage + 1;
                                $previousPage = $currentPage - 1;

                                $empSQL = "SELECT * FROM brand ORDER BY id DESC LIMIT $startFrom, $showRecordPerPage";
                                $query = mysqli_query($conn, $empSQL);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $i++; ?>
                                    <tr>
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="text-center"><?php echo $i ?></div>
                                        </td>
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="text-center"><?php echo $row['name'] ?></div>
                                        </td>
                                        <td class="p-3 border whitespace-nowrap">
                                            <?php if ($admin_info['role'] == 'Moderator') { ?>
                                                <div class="w-full flex_center gap-1">
                                                    <a class="btn table_edit_btn">Edit</a>
                                                    <a class="btn table_edit_btn" onclick="alert('Moderator now allowed.')">Delete</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="w-full flex_center gap-1">
                                                    <a data-name="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" class="edit_brand_btn btn table_edit_btn">Edit</a>
                                                    <a class="btn table_edit_btn" href="delete.php?src=brand&&id=<?php echo $row['id'] ?>">Delete</a>
                                                </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php  } ?>
                    </table>
                    </table>
                    <!-- -------------pagination---------------- -->
                    <br>
                    <div class="w-full" style="display: flex; justify-content: space-between;">

                        <nav aria-label="Page navigation">
                            <ul class="pagination_buttons">

                                <?php if ($currentPage >= 2) { ?>
                                    <li class="pagination"><a class="page-link" href="?page=<?php echo $previousPage ?>">Previws</a>
                                    </li>
                                <?php } ?>
                                <?php if ($currentPage != $firstPage) { ?>
                                    <li class="pagination">
                                        <a class="page-link" href="?page=<?php echo $firstPage ?>">
                                            <span class="page-link" aria-hidden="true">1</span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <li class="pagination active"><a class="page-link active" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>

                                <?php if ($currentPage < $lastPage) { ?>
                                    <li class="pagination "><a class="page-link" href="?page=<?php echo $currentPage + 1 ?>"><?php echo $currentPage + 1 ?></a></li>
                                <?php } ?>

                                <?php if ($currentPage < $lastPage) { ?>
                                    <li class="pagination "><a class="page-link" href="?page=<?php echo $currentPage + 1 + 1 ?>"><?php echo $currentPage + 1 + 1 ?></a></li>
                                <?php } ?>

                                <?php if ($currentPage < $lastPage) { ?>
                                    <li class="pagination "><a class="page-link" href="?page=<?php echo $currentPage + 1 + 1 + 1 ?>"><?php echo $currentPage + 1 + 1 + 1 ?></a></li>
                                <?php } ?>

                                <?php if ($currentPage < $lastPage) { ?>
                                    <li class="pagination"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php //echo $nextPage  
                                                                                                                        ?>Next</a></li>
                                <?php } ?>

                                <li class="pagination">
                                    <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                        <span aria-hidden="true">Last</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="pagination_buttons">Page <?php echo $currentPage ?> of <?php echo $lastPage ?></div>
                    </div>
                <?php } ?>
                <!-- -------------pagination---------------- -->
                </div>
            </div>
            </div>

            <!-- -------------add brand---------------- -->
            <form action="" method="POST">
                <div class="add_category_wrapper add_brand" style="display: none;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Add Brand
                        </h1>

                        <div class="p-4 space-y-2">
                            <label for="cat_name">Brand Name</label>
                            <input name="add_brand_name" type="text" class="input">

                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_brand">Create Brand</button>
                            <button class="btn w-fit p-2 bg-red-400 text-white rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- -------------Edit brand---------------- -->
            <form action="" method="POST">
                <div class="add_category_wrapper edit_brand" style="display: none;">
                    <div class=" fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Edit Brand
                        </h1>

                        <div class="p-4 space-y-2">
                            <label for="up_brand">Brand Name</label>
                            <input name="up_brand" id="brand_name" type="text" class="input">
                            <input name="brand_id" id="brand_id" type="hidden">

                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="update">Update Brand</button>
                            <button type="button" class="btn w-fit p-2 bg-red-400 text-white rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>


            </div>
        </section>
    </section>
    <!-- Page Content -->
</main>

<script>
    let add_brand_btn = document.querySelector(".add_brand_btn");
    let add_brand = document.querySelector(".add_brand");
    let all_edit_brand_btn = document.querySelectorAll(".edit_brand_btn");
    let edit_brand = document.querySelector(".edit_brand");
    let hide_add_new_cat = document.querySelectorAll(".hide_add_new_cat");
    const brand_name_input = document.getElementById("brand_name")
    const brand_id_input = document.getElementById("brand_id")

    add_brand_btn.addEventListener("click", () => {
        add_brand.style.display = "block";
    });

    all_edit_brand_btn.forEach((btn) => {
        btn.addEventListener("click", function() {
            edit_brand.style.display = "block";
            console.log(btn?.dataset)
            brand_name_input.value = this.dataset?.name;
            brand_id_input.value = this.dataset?.id;
        });
       
    })

</script>

<!-- Side Navbar Links -->
<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->
<?php if (isset($_GET['msg'])) { ?><script>swal("Good job!", "<?php echo $_GET['msg']; ?>", "success");</script><?php } ?>