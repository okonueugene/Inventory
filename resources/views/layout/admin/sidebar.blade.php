<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
          <a href="{{ url('/admin/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>

        <!-- Assets -->
        <li class="menu-item {{ request()->segment(2) == 'assets' ? 'active' : '' }}">
          <a href="{{ url('/admin/assets') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
            <div data-i18n="Assets">Assets</div>
          </a>
        </li>
        <li class="menu-item {{ request()->segment(2) == 'employees' ? 'active' : '' }}">
          <a href="{{ url('/admin/employees') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="Employees">Employees</div>
          </a>
        </li>
        <li class="menu-item {{ request()->segment(2) == 'categories' ? 'active' : '' }}">
          <a href="{{ url('/admin/categories') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-list"></i>
            <div data-i18n="Categories">Categories</div>
          </a>
        </li>
        <!-- Audit -->
        <li class="menu-item {{ request()->segment(2) == 'audits' ? 'active' : '' }}">
          <a href="{{ url('/admin/audits') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-receipt"></i>
            <div data-i18n="Audits">Audits</div>
          </a>
        </li>
{{-- 
        <!-- Configuration -->
        <li class="menu-item {{ request()->segment(2) == 'config' ? 'active' : '' }}">
          <a href="{{ url('/admin/config') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-settings"></i>
            <div data-i18n="Configuration">Configuration</div>
          </a>
        </li> --}}

        <!-- User Management -->
        <li class="menu-item {{ request()->segment(2) == 'users' ? 'active' : '' }}">
          <a href="{{ url('/admin/users') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-user"></i>
            <div data-i18n="User Management">User Management</div>
          </a>
        </li>
      </ul>
    </div>
  </aside>