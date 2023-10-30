<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{Request::is('admin/dashboard')?'li-active':'';}}">
      <a class="nav-link" href="{{url('admin/dashboard')}}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <i class="mdi mdi-chart-pie menu-icon"></i>
        <span class="menu-title">Sales</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/category/create') || Request::is('admin/category') ?'li-active':'';}}">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/category/create') && !Request::is('admin/category') ?'li-active':'';}}"> <a class="nav-link" href="{{url('admin/category/create')}}">Add category</a></li>
          <li class="nav-item {{Request::is('admin/category') && !Request::is('admin/category/create') ? 'li-active' : ''}}"><a class="nav-link" href="{{url('admin/category')}}">View category</a></li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item {{Request::is('admin/product/create') || Request::is('admin/product') ?'li-active':'';}}">
      <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-cart-plus menu-icon"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/product/create') && !Request::is('admin/product') ?'li-active':'';}}"><a class="nav-link" href="{{url('admin/product/create')}}">Add Product</a></li>
          <li class="nav-item {{Request::is('admin/product') && !Request::is('admin/product/create') ? 'li-active' : ''}}"><a class="nav-link" href="{{url('admin/product')}}">View Product</a></li>
        </ul>
      </div>
    </li>


    <li class="nav-item {{Request::is('admin/orders')?'li-active':'';}}">
      <a class="nav-link" href="{{url('admin/orders')}}">
        <i class="mdi mdi-circle-outline menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>


    <li class="nav-item {{Request::is('admin/users')?'li-active':'';}}">
      <a class="nav-link" href="{{url('admin/users')}}">
        <i class="mdi mdi-account-multiple-plus menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="documentation/documentation.html">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Site Setting</span>
      </a>
    </li>

  </ul>
</nav>