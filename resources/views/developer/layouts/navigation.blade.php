{{--@if (Auth::guard('developer')->check())--}}
{{--    <form method="POST" action="{{ route('developer.logout') }}">--}}
{{--        @csrf--}}

{{--        <x-dropdown-link :href="route('developer.logout')"--}}
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
        <a class="navbar-brand m-0 d-flex align-items-center" href="{{route('developer.dashboard')}}">
            <img src="{{auth()->guard('developer')->user()->image && file_exists(public_path('assets/images/developers/'.auth()->guard('developer')->user()->image)) ? asset('assets/images/developers/'.auth()->guard('developer')->user()->image) : asset('assets/img/team-1.jpg')}}"
                 alt="{{auth()->guard('developer')->user()->name}}" title="Dashboard"
                 style="width: 80px !important;height: 80px !important;max-height: 80px;border-radius:10px "
                 class="profile-image">
            <div class="ms-3" style="width:90px;">
                <span class="font-weight-bold">{{ auth()->guard('developer')->user()->name }}</span><br>
                <span class="text-muted"
                      style="text-wrap: auto;font-size: 9px;position: absolute;">{{ auth()->guard('developer')->user()->designation ?? 'Designation' }}</span>
                <!-- Add designation here -->
            </div>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/dashboard*') ? 'active' : '' }}"
                   href="{{route('developer.dashboard')}}">
                    <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/accounts*') ? 'active' : '' }}"
                   href="{{ route('developer.account.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Developers <span>({{App\Models\Developer::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/admin/accounts*') ? 'active' : '' }}"
                   href="{{ route('developer.admin.account.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admins <span>({{App\Models\Admin::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/employee*') ? 'active' : '' }}"
                   href="{{route('developer.employee.index')}}">
                    <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Employees <span>({{App\Models\User::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/brand*') ? 'active' : '' }}"
                   href="{{ route('developer.brand.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-globe"></i>
                    </div>
                    <span class="nav-link-text ms-1">Brands <span>({{App\Models\Brand::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/team*') ? 'active' : '' }}"
                   href="{{ route('developer.team.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teams <span>({{App\Models\Team::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/client*') ? 'active' : '' }}"
                   href="{{ route('developer.client.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Clients <span>({{App\Models\CustomerContact::count()}})</span></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/lead*') ? 'active' : '' }}"
                   href="{{ route('developer.lead.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Leads</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/lead-status*') ? 'active' : '' }}"
                   href="{{ route('developer.lead-status.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-pie-chart" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lead Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/invoice*') ? 'active' : '' }}"
                   href="{{ route('developer.invoice.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-inbox" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Invoices</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/payment*') ? 'active' : '' }}"
                   href="{{ route('developer.payment.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="far fa-credit-card" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('developer/payment-merchants*') ? 'active' : '' }}"
                   href="{{ route('developer.payment.merchant.index') }}">
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
                <a class="nav-link {{ request()->is('developer/profile*') ? 'active' : '' }}"
                   href="{{route('developer.profile.edit')}}">
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

