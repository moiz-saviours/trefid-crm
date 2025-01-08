@extends('admin.layouts.app')
@section('title', 'Customer CustomerCompany / Edit')
@section('content')
    @push('style')
        @include('admin.customers.companies.style')
    @endpush
    <section id="content" class="content">
        <!-- ab content -->
        <style>
            /*body {*/
            /*    font-family: Arial, sans-serif;*/
            /*    margin: 0;*/
            /*    padding: 0;*/
            /*    display: flex;*/
            /*    height: 100vh;*/
            /*}*/

            .containerr {
                display: flex;
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
            }

            .collpase-divider {
                background-color: #ddd;
                height: 2px;
            }

            .collapse-header-box {
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .nav-tabs.newtabs-space {
                margin-bottom: 34px;
            }

            .date-by-order {
                text-align: left;
                padding-left: 15px;
                font-size: 17px;
                color: #2d3e50;
                padding-top: 10px
            }


            .custom-tabs-row {
                padding: 30px 7px;
            }

            .nav-tabs .nav-link.main-tabs-view {
                border-radius: 0px;
                font-weight: 400;
                font-size: 13px;
                padding: 12px 28px;
                color: rgb(51, 71, 91);
                position: relative;
                white-space: nowrap;
                /* transition: background-color 200ms cubic-bezier(0.25, 0.1, 0.25, 1); */
                /* background-color: rgb(234, 240, 246); */
                /* border-left: 1px solid rgb(203, 214, 226); */
            }

            .nav-tabs .nav-link.main-tabs-view.active {
                background-color: rgb(234, 240, 246);
            }

            .nav-tabs .nav-link.customize {
                background-color: transparent !important;
                border: 0px;
            }

            .nav-tabs .nav-link.customize.active {
                border-bottom: 3px solid #2d3e50;
                background: transparent;
                border-width: 0px 0px 3px 0px;
                border-radius: 3px;
            }

            .custom-btn-collapse {
                background: transparent;
                border: none;
                padding: 0;
                color: #2d3e50;
                font-size: 12px;
                /* border-radius: 5px; */
                font-weight: 600;

            }

            .custom-spacing {
                padding: 0px 13px;
            }

            .data-top-heading-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 17px;

            }

            .sidebar-icons {
                color: #808080;
                background-color: #ddd;
                padding: 15px;
                border-radius: 31px;
            }



            .sidebarr {
                width: auto;
                background-color: #f0f4f8;
                padding: 20px 2px;
                box-sizing: border-box;
                border-right: 1px solid #ddd;
                overflow-y: auto;
                height: 100%;
                /* height: 100%; */

            }

            .profile {
                display: flex;
                /* flex-direction: column; */
                align-items: center;
            }

            .avatar {
                width: 58px;
                height: 58px;
                background-color: #ccc;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                /* margin-bottom: 20px; */
            }

            .contact-info {
                text-align: center;
                margin-left: 8px;
            }

            .email-box-container {
                background-color: rgb(255, 255, 255);
                border: 1px solid rgb(223, 227, 235);
                border-radius: 4px;
                padding: 12px 16px 0px;
            }

            .contact-info h2 {
                margin: 0;
                font-size: 20px;
                text-align: left;
                font-weight: 600;
                color: #2d3e50;
                margin-bottom: -3px;
            }

            .recent-filters {
                color: rgb(81, 111, 144);
                font-weight: 400;
                font-size: 14px;
                line-height: 24px;
            }

            .contact-info p {
                margin: 5px 0;
                font-size: 13px;
                color: gray;
            }

            .profile_actions p {
                font-size: 12px;
                margin: 0px 8px;
                color: gray;
            }
            .email-child-wrapper{
                display: flex;
                gap: 8px;
                
                
            }

            .profile_actions p i {
                background: #e3dede;
                padding: 8px;
                border-radius: 20px;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center;
                margin: 20px 0;
            }

            .actions button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
                border-radius: 5px;
                flex: 1 1 calc(50% - 10px);
                max-width: 80px;
                text-align: center;
            }

            .sections .section {
                margin-top: 20px;
            }

            .collaborators {
                margin-top: 20px;
            }

            .collaborators h3 {
                margin-bottom: 10px;
            }

            .collapsible {
                margin-bottom: 10px;
            }

            .collapsible-content h5 {
                font-size: 14px;
                margin-top: 11px;
                margin-bottom: 0px;
            }

            .collapsible-header {
                background-color: transparent;
                color: #2d3e50;
                cursor: pointer;
                padding: 5px 0px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 13px;
                border-radius: 5px;
                font-weight: 600;
            }

            .collapse-header-prent-box {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                /* margin-top: 11px; */
                /* border-bottom: 1px solid #ddd; */
                /* padding-bottom: 14px; */
                padding: 0px 12px;

            }

            .custom-collapse-cards {
                padding: 13px;
                box-shadow: none;
                margin: 0px 15px 9px;
            }

            .custom-collapse-cards-two {
                padding: 13px;
                box-shadow: none;
                margin: 0px 15px;
                background: transparent;
            }

            .custom-contact-cards {
                background: transparent;
                box-shadow: none;
                padding: 0px 12px 8px;
            }

            .collapsible-content {
                padding: 0 10px;
                display: none;
                overflow: hidden;
                background-color: #f0f4f8;
                border-radius: 5px;
                margin-top: 5px;
            }

            .collapsible-content p {
                padding: 0px 0px;
                margin: 0;
                font-size: 13px;
                color: gray;
            }

            .main {
                flex-grow: 1;
                padding: 20px;
                box-sizing: border-box;
                overflow-y: auto;
            }

            .headerr {
                display: flex;
                justify-content: flex-start;
                margin-bottom: 20px;
                gap: 10px;
            }

            .headerr .tablink {
                background-color: #f0f4f8;
                color: black;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                font-size: 16px;
            }

            .headerr .tablink.active {
                background-color: #2d3e50;
                color: white;
            }

            .content {
                height: calc(100% - 60px);
            }

            .data-highlights,
            .recent-activities {
                margin-bottom: 20px;
            }

            .data-highlights h2,
            .recent-activities h2 {
                margin: 0 0 10px 0;
                font-size: 18px;
            }

            .data-row {
                display: flex;
                justify-content: space-between;
                padding: 2px 9px;
            }

            .data-row div {
                flex: 1;
                margin-right: 20px;
            }

            .data-row div:last-child {
                margin-right: 0;
            }

            .data-row p {
                margin: 0;
                color: gray;
                font-size: 12px;
                text-align: center;
            }

            .activity {
                border: 1px solid #ddd;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 10px;
                background-color: #fff;
            }

            .recent-activities h2 {
                text-align: left;
                /* padding-left: 15px; */
                font-size: 17px;
                color: #2d3e50;
                padding-top: 10px;
            }

            .activities-seprater {
                color: #0091ae;
                font-weight: 600;

            }

            .activity-header {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .activity-icon {
                margin-right: 10px;
            }

            .activity-header p {
                margin: 0;
                margin-right: 10px;
                color: #007bff;
            }

            .right-sidebarr {
                /* width: 25%; */
                background-color: #f0f4f8;
                padding: 20px 0px;
                height: 100%;
                box-sizing: border-box;
                border-left: 1px solid #ddd;
                /* overflow-y: auto; */
            }

            .associated-objects .section {
                margin-bottom: 20px;
            }

            .associated-objects h3 {
                margin-bottom: 10px;
            }

            .associated-objects p {
                color: #666;
            }

            .associated-objects button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
                border-radius: 5px;
            }

            .profile_box {
                display: flex;
                padding: 0px 13px;
                align-items: center;
                gap: 9px;
            }

            .profile_actions {
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 1px solid #ddd;
                /* padding-bottom: 30px; */
                padding: 20px 20px;
                gap: 11px;
            }


            .profile_actions p {
                text-align: center;
            }


            .data-highlights {
                background: white;
                text-align: center;
                padding-bottom: 7px;
                padding-top: 7px;
                margin-top: 20px;
                border-radius: 3px;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            }

            .data-highlights h2 {
                text-align: left;
                /* padding-left: 15px;
                                        padding-bottom: 15px; */
                font-size: 15px;
                color: #2d3e50;
            }

            .data-row h5 {
                font-size: 12px;
                font-weight: 500;
                color: #2d3e50;
                margin-bottom: 3px;
                text-align: center;
            }

            .activ_head p {
                color: gray;
                font-size: 13px;
            }

            span.user_name {
                color: #2d3e50;
            }

            .avatarr {
                width: 40px;
                height: 40px;
                background-color: #ccc;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 15px;
                margin-bottom: 20px;
            }

            .user_profile {
                display: flex;
            }

            .user_profile_text p {
                margin-bottom: -3px;
                font-size: 11px;
                font-weight: 700;
                margin-top: 4px;
                padding-left: 8px;
            }

            .activ_head {
                display: flex;
                justify-content: space-between;
            }

            .user_cont p {
                font-size: 12px;
                color: gray;
            }

            .right_collab i {
                float: right;
                /* background: #2d3e50; */
                color: #2d3e50;
                padding: 5px;
                border-radius: 5px;
                font-size: 11px;
            }

            .user_cont h4 {
                font-size: 13px;
                font-weight: 600;
                color: #2d3e50;
                margin-bottom: 4px;
            }

            .activ_top {
                margin-top: 2%;
            }

            .balnk_text p {
                text-align: center;
                margin: 50px;
                font-size: 14px;
            }

            .tabs_header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 3%;
            }

            .tabs_header select {
                width: 35%;
            }

            .tabs_header input {
                width: 35%;
            }
        </style>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">


                    <div class="sidebarr">
                        <div>
                            <div class="profile_box">
                                <div class="avatar">MM</div>
                                <div class="contact-info">
                                    <h2>Mr Malik</h2>
                                    <p>mmr840327@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="profile_actions">
                                <div class="text-center">

                                    <i class="fa fa-pencil-square-o sidebar-icons" aria-hidden="true"></i>
                                    <p> Note</p>

                                </div>

                                <div class="text-center">

                                    <i class="fa fa-envelope-o sidebar-icons" aria-hidden="true"></i>
                                    <p> Email</p>

                                </div>

                                <div class="text-center">

                                    <i class="fa fa-phone-square sidebar-icons" aria-hidden="true"></i>
                                    <p>Call</p>
                                </div>

                                {{-- <div class="text-center">

                                    <i class="fa fa-coffee sidebar-icons" aria-hidden="true"></i>
                                    <p> Task </p>

                                </div> --}}

                                <div class="text-center">

                                    <i class="fa fa-calendar-check-o sidebar-icons" aria-hidden="true"></i>

                                    <p>More</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="profile">
                            <div class="profile_box">
                                <div class="avatar">MM</div>
                                <div class="contact-info">
                                    <h2>Mr Malik</h2>
                                    <p>mmr840327@gmail.com</p>
                                </div>
                            </div>
                            <div class="profile_actions">
                                <p>
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Note
                                </p>
                                <p><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</p>
                                <p>
                                    <i class="fa fa-phone-square" aria-hidden="true"></i> Call
                                </p>
                                <p><i class="fa fa-coffee" aria-hidden="true"></i> Task</p>
                                <p>
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> More
                                </p>
                            </div>
                        </div> --}}
                        <div class="sections">
                            <div class="collaborators">
                                {{-- <div class="collapsible">
                                    <button class="collapsible-header">
                                        About this contact
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="collapsible-content">
                                        <h5>Eamil</h5>
                                        <p>arhamumar63@gmail.com</p>
                                        <h5>Phone number</h5>
                                        <p>+92 306-1343427</p>
                                        <h5>Contact owner</h5>
                                        <p>arhum butt</p>
                                    </div>
                                </div> --}}

                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExamplecontact" aria-expanded="false"
                                            aria-controls="collapseExamplecontact">

                                            About this contact
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse" id="collapseExamplecontact">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>



                                {{-- <div class="collapsible">
                                    <button class="collapsible-header">
                                        Communication subscriptions
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="collapsible-content">
                                        <p>
                                            Use subscription types to manage the communications this
                                            contact receives from you
                                        </p>
                                    </div>
                                </div> --}}

                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExamplesubscriptions" aria-expanded="false"
                                            aria-controls="collapseExamplesubscriptions">
                                            Communication subscriptions
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse" id="collapseExamplesubscriptions">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>

                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExampleactivity" aria-expanded="false"
                                            aria-controls="collapseExampleactivity">
                                            Website activity
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse" id="collapseExampleactivity">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>







                                {{-- <div class="collapsible">
                                    <button class="collapsible-header">
                                        Website activity
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="collapsible-content">
                                        <p>
                                            Website activity shows you how many times a contact has
                                            visited your site and viewed your pages.
                                        </p>
                                    </div>
                                </div> --}}











                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="custom-tabs-row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link main-tabs-view active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link main-tabs-view" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Activities</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div>
                                    {{-- <p class="date-by-order"> May 2021</p> --}}
                                    <div class="data-highlights">
                                        <div class="data-top-heading-header">
                                            <h2>Data highlights</h2>
                                            <p>12/03/2024 4:48 PM GMT+5</p>
                                        </div>
                                        <div class="data-row">
                                            <div>
                                                <h5>CREATE DATE</h5>
                                                <p>12/03/2024 4:48 PM GMT+5</p>
                                            </div>
                                            <div>
                                                <h5>LIFECYCLE STAGE</h5>
                                                <p>Lead</p>
                                            </div>
                                            <div>
                                                <h5>LAST ACTIVITY DATE</h5>
                                                <p>12/03/2024 4:48 PM GMT+5</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="recent-activities">

                                        <div class="activity">
                                            <h2>Recent activities</h2>
                                            <div>
                                                <p class="recent-filters"> Filter by: <span class="activities-seprater">7
                                                        activities</span></p>
                                            </div>
                                            <div class="email-box-container">
                                                <div class="activ_head">
                                                    <div class="email-child-wrapper">
                                                        <i class="fa fa-envelope-o sidebar-icons" aria-hidden="true"></i>
                                                        <p> Email</p>
                                                        <p>
                                                            Inbound email from
                                                            <span class="activities-seprater">Mr Malik</span>
                                                        </p>
                                                    </div>
                                                    <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                                </div>

                                                <div>
                                                    <div class="user_profile">
                                                        <div class="user_profile_img">
                                                            <div class="avatarr">MM</div>
                                                        </div>
                                                        <div class="user_profile_text">
                                                            <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                            <p>to info@phototouchexpert.com</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="user_cont">
                                                    <p>
                                                        Hi there, I hope you're doing well. I specialize in
                                                        online reputation management and can help boost your
                                                        business's presence by generating positive reviews and
                                                        addressing any negative feedback.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="activity">
                                            <div class="activ_head">
                                                <p>
                                                    Inbound email from
                                                    <span class="user_name">Mr Malik</span>
                                                </p>
                                                <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                            </div>

                                            <div>
                                                <div class="user_profile">
                                                    <div class="user_profile_img">
                                                        <div class="avatarr">MM</div>
                                                    </div>
                                                    <div class="user_profile_text">
                                                        <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                        <p>to info@phototouchexpert.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user_cont">
                                                <p>
                                                    Hi there, I hope you're doing well. I specialize in
                                                    online reputation management and can help boost your
                                                    business's presence by generating positive reviews and
                                                    addressing any negative feedback.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                {{-- actvity tabs start --}}
                                <div class="custom-tabs-row">
                                    <ul class="nav nav-tabs newtabs-space" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize active" id="act-tab" data-bs-toggle="tab"
                                                data-bs-target="#act" type="button" role="tab" aria-controls="act"
                                                aria-selected="true">Activity</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize" id="notes-tab" data-bs-toggle="tab"
                                                data-bs-target="#notes" type="button" role="tab"
                                                aria-controls="notes" aria-selected="false">Notes</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize" id="email-tab" data-bs-toggle="tab"
                                                data-bs-target="#email" type="button" role="tab"
                                                aria-controls="email" aria-selected="false">Emails</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="act" role="tabpanel"
                                            aria-labelledby="act-tab">
                                            <div>
                                                <p class="date-by-order"> May 2021</p>
                                                <div class="data-highlights">
                                                    <div class="data-top-heading-header">
                                                        <h2>Data highlights</h2>
                                                        <p>12/03/2024 4:48 PM GMT+5</p>
                                                    </div>
                                                    <div class="data-row">
                                                        <div>
                                                            <h5>CREATE DATE</h5>
                                                            <p>12/03/2024 4:48 PM GMT+5</p>
                                                        </div>
                                                        <div>
                                                            <h5>LIFECYCLE STAGE</h5>
                                                            <p>Lead</p>
                                                        </div>
                                                        <div>
                                                            <h5>LAST ACTIVITY DATE</h5>
                                                            <p>12/03/2024 4:48 PM GMT+5</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="recent-activities">
                                                    <h2>Recent activities</h2>
                                                    <div class="activity">
                                                        <div class="activ_head">
                                                            <p>
                                                                Inbound email from
                                                                <span class="user_name">Mr Malik</span>
                                                            </p>
                                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                                        </div>

                                                        <div>
                                                            <div class="user_profile">
                                                                <div class="user_profile_img">
                                                                    <div class="avatarr">MM</div>
                                                                </div>
                                                                <div class="user_profile_text">
                                                                    <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                                    <p>to info@phototouchexpert.com</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user_cont">
                                                            <p>
                                                                Hi there, I hope you're doing well. I specialize in
                                                                online reputation management and can help boost your
                                                                business's presence by generating positive reviews and
                                                                addressing any negative feedback.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="activity">
                                                        <div class="activ_head">
                                                            <p>
                                                                Inbound email from
                                                                <span class="user_name">Mr Malik</span>
                                                            </p>
                                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                                        </div>

                                                        <div>
                                                            <div class="user_profile">
                                                                <div class="user_profile_img">
                                                                    <div class="avatarr">MM</div>
                                                                </div>
                                                                <div class="user_profile_text">
                                                                    <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                                    <p>to info@phototouchexpert.com</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user_cont">
                                                            <p>
                                                                Hi there, I hope you're doing well. I specialize in
                                                                online reputation management and can help boost your
                                                                business's presence by generating positive reviews and
                                                                addressing any negative feedback.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="notes" role="tabpanel"
                                            aria-labelledby="notes-tab">notes
                                        </div>
                                        <div class="tab-pane fade" id="email" role="tabpanel"
                                            aria-labelledby="email-tab">email
                                        </div>
                                    </div>
                                </div>




                                {{-- actvity tabs ends --}}
                            </div>

                        </div>
                    </div>



                    <div class="main">
                        {{-- <div class="headerr">
                            <button class="tablink active" onclick="openTab('Overview')">
                                Overview
                            </button>
                            <button class="tablink" onclick="openTab('Activities')">
                                Activities
                            </button>
                        </div> --}}
                        {{-- <div class="content">
                            <div id="Overview" class="tabcontent">
                                <div class="data-highlights">
                                    <h2>Data highlights</h2>
                                    <div class="data-row">
                                        <div>
                                            <h5>CREATE DATE</h5>
                                            <p>12/03/2024 4:48 PM GMT+5</p>
                                        </div>
                                        <div>
                                            <h5>LIFECYCLE STAGE</h5>
                                            <p>Lead</p>
                                        </div>
                                        <div>
                                            <h5>LAST ACTIVITY DATE</h5>
                                            <p>12/03/2024 4:48 PM GMT+5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="recent-activities">
                                    <h2>Recent activities</h2>
                                    <div class="activity">
                                        <div class="activ_head">
                                            <p>
                                                Inbound email from
                                                <span class="user_name">Mr Malik</span>
                                            </p>
                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                        </div>

                                        <div>
                                            <div class="user_profile">
                                                <div class="user_profile_img">
                                                    <div class="avatarr">MM</div>
                                                </div>
                                                <div class="user_profile_text">
                                                    <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                    <p>to info@phototouchexpert.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user_cont">
                                            <p>
                                                Hi there, I hope you're doing well. I specialize in
                                                online reputation management and can help boost your
                                                business's presence by generating positive reviews and
                                                addressing any negative feedback.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="activity">
                                        <div class="activ_head">
                                            <p>
                                                Inbound email from
                                                <span class="user_name">Mr Malik</span>
                                            </p>
                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                        </div>

                                        <div>
                                            <div class="user_profile">
                                                <div class="user_profile_img">
                                                    <div class="avatarr">MM</div>
                                                </div>
                                                <div class="user_profile_text">
                                                    <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                    <p>to info@phototouchexpert.com</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user_cont">
                                            <p>
                                                Hi there, I hope you're doing well. I specialize in
                                                online reputation management and can help boost your
                                                business's presence by generating positive reviews and
                                                addressing any negative feedback.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="Activities" class="tabcontent" style="display: none">
                                <div class="recent-activities">
                                    <div class="tabs_header">
                                        <input type="email" class="form-control" id="exampleFormControlInput1"
                                            placeholder="name@example.com" />
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Collapse All</option>
                                            <option>Expand All</option>
                                        </select>
                                    </div>

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="activity-tab" data-bs-toggle="tab"
                                                data-bs-target="#activity" type="button" role="tab"
                                                aria-controls="activity" aria-selected="true">
                                                Activity
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="notes-tab" data-bs-toggle="tab"
                                                data-bs-target="#notes" type="button" role="tab"
                                                aria-controls="notes" aria-selected="false">
                                                Notes
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="emails-tab" data-bs-toggle="tab"
                                                data-bs-target="#emails" type="button" role="tab"
                                                aria-controls="emails" aria-selected="false">
                                                Emails
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="calls-tab" data-bs-toggle="tab"
                                                data-bs-target="#calls" type="button" role="tab"
                                                aria-controls="calls" aria-selected="false">
                                                Calls
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="tasks-tab" data-bs-toggle="tab"
                                                data-bs-target="#tasks" type="button" role="tab"
                                                aria-controls="tasks" aria-selected="false">
                                                Tasks
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="meetings-tab" data-bs-toggle="tab"
                                                data-bs-target="#meetings" type="button" role="tab"
                                                aria-controls="meetings" aria-selected="false">
                                                Meetings
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="activity" role="tabpanel"
                                            aria-labelledby="activity-tab">
                                            <div>
                                                <div class="activity activ_top">
                                                    <div class="activ_head">
                                                        <p>
                                                            Inbound email from
                                                            <span class="user_name">Mr Malik</span>
                                                        </p>
                                                        <p class="usre_date">
                                                            Dec 3, 2024 at 4:48 PM GMT+5
                                                        </p>
                                                    </div>

                                                    <div class="user_cont">
                                                        <h4>Online Reputation Management</h4>
                                                        <p>
                                                            Hi there, I hope you're doing well. I specialize
                                                            in online reputation management and can help boost
                                                            your business's presence by generating positive
                                                            reviews and addressing any negative feedback.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="notes" role="tabpanel"
                                            aria-labelledby="notes-tab">
                                            <div class="balnk_text">
                                                <p>
                                                    Take notes about this record to keep track of
                                                    important info. You can even @mention a teammate if
                                                    you need to. Learn more
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="emails" role="tabpanel"
                                            aria-labelledby="emails-tab">
                                            <div class="balnk_text">
                                                <p>
                                                    Take notes about this record to keep track of
                                                    important info. You can even @mention a teammate if
                                                    you need to. Learn more
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="calls" role="tabpanel"
                                            aria-labelledby="calls-tab">
                                            <div class="balnk_text">
                                                <p>
                                                    Take notes about this record to keep track of
                                                    important info. You can even @mention a teammate if
                                                    you need to. Learn more
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tasks" role="tabpanel"
                                            aria-labelledby="tasks-tab">
                                            <div class="balnk_text">
                                                <p>
                                                    Take notes about this record to keep track of
                                                    important info. You can even @mention a teammate if
                                                    you need to. Learn more
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="meetings" role="tabpanel"
                                            aria-labelledby="meetings-tab">
                                            <div class="balnk_text">
                                                <p>
                                                    Take notes about this record to keep track of
                                                    important info. You can even @mention a teammate if
                                                    you need to. Learn more
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-3">


                    <div class="right-sidebarr">
                        <div class="collaborators right_collab">
                            {{-- <div class="collapsible">
                                <button class="collapsible-header fa fa-caret-down">
                                    About this contact
                                    <i class="fa fa-plus" aria-hidden="true"> Add</i>
                                </button>
                                <div class="collapsible-content">
                                    <h5>Eamil</h5>
                                    <p>arhamumar63@gmail.com</p>
                                    <h5>Phone number</h5>
                                    <p>+92 306-1343427</p>
                                    <h5>Contact owner</h5>
                                    <p>arhum butt</p>
                                </div>
                            </div> --}}


                            <div class="collapse-header-prent-box">
                                <div class="collapse-header-box">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">

                                        Company <span> (1) </span>
                                    </button>
                                </div>
                                <i class="fa fa-plus create-contact open-form-btn" aria-hidden="true"> Add</i>
                            </div>

                            <div class="collapse" id="collapseExample">
                                <div class="card custom-collapse-cards card-body">
                                    Some placeholder content for the collapse component. This panel is hidden by default but
                                    revealed when the user activates the relevant trigger.
                                </div>
                            </div>

                            <div class="collpase-divider"></div>


                            <div class="collapse-header-prent-box">
                                <div class="collapse-header-box">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExampleone" aria-expanded="false"
                                        aria-controls="collapseExampleone">

                                        Company <span> (1) </span>
                                    </button>
                                </div>
                                <i class="fa fa-plus create-contact open-form-btn" aria-hidden="true"> Add</i>
                            </div>

                            <div class="collapse" id="collapseExampleone">
                                <div class="card custom-collapse-cards-two card-body">
                                    Some placeholder content for the collapse component. This panel is hidden by default but
                                    revealed when the user activates the relevant trigger.
                                </div>
                            </div>

                            <div class="collpase-divider"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.customers.companies.custom-form');

    @push('script')
        @include('admin.customers.companies.script')
    @endpush
@endsection
