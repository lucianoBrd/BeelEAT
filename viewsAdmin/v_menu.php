<div class="page-sidebar-wrapper">
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar md-shadow-z-2-i  navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
      <li class="start <?=$page == 'accueil' ? 'active' : '' ?>">
        <a href="../">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        </a>
      </li>
      <li class="<?=$page == 'products'|| $page == 'productsE'|| $page == 'ingredient'|| $page == 'ingredientE' || $page == 'menuB' || $page == 'menuE'? 'active open' : '' ?>">
        <a href="javascript:;">
        <i class="icon-basket"></i>
        <span class="title">Commerce</span>
        <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="../">
            <i class="icon-home"></i>
            Dashboard</a>
          </li>
          <li>
            <a href="ecommerce_orders.php">
            <i class="icon-basket"></i>
            Commande</a>
          </li>
          <li class="<?=$page == 'menuB' || $page == 'menuE' ? 'active' : '' ?>">
            <a href="?page=menuB">
            <i class="icon-pencil"></i>
            Menu</a>
          </li>
          <li class="<?=$page == 'products' || $page == 'productsE' ? 'active' : '' ?>">
            <a href="?page=products">
            <i class="icon-handbag"></i>
            Produit</a>
          </li>
          <li class="<?=$page == 'ingredient' || $page == 'ingredientE' ? 'active' : '' ?>">
            <a href="?page=ingredient">
            <i class="icon-handbag"></i>
            Ingredient</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;">
        <i class="icon-settings"></i>
        <span class="title">Form Stuff</span>
        <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="form_controls_md.html">
            <span class="badge badge-roundless badge-danger">new</span>Material Design<br>
            Form Controls</a>
          </li>
          <li>
            <a href="form_controls.html">
            Bootstrap<br>
            Form Controls</a>
          </li>
          <li>
            <a href="form_layouts.html">
            Form Layouts</a>
          </li>
          <li>
            <a href="form_editable.html">
            <span class="badge badge-warning">new</span>Form X-editable</a>
          </li>
          <li>
            <a href="form_wizard.html">
            Form Wizard</a>
          </li>
          <li>
            <a href="form_validation.html">
            Form Validation</a>
          </li>
          <li>
            <a href="form_image_crop.html">
            <span class="badge badge-danger">new</span>Image Cropping</a>
          </li>
          <li>
            <a href="form_fileupload.html">
            Multiple File Upload</a>
          </li>
          <li>
            <a href="form_dropzone.html">
            Dropzone File Upload</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;">
        <i class="icon-user"></i>
        <span class="title">Login Options</span>
        <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
          <li>
            <a href="login.html">
            Login Form 1</a>
          </li>
          <li>
            <a href="login_2.html">
            Login Form 2</a>
          </li>
          <li>
            <a href="login_3.html">
            Login Form 3</a>
          </li>
          <li>
            <a href="login_soft.html">
            Login Form 4</a>
          </li>
          <li>
            <a href="extra_lock.html">
            Lock Screen 1</a>
          </li>
          <li>
            <a href="extra_lock2.html">
            Lock Screen 2</a>
          </li>
        </ul>
      </li>
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
