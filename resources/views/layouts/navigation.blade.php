<nav id="mainnav-container" class="mainnav">
    <div class="mainnav__inner">

        <!-- Navigation menu -->
        <div class="mainnav__top-content scrollable-content pb-5 pt-2">


            <!-- Profile Widget -->
            <div id="_dm-mainnavProfile" class="mainnav__widget my-3 hv-outline-parent d-none">

                <!-- Profile picture  -->
                <div class="mininav-toggle text-center py-2">
                    <img class="mainnav__avatar img-md rounded-circle hv-oc"
                         src="{{auth()->guard('web')->user()->image && file_exists(public_path('assets/images/employees/'.auth()->guard('web')->user()->image)) ? asset('assets/images/employees/'.auth()->guard('web')->user()->image) : asset('assets/themes/nifty/assets/img/profile-photos/2.png')}}"
                         alt="{{auth()->guard('web')->user()->name}}" title="Dashboard" loading="lazy">
                </div>
                <div class="mininav-content collapse d-mn-max">
                    <span data-popper-arrow class="arrow"></span>
                    <div class="d-grid">

                        <!-- User name and position -->
                        <button class="mainnav-widget-toggle d-block btn border-0 p-2" data-bs-toggle="collapse"
                                data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                           <span class="dropdown-toggle d-flex justify-content-center align-items-center">
                              <h5 class="mb-0 me-3">{{auth()->guard('web')->user()->name}}</h5>
                           </span>
                            <small class="text-body-secondary">{{auth()->guard('web')->user()->designation}}</small>
                        </button>


                        <!-- Collapsed user menu -->
                        <div id="usernav" class="nav flex-column collapse">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                                    <span><i class="demo-pli-mail fs-5 me-2"></i><span
                                            class="ms-1">Messages</span></span>
                                <span class="badge bg-danger rounded-pill">14</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-male fs-5 me-2"></i>
                                <span class="ms-1">Profile</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-gear fs-5 me-2"></i>
                                <span class="ms-1">Settings</span>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="demo-pli-computer-secure fs-5 me-2"></i>
                                <span class="ms-1">Lock screen</span>
                            </a>
                            <a class="nav-link" style="cursor: pointer;"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="demo-pli-unlock fs-5 me-2"></i>
                                <span class="ms-1">Logout</span>
                            </a>
                        </div>


                    </div>
                </div>

            </div>
            <!-- End - Profile widget -->


            <!-- Navigation Category Dashboard -->
            <div class="mainnav__categoriy pb-1 pt-3">
                {{--                    <h6 class="mainnav__caption mt-0 fw-bold">Navigation</h6>--}}
                <ul class="mainnav__menu nav flex-column">
                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">
                        <a href="{{route('dashboard')}}" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-home fs-5 me-2"></i>
                            <span class="nav-label ms-1">Dashboard</span>
                        </a>
                        <!-- Dashboard submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="{{route('dashboard')}}" class="nav-link">Dashboard 1</a>
                            </li>
                        </ul>
                        <!-- END : Dashboard submenu list -->
                    </li>
                    <!-- END : Link with submenu -->

                    {{--                        <!-- Link with submenu -->--}}
                    {{--                        <li class="nav-item has-sub">--}}
                    {{--                            <a href="#" class="mininav-toggle nav-link collapsed"><i--}}
                    {{--                                    class="demo-pli-split-vertical-2 fs-5 me-2"></i>--}}
                    {{--                                <span class="nav-label ms-1">Layouts</span>--}}
                    {{--                            </a>--}}
                    {{--                            <!-- Layouts submenu list -->--}}
                    {{--                            <ul class="mininav-content nav collapse">--}}
                    {{--                                <li data-popper-arrow class="arrow"></li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/minimal-navigation/index.html" class="nav-link">Mini--}}
                    {{--                                        Navigation</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/push-navigation/index.html" class="nav-link">Push Navigation</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/slide-navigation/index.html" class="nav-link">Slide--}}
                    {{--                                        Navigation</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/reveal-navigation/index.html" class="nav-link">Reveal--}}
                    {{--                                        Navigation</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/stuck-sidebar/index.html" class="nav-link">Stuck Sidebar</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/pinned-sidebar/index.html" class="nav-link">Pinned Sidebar</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/unite-sidebar/index.html" class="nav-link">Unite Sidebar</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/sticky-header/index.html" class="nav-link">Sticky Header</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../layouts/sticky-navigation/index.html" class="nav-link">Sticky--}}
                    {{--                                        Navigation</a>--}}
                    {{--                                </li>--}}

                    {{--                            </ul>--}}
                    {{--                            <!-- END : Layouts submenu list -->--}}

                    {{--                        </li>--}}
                    {{--                        <!-- END : Link with submenu -->--}}

                    {{--                        <!-- Regular menu link -->--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a href="{{asset('assets/themes/nifty/widgets/index.html')}}" class="nav-link mininav-toggle"><i--}}
                    {{--                                    class="demo-pli-gear fs-5 me-2"></i>--}}

                    {{--                                <span class="nav-label mininav-content ms-1">--}}
                    {{--                              <span data-popper-arrow class="arrow"></span>--}}
                    {{--                              Widgets--}}
                    {{--                           </span>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                        <!-- END : Regular menu link -->--}}


                </ul>
            </div>
            <!-- END : Navigation Category -->


            <!-- Components Category Crm-->
            <div class="mainnav__categoriy py-1">

                <h6 class="mainnav__caption mt-0 fw-bold">CRM</h6>
                <ul class="mainnav__menu nav flex-column">
                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">
                        <a href="#"
                           class="mininav-toggle nav-link collapsed {{ request()->is('companies*') ? 'active' : '' }}"><i
                                class="demo-pli-address-book fs-5 me-2"></i>
                            <span class="nav-label ms-1">Companies</span>
                        </a>
                        <!-- Ui Elements submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="{{route('company.index')}}"
                                   class="nav-link {{ request()->is('companies*') ? 'active' : '' }}">Lists</a>
                            </li>
                        </ul>
                        <!-- END : Ui Elements submenu list -->
                    </li>
                    <li class="nav-item has-sub">
                        <a href="#"
                           class="mininav-toggle nav-link collapsed {{ request()->is('contacts*') ? 'active' : '' }}"><i
                                class="demo-pli-address-book fs-5 me-2"></i>
                            <span class="nav-label ms-1">Contacts</span>
                        </a>
                        <!-- Ui Elements submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="{{route('contact.index')}}"
                                   class="nav-link {{ request()->is('contacts*') ? 'active' : '' }}">Lists</a>
                            </li>
                        </ul>
                        <!-- END : Ui Elements submenu list -->
                    </li>
                    <!-- END : Link with submenu -->
                </ul>
            </div>
            <!-- END : Components Category -->

            <!-- Components Category -->
            <div class="mainnav__categoriy py-1">
                <h6 class="mainnav__caption mt-0 fw-bold">Components</h6>
                <ul class="mainnav__menu nav flex-column">

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-boot-2 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Ui Elements</span>
                        </a>

                        <!-- Ui Elements submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../ui-elements/buttons/index.html" class="nav-link">Buttons</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/cards/index.html" class="nav-link">Cards</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/dropdowns/index.html" class="nav-link">Dropdowns</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/components/index.html" class="nav-link">Components</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/list-group/index.html" class="nav-link">List Group</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/typography/index.html" class="nav-link">Typography</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/modals/index.html" class="nav-link">Modals</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/progress/index.html" class="nav-link">Progress</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/placeholders/index.html"
                                   class="nav-link d-flex align-items-center">Placeholders<span
                                        class="badge bg-danger ms-auto">NEW</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/tabs-accordions/index.html" class="nav-link">Tabs &amp;
                                    Accordions</a>
                            </li>
                            <li class="nav-item">
                                <a href="../ui-elements/tooltips-popovers/index.html" class="nav-link">Tooltips
                                    &amp; Popover</a>
                            </li>

                        </ul>
                        <!-- END : Ui Elements submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-pen-5 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Forms</span>
                        </a>

                        <!-- Forms submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../forms/general/index.html" class="nav-link">General</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/tags/index.html" class="nav-link">Tags</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/date-time-picker/index.html" class="nav-link">Date Time Picker</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/validation/index.html" class="nav-link">Validation</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/wizard/index.html" class="nav-link">Wizard</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/file-uploads/index.html" class="nav-link">File Uploads</a>
                            </li>
                            <li class="nav-item">
                                <a href="../forms/text-editor/index.html" class="nav-link">Text Editor</a>
                            </li>

                        </ul>
                        <!-- END : Forms submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-receipt-4 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Tables</span>
                        </a>

                        <!-- Tables submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../tables/static-tables/index.html" class="nav-link">Static Tables</a>
                            </li>
                            <li class="nav-item">
                                <a href="../tables/gridjs/index.html" class="nav-link">Gridjs</a>
                            </li>
                            <li class="nav-item">
                                <a href="../tables/tabulator/index.html" class="nav-link">Tabulator</a>
                            </li>

                        </ul>
                        <!-- END : Tables submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-bar-chart fs-5 me-2"></i>
                            <span class="nav-label ms-1">Charts</span>
                        </a>

                        <!-- Charts submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../charts/chart.js/index.html" class="nav-link">ChartJS</a>
                            </li>
                            <li class="nav-item">
                                <a href="../charts/charts.css/index.html" class="nav-link">ChartsCSS</a>
                            </li>
                            <li class="nav-item">
                                <a href="../charts/sparklines/index.html" class="nav-link">Sparklines</a>
                            </li>

                        </ul>
                        <!-- END : Charts submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-repair fs-5 me-2"></i>
                            <span class="nav-label ms-1">Miscellaneous</span>
                        </a>

                        <!-- Miscellaneous submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../miscellaneous/timeline/index.html" class="nav-link">Timeline</a>
                            </li>
                            <li class="nav-item">
                                <a href="../miscellaneous/loader.css/index.html" class="nav-link">Loader.CSS</a>
                            </li>
                            <li class="nav-item">
                                <a href="../miscellaneous/spinkit/index.html" class="nav-link">Spinkit</a>
                            </li>
                            <li class="nav-item">
                                <a href="../miscellaneous/clipboard/index.html" class="nav-link">Clipboard</a>
                            </li>

                        </ul>
                        <!-- END : Miscellaneous submenu list -->

                    </li>
                    <!-- END : Link with submenu -->


                </ul>
            </div>
            <!-- END : Components Category -->


            <!-- More Category -->
            <div class="mainnav__categoriy py-1">
                <h6 class="mainnav__caption mt-0 fw-bold">More</h6>
                <ul class="mainnav__menu nav flex-column">

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-computer-secure fs-5 me-2"></i>
                            <span class="nav-label ms-1">App Views</span>
                        </a>

                        <!-- App Views submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../app-views/file-manager/index.html" class="nav-link">File Manager</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/users/index.html" class="nav-link">Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/users-2/index.html" class="nav-link">Users 2</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/profile/index.html" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/calendar/index.html" class="nav-link">Calendar</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/taskboard/index.html" class="nav-link">Taskboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/chat/index.html" class="nav-link">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a href="../app-views/contact-us/index.html" class="nav-link">Contact Us</a>
                            </li>

                        </ul>
                        <!-- END : App Views submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-speech-bubble-5 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Blog Apps</span>
                        </a>

                        <!-- Blog Apps submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../blog-apps/blog/index.html" class="nav-link">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="../blog-apps/blog-list/index.html" class="nav-link">Blog List</a>
                            </li>
                            <li class="nav-item">
                                <a href="../blog-apps/blog-list-2/index.html" class="nav-link">Blog List 2</a>
                            </li>
                            <li class="nav-item">
                                <a href="../blog-apps/blog-article/index.html" class="nav-link">Blog Article</a>
                            </li>
                            <li class="nav-item">
                                <a href="../blog-apps/manage-posts/index.html" class="nav-link">Manage Posts</a>
                            </li>
                            <li class="nav-item">
                                <a href="../blog-apps/add-edit-posts/index.html" class="nav-link">Add Edit Posts</a>
                            </li>

                        </ul>
                        <!-- END : Blog Apps submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-mail fs-5 me-2"></i>
                            <span class="nav-label ms-1">Email</span>
                        </a>

                        <!-- Email submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../email/inbox/index.html" class="nav-link">Inbox</a>
                            </li>
                            <li class="nav-item">
                                <a href="../email/view-message/index.html" class="nav-link">View Message</a>
                            </li>
                            <li class="nav-item">
                                <a href="../email/compose-message/index.html" class="nav-link">Compose Message</a>
                            </li>

                        </ul>
                        <!-- END : Email submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-file-html fs-5 me-2"></i>
                            <span class="nav-label ms-1">Other Pages</span>
                        </a>

                        <!-- Other Pages submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../other-pages/blank-page/index.html" class="nav-link">Blank Page</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/invoice/index.html" class="nav-link">Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/search-results/index.html" class="nav-link">Search
                                    Results</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/faq/index.html" class="nav-link">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/pricing-tables/index.html" class="nav-link">Pricing
                                    Tables</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/error-404/index.html" class="nav-link">Error 404</a>
                            </li>
                            <li class="nav-item">
                                <a href="../other-pages/error-500/index.html" class="nav-link">Error 500</a>
                            </li>

                        </ul>
                        <!-- END : Other Pages submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-window-2 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Front Pages</span>
                        </a>

                        <!-- Front Pages submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../front-pages/error-404/index.html" class="nav-link">Error 404</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/error-500/index.html" class="nav-link">Error 500</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/maintenance/index.html" class="nav-link">Maintenance</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/login/index.html" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/register/index.html" class="nav-link">Register</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/password-reminder/index.html" class="nav-link">Password
                                    Reminder</a>
                            </li>
                            <li class="nav-item">
                                <a href="../front-pages/lock-screen/index.html" class="nav-link">Lock Screen</a>
                            </li>

                        </ul>
                        <!-- END : Front Pages submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-tactic fs-5 me-2"></i>
                            <span class="nav-label ms-1">Menu Levels</span>
                        </a>

                        <!-- Menu Levels submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Menu Link</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Menu Link</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Menu Link</a>
                            </li>
                            <li class="nav-item has-sub">
                                <a href="#" class="mininav-toggle nav-link collapsed">Submenu</a>
                                <ul class="mininav-content nav collapse">
                                    <li data-popper-arrow class="arrow"></li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-sub">
                                <a href="#" class="mininav-toggle nav-link collapsed">Submenu</a>
                                <ul class="mininav-content nav collapse">
                                    <li data-popper-arrow class="arrow"></li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">Menu Link</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END : Menu Levels submenu list -->

                    </li>
                    <!-- END : Link with submenu -->


                </ul>
            </div>
            <!-- END : More Category -->


            <!-- Extras Category -->
            <div class="mainnav__categoriy py-1">
                <h6 class="mainnav__caption mt-0 fw-bold">Extras</h6>
                <ul class="mainnav__menu nav flex-column">

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-happy fs-5 me-2"></i>
                            <span class="nav-label ms-1">Icons Pack</span>
                        </a>

                        <!-- Icons Pack submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../icons-pack/ionicons/index.html" class="nav-link">Ionicons</a>
                            </li>
                            <li class="nav-item">
                                <a href="../icons-pack/themify-icons/index.html" class="nav-link">Themify Icons</a>
                            </li>
                            <li class="nav-item">
                                <a href="../icons-pack/flag-icons/index.html" class="nav-link">Flag Icons</a>
                            </li>
                            <li class="nav-item">
                                <a href="../icons-pack/weather-icons/index.html" class="nav-link">Weather Icons</a>
                            </li>

                        </ul>
                        <!-- END : Icons Pack submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-medal-2 fs-5 me-2"></i>
                            <span class="nav-label ms-1">Premium Icons</span>
                        </a>

                        <!-- Premium Icons submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../premium-icons/line-icons-pack/index.html" class="nav-link">Line Icons
                                    Pack</a>
                            </li>
                            <li class="nav-item">
                                <a href="../premium-icons/solid-icons-pack/index.html" class="nav-link">Solid Icons
                                    Pack</a>
                            </li>

                        </ul>
                        <!-- END : Premium Icons submenu list -->

                    </li>
                    <!-- END : Link with submenu -->

                    <!-- Link with submenu -->
                    <li class="nav-item has-sub">


                        <a href="#" class="mininav-toggle nav-link collapsed"><i
                                class="demo-pli-love fs-5 me-2"></i>
                            <span class="nav-label ms-1">Helper Classes</span>
                        </a>

                        <!-- Helper Classes submenu list -->
                        <ul class="mininav-content nav collapse">
                            <li data-popper-arrow class="arrow"></li>
                            <li class="nav-item">
                                <a href="../helper-classes/background/index.html" class="nav-link">Background</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/link/index.html" class="nav-link">Link</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/text/index.html" class="nav-link">Text</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/borders/index.html" class="nav-link">Borders</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/images/index.html" class="nav-link">Images</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/sizing/index.html" class="nav-link">Sizing</a>
                            </li>
                            <li class="nav-item">
                                <a href="../helper-classes/more/index.html" class="nav-link">More</a>
                            </li>

                        </ul>
                        <!-- END : Helper Classes submenu list -->

                    </li>
                    <!-- END : Link with submenu -->


                </ul>
            </div>
            <!-- END : Extras Category -->


            <!-- Widget -->
            <div class="mainnav__widget">

                <!-- Widget buttton form small navigation -->
                <div class="mininav-toggle text-center py-2 d-mn-min">
                    <i class="demo-pli-monitor-2"></i>
                </div>

                <div class="d-mn-max mt-5"></div>

                <!-- Widget content -->
                <div class="mininav-content collapse d-mn-max">
                    <span data-popper-arrow class="arrow"></span>
                    <h6 class="mainnav__caption fw-bold">Server Status</h6>
                    <ul class="list-group list-group-borderless">
                        <li class="list-group-item text-reset">
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="mb-2 me-auto">CPU Usage</p>
                                <span class="badge bg-info rounded">35%</span>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 35%"
                                     aria-label="CPU Progress" aria-valuenow="35" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="list-group-item text-reset">
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="mb-2 me-auto">Bandwidth</p>
                                <span class="badge bg-warning rounded">73%</span>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 73%"
                                     aria-label="Bandwidth Progress" aria-valuenow="73" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-grid px-3 mt-3">
                        <a href="#" class="btn btn-sm btn-success">View Details</a>
                    </div>
                </div>
            </div>
            <!-- End - Profile widget -->


        </div>
        <!-- End - Navigation menu -->


        <!-- Bottom navigation menu -->
        <div class="mainnav__bottom-content border-top pb-2">
            <ul id="mainnav" class="mainnav__menu nav flex-column">
                <li class="nav-item has-sub">
                    <button type="button" class="nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="demo-pli-unlock fs-5 me-2"></i>
                        <span class="nav-label ms-1">Logout</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form"
                          class="d-none">
                        @csrf
                    </form>
                    {{--                        <a href="#" class="nav-link mininav-toggle collapsed" aria-expanded="false">--}}
                    {{--                            <i class="demo-pli-unlock fs-5 me-2"></i>--}}
                    {{--                            <span class="nav-label ms-1">Logout</span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="mininav-content nav flex-column collapse">--}}
                    {{--                            <li data-popper-arrow class="arrow"></li>--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a href="#" class="nav-link">This device only</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a href="#" class="nav-link">All Devices</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="nav-item">--}}
                    {{--                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Lock screen</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                </li>
            </ul>
        </div>
        <!-- End - Bottom navigation menu -->


    </div>
</nav>
