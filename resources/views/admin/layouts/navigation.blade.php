{{--@if (Auth::guard('admin')->check())--}}
{{--    <form method="POST" action="{{ route('admin.logout') }}">--}}
{{--        @csrf--}}

{{--        <x-dropdown-link :href="route('admin.logout')"--}}
{{--                         onclick="event.preventDefault();--}}
{{--                        this.closest('form').submit();">--}}
{{--            {{ __('Log Out') }}--}}
{{--        </x-dropdown-link>--}}
{{--    </form>--}}
{{--@else--}}
{{--    <form method="POST" action="{{ route('logout') }}">--}}
{{--        @csrf--}}

{{--        <x-dropdown-link :href="route('logout')"--}}
{{--                         onclick="event.preventDefault();--}}
{{--                        this.closest('form').submit();">--}}
{{--            {{ __('Log Out') }}--}}
{{--        </x-dropdown-link>--}}
{{--    </form>--}}
{{--@endif--}}

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center" href="{{route('admin.dashboard')}}">
            <img src="{{auth()->guard('admin')->user()->image && file_exists(public_path('assets/images/admins/'.auth()->guard('admin')->user()->image)) ? asset('assets/images/admins/'.auth()->guard('admin')->user()->image) : asset('assets/img/team-1.jpg')}}"
                alt="{{auth()->guard('admin')->user()->name}}" title="Dashboard" style="width: 80px !important;height: 80px !important;max-height: 80px;border-radius:10px "
                 class="profile-image">
            <div class="ms-3" style="width:90px;">
                <span class="font-weight-bold">{{ auth()->guard('admin')->user()->name }}</span><br>
                <span class="text-muted" style="text-wrap: auto;font-size: 9px;position: absolute;">{{ auth()->guard('admin')->user()->designation ?? 'Designation' }}</span> <!-- Add designation here -->
            </div>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/account*') ? 'active' : '' }}" href="{{route('admin.account.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admins</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/employee*') ? 'active' : '' }}" href="{{route('admin.employee.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/brand*') ? 'active' : '' }}" href="{{ route('admin.brand.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-globe"></i>
                    </div>
                    <span class="nav-link-text ms-1">Brands</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/team*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teams</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/client*') ? 'active' : '' }}" href="{{ route('admin.client.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/lead*') ? 'active' : '' }}" href="{{ route('admin.lead.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Leads</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/lead-status*') ? 'active' : '' }}" href="{{ route('admin.lead-status.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lead Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/invoice*') ? 'active' : '' }}" href="{{ route('admin.invoice.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-inbox" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Invoices</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/payment*') ? 'active' : '' }}" href="{{ route('admin.payment.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="far fa-credit-card" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/payment-merchants*') ? 'active' : '' }}" href="{{ route('admin.payment.merchant.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="far fa-credit-card" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payment Merchants</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="../pages/tables.html">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Tables</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="../pages/billing.html">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Billing</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="../pages/virtual-reality.html">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-app text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Virtual Reality</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="../pages/rtl.html">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">RTL</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/profile*') ? 'active' : '' }}" href="{{route('admin.profile.edit')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="{{ route('login') }}">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Sign In</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="../pages/sign-up.html">--}}
{{--                    <div--}}
{{--                        class="icon icon-shape icon-sm borer-radius-md text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="ni ni-collection text-dark text-sm opacity-10"></i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Sign Up</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
{{--    <div class="sidenav-footer mx-3 ">--}}
{{--        <div class="card card-plain shadow-none" id="sidenavCard">--}}
{{--            <img class="w-50 mx-auto" src="{{asset('assets/img/illustrations/icon-documentation.svg')}}"--}}
{{--                 alt="sidebar_illustration">--}}
{{--            <div class="card-body text-center p-3 w-100 pt-0">--}}
{{--                <div class="docs-info">--}}
{{--                    <h6 class="mb-0">Need help?</h6>--}}
{{--                    <p class="text-xs font-weight-bold mb-0">Please check our docs</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <a href="#" target="_blank"--}}
{{--           class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>--}}
{{--        <a class="btn btn-primary btn-sm mb-0 w-100"--}}
{{--           href="#" type="button">Upgrade to--}}
{{--            pro</a>--}}
{{--    </div>--}}
</aside>

