<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link {{ !request()->is('admin/home*') ? 'collapsed' : '' }}" href="{{ route('admin.home', ['interval' => 'today']) }}">
          <div class="me-2">
              <i class="bi bi-grid"></i>
          </div>
          <div class="">
              <span>{{ trans('global.dashboard') }}</span>
          </div>
      </a>
    </li><!-- End Dashboard Nav -->

    @can('customer_access')
    <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin/customer*') ? 'collapsed' : '' }}" href="{{ route('admin.customer.index') }}">
            <div class="me-2">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.customer.title') }}</span>
            </div>
        </a>
    </li>
    @endcan

    @can('category_access')
    <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin/category*') ? 'collapsed' : '' }}" href="{{ route('admin.category.index') }}">
            <div class="me-2">
                <i class="bi bi-film"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.category.title') }}</span>
            </div>
        </a>
    </li>
    @endcan

    @can('book_access')
    <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin/book*') ? 'collapsed' : '' }}" href="{{ route('admin.book.index') }}">
            <div class="me-2">
                <i class="bi bi-book"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.book.title') }}</span>
            </div>
        </a>
    </li>
    @endcan

    @can('sale_access')
    <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin/sale*') ? 'collapsed' : '' }}" href="{{ route('admin.sale.index') }}">
            <div class="me-2">
                <i class="bi bi-cart-plus"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.sale.title') }}</span>
            </div>
        </a>
    </li>
    @endcan

    @can('report_access')
    <li class="nav-item">
        <a class="nav-link {{ !request()->is('admin/report*') ? 'collapsed' : '' }}" href="{{ route('admin.report.index') }}">
            <div class="me-2">
                <i class="fa fa-flag"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.report.title') }}</span>
            </div>
        </a>
    </li>
    @endcan

    @can('user_management_access')
    <li class="nav-item">
        <a class="nav-link collapsed " data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
            <div class="me-1">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="">
                <span>{{ trans('cruds.user_management.title') }}</span>
            </div>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav"
            class="nav-content collapse {{ request()->is('admin/user*') || request()->is('admin/role*') ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">
            @can('user_access')
                <li>
                    <a href="{{ route('admin.user.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.user.title') }}</span>
                    </a>
                </li>
            @endcan
            @can('role_access')
                <li>
                    <a href="{{ route('admin.role.index') }}">
                        <i class="bi bi-circle"></i><span>{{ trans('cruds.role.title') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
    @endcan
  <!-- End User Management Nav -->
  </ul>

</aside><!-- End Sidebar-->
