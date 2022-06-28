<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{route('home')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="/backend/assets/img/favicon/logo.png" style="border-radius:50%;" height="60px" width="60px" alt="">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Laptop New</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item @if (request()->routeIs('backend.dashboard.*')) active @endif">
      <a href="{{route('backend.dashboard.index')}}" class="menu-link">

        <div data-i18n="Analytics"> <i class='bx bxs-tachometer'> Trang chủ</i></div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Bài Viết &amp; Sản Phẩm</span>
    </li>
    <li class="menu-item @if (request()->routeIs('backend.categories.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Account Settings"> <i class='bx bx-category'> Danh Mục </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.categories.create')) active @endif">
          <a href="{{route('backend.categories.create')}}" class="menu-link">
            <div data-i18n="Account">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.categories.index')) active @endif">
          <a href="{{route('backend.categories.index')}}" class="menu-link">
            <div data-i18n="Notifications">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item @if (request()->routeIs('backend.products.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Misc"><i class='bx bx-laptop'> Sản Phẩm </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.products.create')) active @endif">
          <a href="{{route('backend.products.create')}}" class="menu-link">
            <div data-i18n="Error">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.products.index')) active @endif">
          <a href="{{route('backend.products.index')}}" class="menu-link">
            <div data-i18n="Under Maintenance">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- cart -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Giỏi Hàng</span></li>
    <li class="menu-item @if (request()->routeIs('backend.orders.*')) active @endif">
      <a href="#" class="menu-link menu-toggle">
        <div data-i18n="Form Elements"><i class='bx bx-cart'> Đơn hàng chờ sử lý </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.orders.index')) active @endif">
          <a href="{{route('backend.orders.index')}}" class="menu-link">
            <div data-i18n="Input groups">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Thành phần phụ</span></li>
    <!-- menu -->
    <li class="menu-item @if (request()->routeIs('backend.menus.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Account Settings"> <i class='bx bx-menu'> Tiêu đề </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.menus.create')) active @endif">
          <a href="{{route('backend.menus.create')}}" class="menu-link">
            <div data-i18n="Account">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.menus.index')) active @endif">
          <a href="{{route('backend.menus.index')}}" class="menu-link">
            <div data-i18n="Notifications">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- image -->
    <li class="menu-item @if (request()->routeIs('backend.images.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Account Settings"> <i class='bx bxs-image'> Hình ảnh </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.images.create')) active @endif">
          <a href="{{route('backend.images.create')}}" class="menu-link">
            <div data-i18n="Account">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.images.index')) active @endif">
          <a href="{{route('backend.images.index')}}" class="menu-link">
            <div data-i18n="Notifications">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Tài khoản</span></li>
    <!-- Forms -->

    <li class="menu-item @if (request()->routeIs('backend.admins.*')) active @endif">
      <a href="#" class="menu-link menu-toggle">
        <div data-i18n="Form Elements"><i class='bx bxs-id-card'> Tài khoản nhân viên </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.admins.create')) active @endif">
          <a href="{{route('backend.admins.create')}}" class="menu-link">
            <div data-i18n="Basic Inputs">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.admins.index')) active @endif">
          <a href="{{route('backend.admins.index')}}" class="menu-link">
            <div data-i18n="Input groups">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item @if (request()->routeIs('backend.users.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Form Elements"><i class='bx bxs-id-card'> Tài khoản Khách Hàng </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.users.create')) active @endif">
          <a href="{{route('backend.users.create')}}" class="menu-link">
            <div data-i18n="Basic Inputs">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.users.index')) active @endif">
          <a href="{{route('backend.users.index')}}" class="menu-link">
            <div data-i18n="Input groups">Danh sách khách hàng</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.users.delete')) active @endif">
          <a href="{{route('backend.users.delete')}}" class="menu-link">
            <div data-i18n="Input groups">Danh sách khách hàng tạm khóa</div>
          </a>
        </li>
      </ul>
    </li>
    <!-- role -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Vai trò & quyền sử dụng</span></li>

    <li class="menu-item @if (request()->routeIs('backend.roles.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Account Settings"> <i class='bx bxs-user-account'> Vai trò </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.roles.create')) active @endif">
          <a href="{{route('backend.roles.create')}}" class="menu-link">
            <div data-i18n="Account">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.roles.index')) active @endif">
          <a href="{{route('backend.roles.index')}}" class="menu-link">
            <div data-i18n="Notifications">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item @if (request()->routeIs('backend.permissions.*')) active @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <div data-i18n="Account Settings"> <i class='bx bx-shape-polygon'> Quyền sử dụng </i></div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if (request()->routeIs('backend.permissions.create')) active @endif">
          <a href="{{route('backend.permissions.create')}}" class="menu-link">
            <div data-i18n="Account">Thêm mới</div>
          </a>
        </li>
        <li class="menu-item @if (request()->routeIs('backend.permissions.index')) active @endif">
          <a href="{{route('backend.permissions.index')}}" class="menu-link">
            <div data-i18n="Notifications">Danh sách</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>