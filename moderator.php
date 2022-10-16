<!-- Header -->
<?php include("common/header.php"); ?>
<!-- Header -->
<?php
if (isset($_POST['add_moderator'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $time = time();

    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, "upload/$file_name");

    $insert_moderator = mysqli_query($conn, "INSERT INTO admin_info(`name`, `email`, `pass`, `file`,`role`, `time`) VALUE('$name', '$email', '$pass', '$file_name','Moderator','$time')");
    if ($insert_moderator) {
        $msg = "Successfully created a new Moderator";
        header("location:moderator.php?msg=$msg");
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['moderator_id'];
    $moderator_name = $_POST['moderator_name'];

    $insert_brand = mysqli_query($conn, "UPDATE admin_info SET name ='$moderator_name' WHERE id=$id AND role='Moderator'");
    if ($insert_brand) {
        $msg = "Successfully updated moderator name";
        header("location:moderator.php?msg=$msg");
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
        <!-- Page Details Title -->

        <!-- Page Main Content -->
        <section class="page_main_content">
            <h4 class="text-xl font-medium">Moderator All</h4>
            <br>
            <div class="main_content_container">
                <!-- Table -->
                <div class="table_content_wrapper">
                    <header class="table_header">
                        <div class="table_header_left">
                            <button class="add_brand_btn  px-4 py-2 text-sm bg-blue-600 text-white rounded focus:ring">Add New
                                Moderator</button>
                        </div>

                        <form action="" method="POST">
                            <div class="table_header_right">
                                <input type="search" name="src_text" placeholder="Search All Order" />
                                <input style="cursor:pointer;" type="submit" name="search" class="btn" placeholder="Search" />
                            </div>
                        </form>
                    </header>

                    <div style="width: 100%; overflow:auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table_th">
                                        <div class="table_th_div"><span>Sl.</span></div>
                                    </th>
                                    <th class="table_th">
                                        <div class="table_th_div"><span>image</span></div>
                                    </th>
                                    <th class="table_th">
                                        <div class="table_th_div"><span>Name</span></div>
                                    </th>
                                    <th class="table_th">
                                        <div class="table_th_div"><span>Email</span></div>
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
                                    $sql = "SELECT * FROM admin_info WHERE (name = '$src_text' OR email = '$src_text') AND role='Moderator'";
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
                                                <div class="text-center"><img style="widht:50px;height:50px;border-radius:50px;margin:0 auto;" src="upload/<?php echo $row['file'] ?>" alt="Image"></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><?php echo $row['name'] ?></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><?php echo $row['email'] ?></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="w-full flex_center gap-1">
                                                    <a class="edit_brand_btn btn table_edit_btn">Edit</a>
                                                    <a class="btn table_edit_btn" href="delete.php?src=moderator&&id=<?php echo $row['id'] ?>">Delete</a>
                                                </div>
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
                                    $totalEmpSQL = "SELECT * FROM admin_info WHERE role='Moderator' ORDER BY id DESC";
                                    $allEmpResult = mysqli_query($conn, $totalEmpSQL);
                                    $totalEmployee = mysqli_num_rows($allEmpResult);
                                    $lastPage = ceil($totalEmployee / $showRecordPerPage);
                                    $firstPage = 1;
                                    $nextPage = $currentPage + 1;
                                    $previousPage = $currentPage - 1;

                                    $empSQL = "SELECT * FROM admin_info WHERE role='Moderator' ORDER BY id DESC LIMIT $startFrom, $showRecordPerPage";
                                    $query = mysqli_query($conn, $empSQL);
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $i++; ?>
                                        <tr>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><?php echo $i ?></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><img style="widht:50px;height:50px;border-radius:50px;margin:0 auto;" src="upload/<?php echo $row['file'] ?>" alt="Image"></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><?php echo $row['name'] ?></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="text-center"><?php echo $row['email'] ?></div>
                                            </td>
                                            <td class="p-3 border whitespace-nowrap">
                                                <div class="w-full flex_center gap-1">
                                                    <a data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" class="edit_brand_btn btn table_edit_btn edit_moderator_btn">Edit</a>
                                                    <a class="btn table_edit_btn" href="delete.php?src=moderator&&id=<?php echo $row['id'] ?>">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                            </tbody>
                        </table>
                    </div>
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
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="add_category_wrapper add_brand" style="display: none;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Moderator
                        </h1>

                        <div class="p-3 space-y-2">
                            <label for="name">Name</label>
                            <input required name="name" type="text" class="input">
                        </div>

                        <div class="p-3 space-y-2">
                            <label for="email">Email</label>
                            <input required name="email" type="email" class="input">
                        </div>

                        <div class="p-3 space-y-2">
                            <label for="pass">Password</label>
                            <input required name="pass" type="password" class="input">
                        </div>

                        <div class="p-3 space-y-2">
                            <label for="file">image</label>
                            <input name="file" type="file" class="input">
                        </div>

                        <div class="p-3 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="add_moderator">Create Moderator</button>
                            <button class="btn w-fit p-2 bg-red-400 text-white rounded focus:ring-2 hide_add_new_cat">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- -------------Edit brand---------------- -->
            <form action="" method="POST">
                <div class="add_category_wrapper edit_moderator" style="display: none;">
                    <div class="hide_add_new_cat fixed inset-0 w-full h-screen bg-black bg-opacity-50 z-40"></div>
                    <div class="fixed w-[96%] md:w-[500px] inset-0 m-auto bg-white rounded shadow z-50 h-fit">
                        <h1 class="p-4 border-b">
                            Edit Moderator
                        </h1>

                        <div class="p-4 space-y-2">
                            <label for="up_brand">Moderator Name</label>
                            <input name="moderator_name" id="moderator_name" type="text" class="input">
                            <input name="moderator_id" id="moderator_id" type="hidden" class="input">
                        </div>

                        <div class="p-4 flex items-center justify-end gap-x-3 border-t mt-4">
                            <button class="btn w-fit p-2 bg-blue-600 text-white rounded focus:ring-2" type="submit" name="update">Update Moderator</button>
                            <button style="background:#F87171;color:#fff;" type="button" class="btn w-fit p-2 bg-red-400 rounded focus:ring-2 hide_add_new_cat">Cancel</button>
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
    let edit_brand_btn = document.querySelector(".edit_brand_btn");
    let edit_brand = document.querySelector(".edit_brand");

    add_brand_btn.addEventListener("click", () => {
        add_brand.style.display = "block";
    });


    const moderator_name = document.getElementById("moderator_name");
    const moderator_id = document.getElementById("moderator_id");

    const all_edit_moderator_btn = document.querySelectorAll('.edit_moderator_btn')
    const all_edit_moderator = document.querySelector('.edit_moderator')

    all_edit_moderator_btn.forEach((btn) => {
        btn.addEventListener('click', function() {
            moderator_name.value = this?.dataset?.name
            moderator_id.value = this?.dataset?.id
            all_edit_moderator.style.display = 'block'
        })
    })
</script>

<!-- Side Navbar Links -->
<?php include("common/footer.php"); ?>
<!-- Side Navbar Links -->
<!-- <?php if (isset($_GET['msg'])) { ?><script>swal("Good job!", "<?php echo $_GET['msg']; ?>", "success");</script><?php } ?> -->
<?php if (isset($_GET['msg'])) { ?><div id="munna" data-text="<?php echo $_GET['msg']; ?>"></div><?php } ?>