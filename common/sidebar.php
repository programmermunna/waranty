<nav id="side_nav" class="side_nav">
  <a href="index.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-solid fa-gauge"></i>
      </div>
      <span class="nav_text">Dashboard</span>
    </button>
  </a>

  <a href="pos-index.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-solid fa-layer-group"></i>
      </div>
      <span class="nav_text">Warranty POS</span>
    </button>
  </a>

  <a href="customer-all.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-solid fa-user-tie"></i>
      </div>
      <span class="nav_text">Customer</span>
    </button>
  </a>

  <a href="product-all.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-solid fa-cart-shopping"></i>
      </div>
      <span class="nav_text">Product</span>
    </button>
  </a>

  <a href="brand.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-brands fa-bandcamp"></i>
      </div>
      <span class="nav_text">Brand</span>
    </button>
  </a>

  <a href="category-all.php">
    <button class="btn nav_btn">
      <div class="sidebar_icon">
        <i class="fa-solid fa-cubes"></i>
      </div>
      <span class="nav_text">Category</span>
    </button>
  </a>

  <div class="relative">
    <button class="btn nav_btn nav_btn_toggler">
      <div class="sidebar_icon">
        <i class="fa-solid fa-receipt"></i>
      </div>
      <span class="nav_text">Warranty Status</span>
      <span class="nav_toggle_icon">+</span>
    </button>
    <div class="hidden hide_nav_items nav_items">
      <a href="pending-delivery.php">
        <button class="sub_link">Pending Status</button>
      </a>
      <a href="success-delivery.php">
        <button class="sub_link">Success Status</button>
      </a>
    </div>
  </div>

  <?php if ($admin_info['role'] == 'Moderator') { ?>
  <?php } else { ?>
    <div class="relative">
      <button class="btn nav_btn nav_btn_toggler">
        <div class="sidebar_icon">
          <i class="fa-solid fa-cog"></i>
        </div>
        <span class="nav_text">Setting</span>
        <span class="nav_toggle_icon">+</span>
      </button>
      <div class="hidden hide_nav_items nav_items">
        <a href="moderator.php">
          <button class="sub_link">Moderator</button>
        </a>
        <a href="mail-setting.php">
          <button class="sub_link">Mail Setting</button>
        </a>
      </div>
    </div>
  <?php } ?>


  <!-- Toggle Nav Text -->
  <div id="toggle_nav_text">
    <button class="btn">
      <span class="chevronleft_icon"></span>
    </button>
  </div>
</nav>