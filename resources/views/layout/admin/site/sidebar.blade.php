<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="app-brand demo">
        <a href="{{ route('staff.dashboard') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/logo.jpeg')}}" alt="Brand Logo" class="img-fluid" width="90px"
                height="90px">
            <span class="app-brand-text demo menu-text fw-bold">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('site.overview') ? 'active' : '' }}">
            <a href="{{ route('site.overview', $site->id) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        @if (auth()->user()->hasPermissionTo('view_supervisor'))
            <li class="menu-item {{ request()->routeIs('site.supervisors') ? 'active' : '' }}">
                <a href="{{ route('site.supervisors', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-crown"></i>
                    <div data-i18n="Supervisor’s">Supervisor’s</div>

                </a>
            </li>
        @endif
        @if (auth()->user()->hasPermissionTo('view_personnel_present'))
            <li class="menu-item {{ request()->routeIs('site.personnel') ? 'active' : '' }}">
                <a href="{{ route('site.personnel', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Personnel">Personnel</div>
                </a>
            </li>
        @endif
        @if (auth()->user()->hasPermissionTo('view_first_responder'))
            <li class="menu-item {{ request()->routeIs('site.first-responders') ? 'active' : '' }}">
                <a href="{{ route('site.first-responders', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="First Responder">First Responder</div>
                </a>
            </li>
        @endif
        <!-- Tasks -->
        @if (auth()->user()->hasPermissionTo('view_sor'))
            <li class="menu-item {{ request()->routeIs('site.sors') ? 'active' : '' }}">
                <a href="{{ route('site.sors', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-text-wrap-disabled"></i>
                    <div data-i18n="Safety Observation Records (SOR's)">Safety Observation Records (SOR's)</div>
                </a>
            </li>
        @endif
        <!-- Incidents -->
        @if (auth()->user()->hasPermissionTo('view_incident'))
            <li class="menu-item {{ request()->routeIs('site.incidents') ? 'active' : '' }}">
                <a href="{{ route('site.incidents', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
                    <div data-i18n="Incident Manager">Incident Manager</div>
                </a>
            </li>
        @endif
        <!-- Deviations -->
        @if (auth()->user()->hasPermissionTo('view_icas'))
            <li class="menu-item {{ request()->routeIs('site.icas') ? 'active' : '' }}">
                <a href="{{ route('site.icas', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                    <div data-i18n="Immediate Corrective Actions (ICA)">Immediate Corrective Actions (ICA)</div>
                </a>
            </li>
        @endif
        <!-- Permits -->
        <li class="menu-item {{ request()->routeIs('site.permits') ? 'active' : '' }}">
            <a href="{{ route('site.permits', $site->id) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-checklist"></i>
                <div data-i18n=" Permits Applicable"> Permits Applicable</div>
            </a>
        </li>
        @if (auth()->user()->hasPermissionTo('view_tasks'))
            <li class="menu-item {{ request()->routeIs('site.tasks') ? 'active' : '' }}">
                <a href="{{ route('site.tasks', $site->id) }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-list"></i>
                    <div data-i18n="Tasks">Tasks</div>
                </a>
            </li>
        @endif
        <li class="menu-item  {{ request()->routeIs('site.environment') ? 'active' : '' }}">
            <a href="{{ route('site.environment', $site->id) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-tree"></i>
                <div data-i18n="Environment Concerns">Environment Concerns</div>
            </a>
        </li>


        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 4px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </ul>
</aside>
