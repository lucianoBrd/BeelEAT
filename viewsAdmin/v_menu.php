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
      <li class="<?=$page == 'commande'|| $page == 'products'|| $page == 'productsE'|| $page == 'ingredient'|| $page == 'ingredientE' || $page == 'menuB' || $page == 'menuE'? 'active open' : '' ?>">
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
          <li class="<?=$page == 'commande' ? 'active' : '' ?>">
            <a href="?page=commande">
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
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
