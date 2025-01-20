@extends('admin.layouts.app')
@section('title', 'Customer CustomerCompany / Edit')
@section('content')
    @push('style')
        @include('admin.customers.contacts.style')
        <style>
            .containerr {
                display: flex;
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
            }

            .custom-drop-down-show-main {
                display: flex !important;

            }

            .custom-drop-down-show.dropdown-menu.show {
                box-shadow: none;
                border: 1px solid #ddd;
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
                padding: 10px;
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

            .searchbox .searchbox__input.bg-color {
                border: 0;
                box-shadow: none !important;
                background: #fff !important;
                color: #ddd !important;
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
                /* text-align: center; */
                margin-left: 8px;
            }

            .email-box-container {
                background-color: rgb(255, 255, 255);
                border: 1px solid rgb(223, 227, 235);
                border-radius: 4px;
                padding: 12px 16px 0px;
                margin-bottom: 20px;
            }

            .customize-select {
                min-width: 150px;
            }

            .customize-select select {
                appearance: none;
                width: 100%;
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
                /* margin: 5px 0; */
                font-size: 13px;
                color: gray;
            }

            .profile_actions p {
                font-size: 10px;
                margin: 0px 9px;
                color: gray;
            }

            .email-child-wrapper {
                display: flex;
                gap: 8px;
                cursor: pointer;
                align-items: center
            }

            .comment-active_head {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                /* align-items: center; */
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
                color: #0091ae !important;
                font-weight: 600;
                margin: 0px !important;
            }

            .add-coment-icon {
                color: #75868f;
            }

            .hidden {
                display: none;
            }

            /* .email-child-wrapper {
                color: #007bff;
                padding: 10px 15px;

                font-size: 14px;
            } */

            .comment-box {
                margin-top: 10px;
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
                /* color: #007bff; */
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
                /* align-items: center; */
                gap: 9px;
            }

            .profile_actions {
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 1px solid #ddd;
                /* padding-bottom: 30px; */
                padding: 20px 0px;

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
                margin: 0px;
                font-size: 13px;
            }

            span.user_name {
                color: #2d3e50;
            }

            .new-sidebar-icons {
                color: #808080;
                background-color: #ddd;
                padding: 12px;
                border-radius: 50%;
                display: flex;
                align-items: center;
            }

            .avatarr {
                width: 35px;
                height: 35px;
                background-color: #ccc;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                margin-bottom: 20px;
            }

            .editor-container {
                /* width: 80%; */
                display: flex;
                gap: 8px;
                /* margin: 0 auto; */
            }

            .your-comment-btn {}

            .toolbar {
                background-color: #dddddda6;
                padding: 6px;
                border: 1px solid #ccc;
                display: flex;
                justify-content: flex-start;
                gap: 10px;
                margin-bottom: 10px;
            }

            .toolbar button {
                padding: 2px 12px;
                cursor: pointer;
                border: 1px solid #ccc;
                background-color: #fff;
                font-size: 12px;
            }

            .editor {
                border: 1px solid #ccc;
                padding: 10px;
                min-height: 90px;
                background-color: #dddddda6;
                width: 100%;
            }

            .editor[contenteditable="true"]:empty:before {
                content: "Leave comment...";
                color: #aaa;
            }

            .custom-drop-btn-design {
                background: transparent;
                border: none;
                color: #0c96b2;
                font-weight: 600;
                padding: 0;
                font-size: 13px;
                text-align: left;
            }



            .custom-drop-btn-design:hover {
                background-color: transparent;
                box-shadow: none;
                border: none;
                color: #0c96b2;
            }

            .user_profile {
                display: flex;
            }

            .user_profile-hidden {
                display: none;
            }

            .contact-us-text {

                /* margin-bottom: -3px; */
                font-size: 11px;
                font-weight: 700;
                margin-top: 4px;
                padding-left: 4px;

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
                margin-bottom: 10px;
                align-items: center;
            }

            .user_cont p {
                font-size: 12px;
                color: gray;
            }

            .user_cont {
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
    @endpush
    <section id="content" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="sidebarr">
                        <div>
                            <div class="profile_box">
                                <div class="avatar">MM</div>
                                <div class="contact-info">
                                    <h2>{{$customer_contact->name}}</h2>
                                    <h5>{{$customer_contact->address}}</h5>
                                    <p>{{$customer_contact->email}}</p>
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
                                <div class="text-center">
                                    <i class="fa fa-list sidebar-icons" aria-hidden="true"></i>
                                    <p>Task</p>
                                </div>
                                <div class="text-center">
                                    <i class="fa fa-list sidebar-icons" aria-hidden="true"></i>
                                    <p>Task</p>
                                </div>

                                <div class="text-center">
                                    <i class="fa fa-calendar-check-o sidebar-icons" aria-hidden="true"></i>
                                    <p>More</p>
                                </div>
                            </div>
                        </div>

                        <div class="sections">
                            <div class="collaborators">
                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExamplecontact"
                                                aria-expanded="true" aria-controls="collapseExamplecontact">

                                            About this contact
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse show" id="collapseExamplecontact" style="">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by
                                        default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>

                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExamplesubscriptions"
                                                aria-expanded="true" aria-controls="collapseExamplesubscriptions">
                                            Communication subscriptions
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse show" id="collapseExamplesubscriptions" style="">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by
                                        default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>

                                <div class="collapse-header-prent-box">
                                    <div class="collapse-header-box">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <button class="btn custom-btn-collapse" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseExampleactivity"
                                                aria-expanded="false" aria-controls="collapseExampleactivity">
                                            Website activity
                                        </button>
                                    </div>
                                </div>

                                <div class="collapse" id="collapseExampleactivity">
                                    <div class="card custom-contact-cards card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by
                                        default
                                        but
                                        revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
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
                                        aria-selected="false" tabindex="-1">Activities</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <div>

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
                                                <p class="recent-filters"> Filter by: <span
                                                        class="activities-seprater">7
                                                            activities</span></p>
                                            </div>
                                            <div class="email-box-container">
                                                <div class="activ_head" onclick="toggleContent('toggledContent1')">
                                                    <div class="email-child-wrapper">
                                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                        <i class="fa fa-envelope-o new-sidebar-icons"
                                                           aria-hidden="true"></i>

                                                        <p>
                                                            Inbound email from
                                                            <span class="activities-seprater">Mr Malik</span>
                                                        </p>
                                                    </div>
                                                    <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5</p>
                                                </div>


                                                <div>
                                                    <div class="contact-us-text">
                                                        <p>contact us</p>

                                                    </div>
                                                    <div class="user_profile-hidden" id="toggledContent1">
                                                        <div class="user_profile_img">
                                                            <div class="avatarr">MM</div>
                                                        </div>
                                                        <div class="user_profile_text">
                                                            <p>Mike Stewar mikestewar1932@outlook.com</p>
                                                            <p style="font-weight: 500">to info@phototouchexpert.com
                                                            </p>
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

                                                <div class="comment-active_head" id="toggledContent1">
                                                    <!-- <div class="email-child-wrapper" >
                                                        <i class="fa fa-commenting-o add-coment-icon" aria-hidden="true"></i>
                                                        <p class="activities-seprater">
                                                            Add Comments
                                                        </p>
                                                    </div> -->
                                                    <div>

                                                        <div class="email-child-wrapper" id="toggleButton">
                                                            <i class="fa fa-commenting-o add-coment-icon"
                                                               aria-hidden="true"></i>
                                                            <span class="activities-seprater">Add Comments</span>
                                                        </div>


                                                        <div id="contents" class="hidden comment-box">
                                                            <div class="editor-container">
                                                                <div class="avatarr">MM</div>
                                                                <div>
                                                                    <!-- Editable content area -->
                                                                    <div class="editor" id="editor"
                                                                         contenteditable="true">
                                                                        <!-- <textarea class="editor"
                                                                            placeholder="Leave comment..."></textarea> -->
                                                                    </div>
                                                                    <!-- Toolbar with buttons for text formatting -->
                                                                    <div class="toolbar">
                                                                        <button id="boldBtn"><b>B</b></button>
                                                                        <button id="italicBtn"><i>I</i></button>
                                                                        <button id="underlineBtn"><u>U</u></button>
                                                                        <button id="strikeBtn"><s>S</s></button>
                                                                        <!-- <button id="fontSizeBtn">Font Size</button> -->
                                                                        <!-- <button id="linkBtn">Link</button> -->
                                                                        <button id="alignLeftBtn">Left</button>
                                                                        <button id="alignCenterBtn">Center</button>
                                                                        <button id="alignRightBtn">Right</button>
                                                                        <button id="unorderedListBtn">UL</button>
                                                                        <button id="orderedListBtn">OL</button>
                                                                    </div>

                                                                    <!-- Save content as .txt file -->
                                                                    <div class="editor-container">
                                                                        <button
                                                                            class="your-create-contact create-contact">comment</button>
                                                                        <button
                                                                            class="your-comment-cancel">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="customize-select">
                                                            <select class="btn custom-drop-btn-design selection-box">
                                                                <option> Selected<span>0</span></option>
                                                                <option> Carts <span>0</span></option>
                                                                <option>Companies 0</option>
                                                                <option> Leads <span>1</span></option>
                                                                <option>Orders <span>1</span></option>
                                                            </select>

                                                        </div> -->


                                                    <div class="dropdown">
                                                        <div class="dropdown-toggle custom-drop-btn-design ">1
                                                            Association </div>
                                                        <div class="dropdown-content">

                                                            <div class="dropdown-content-wraper">
                                                                <ul class="nested-select-list">
                                                                    <li class="checkbox-item">

                                                                        <label>Companies 0</label>
                                                                    </li>
                                                                    <li class="checkbox-item">

                                                                        <label>Carts 0</label>
                                                                    </li>
                                                                    <li class="checkbox-item">

                                                                        <label>Contacts 0</label>
                                                                    </li>
                                                                    <li class="checkbox-item">

                                                                        <label>Leads 0</label>
                                                                    </li>
                                                                    <li class="checkbox-item">

                                                                        <label>Deals 0</label>
                                                                    </li>
                                                                    <li class="checkbox-item">

                                                                        <label>Orders 0</label>
                                                                    </li>
                                                                    <!-- Add more items as needed -->
                                                                </ul>
                                                                <div>
                                                                    <div class="search-box-select">
                                                                        <input type="text"
                                                                               placeholder="Search current associations"
                                                                               class="search-input">
                                                                    </div>
                                                                    <div class="select-contact-box-space">
                                                                        <p class="select-contact">Contacts</p>

                                                                        <input type="checkbox" id="contact2">
                                                                        <label for="contact2">HoeoSQMLp
                                                                            becelhmerthewatt@yahoo.com</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="dropdown">
                                                        <button class="btn custom-drop-btn-design dropdown-toggle"
                                                            type="button" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            1 Association
                                                        </button>

                                                        <ul class="custom-drop-down-show-main custom-drop-down-show dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            <li>

                                                            </li>
                                                            <li>
                                                                <div class="customize-select">

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="activity">
                                            <div class="association-activities-box">
                                                <h2>Companies</h2>
                                                <div>
                                                    <i class="fa fa-plus create-contact open-form-btn"
                                                       aria-hidden="true"> Add</i>
                                                </div>

                                            </div>
                                            <p class="user_cont text-center"> No associated objects of this type
                                                exist or you don't have permission to view them.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class="custom-tabs-row">
                                    <ul class="nav nav-tabs newtabs-space" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize active" id="act-tab"
                                                    data-bs-toggle="tab" data-bs-target="#act" type="button" role="tab"
                                                    aria-controls="act" aria-selected="true">Activity</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize" id="notes-tab" data-bs-toggle="tab"
                                                    data-bs-target="#notes" type="button" role="tab"
                                                    aria-controls="notes" aria-selected="false"
                                                    tabindex="-1">Notes</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link customize" id="email-tab" data-bs-toggle="tab"
                                                    data-bs-target="#email" type="button" role="tab"
                                                    aria-controls="email" aria-selected="false"
                                                    tabindex="-1">Emails</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="act" role="tabpanel"
                                             aria-labelledby="act-tab">
                                            <div class="activ_head">

                                                <!-- Searchbox input -->
                                                <div class="search-containers">
                                                    <form id="search-form" style="margin:0;">
                                                        <input type="text" class="search-inputs"
                                                               placeholder="Search activities" name="query">
                                                        <button class="search-btns">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- dropdown  -->
                                                <div class="dropdown">
                                                    <button
                                                        class="new-activity-dropdown btn-secondary dropdown-toggle"
                                                        type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Collapse all
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Something else
                                                                here</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="date-by-order"> May 2021</p>
                                                <div class="data-highlights">
                                                    <div class="data-top-heading-header">
                                                        <h2>Life Cycle</h2>
                                                        <p>12/03/2024 4:48 PM GMT+5</p>
                                                    </div>
                                                    <p class="user_cont"> No associated objects of this
                                                        type
                                                        exist or you don't have permission to view them.</p>
                                                </div>

                                                <div class="recent-activities">
                                                    <h2>Recent activities</h2>
                                                    <div class="activity">
                                                        <div class="activ_head">
                                                            <p>
                                                                Inbound email from
                                                                <span class="user_name">Mr Malik</span>
                                                            </p>
                                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <div class="user_profile">
                                                                <div class="user_profile_img">
                                                                    <div class="avatarr">MM</div>
                                                                </div>
                                                                <div class="user_profile_text">
                                                                    <p>Mike Stewar mikestewar1932@outlook.com
                                                                    </p>
                                                                    <p>to info@phototouchexpert.com</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user_cont">
                                                            <p>
                                                                Hi there, I hope you're doing well. I specialize
                                                                in
                                                                online reputation management and can help boost
                                                                your
                                                                business's presence by generating positive
                                                                reviews
                                                                and
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
                                                            <p class="usre_date">Dec 3, 2024 at 4:48 PM GMT+5
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <div class="user_profile">
                                                                <div class="user_profile_img">
                                                                    <div class="avatarr">MM</div>
                                                                </div>
                                                                <div class="user_profile_text">
                                                                    <p>Mike Stewar mikestewar1932@outlook.com
                                                                    </p>
                                                                    <p>to info@phototouchexpert.com</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user_cont">
                                                            <p>
                                                                Hi there, I hope you're doing well. I specialize
                                                                in
                                                                online reputation management and can help boost
                                                                your
                                                                business's presence by generating positive
                                                                reviews
                                                                and
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





                            </div>

                        </div>
                    </div>



                    <div class="main">


                    </div>
                </div>
                <div class="col-lg-3">


                    <div class="right-sidebarr">
                        <div class="collaborators right_collab">



                            <div class="collapse-header-prent-box">
                                <div class="collapse-header-box">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample" aria-expanded="true"
                                            aria-controls="collapseExample">

                                        Company <span> (1) </span>
                                    </button>
                                </div>
                                <i class="fa fa-plus create-contact open-form-btn" aria-hidden="true"> Add</i>
                            </div>

                            <div class="collapse show" id="collapseExample" style="">
                                <div class="card custom-collapse-cards card-body">
                                    Some placeholder content for the collapse component. This panel is hidden by
                                    default but
                                    revealed when the user activates the relevant trigger.
                                </div>
                            </div>

                            <div class="collpase-divider"></div>


                            <div class="collapse-header-prent-box">
                                <div class="collapse-header-box">
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <button class="btn custom-btn-collapse" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExampleone" aria-expanded="true"
                                            aria-controls="collapseExampleone">

                                        Company <span> (1) </span>
                                    </button>
                                </div>
                                <i class="fa fa-plus create-contact open-form-btn" aria-hidden="true"> Add</i>
                            </div>

                            <div class="collapse show" id="collapseExampleone" style="">
                                <div class="card custom-collapse-cards-two card-body">
                                    Some placeholder content for the collapse component. This panel is hidden by
                                    default but
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

    @include('admin.customers.contacts.custom-form')

    @push('script')
        @include('admin.customers.contacts.script')
        <script>
            // Function to toggle the visibility of the additional content div
            function toggleContent(contentId) {
                var contentDiv = document.getElementById(contentId);

                // Toggle the display property (show/hide)
                if (contentDiv.style.display === "none" || contentDiv.style.display === "") {
                    contentDiv.style.display = "flex"; // Show the content
                } else {
                    contentDiv.style.display = "none"; // Hide the content
                }
            }

            // Second comment function

            $(document).ready(function () {
                $('#toggleButton').click(function () {
                    const contents = $('#contents');
                    if (contents.hasClass('hidden')) {
                        contents.removeClass('hidden');
                        $(this).find('span').text('Hide Comment');
                    } else {
                        contents.addClass('hidden');
                        $(this).find('span').text('Add Comments');
                    }
                });
            });


            //Comment box editor function

            $(document).ready(function () {
                // Toggle Bold
                $('#boldBtn').click(function () {
                    document.execCommand('bold');
                });

                // Toggle Italic
                $('#italicBtn').click(function () {
                    document.execCommand('italic');
                });

                // Toggle Underline
                $('#underlineBtn').click(function () {
                    document.execCommand('underline');
                });

                // Toggle Strikethrough
                $('#strikeBtn').click(function () {
                    document.execCommand('strikeThrough');
                });

                // Change font size
                $('#fontSizeBtn').click(function () {
                    // var size = prompt("Enter font size (1-7):", "3");
                    document.execCommand('fontSize', false, size);
                });

                // Insert link
                $('#linkBtn').click(function () {
                    var url = prompt("Enter the URL:", "http://");
                    document.execCommand('createLink', false, url);
                });

                // Align Left
                $('#alignLeftBtn').click(function () {
                    document.execCommand('justifyLeft');
                });

                // Align Center
                $('#alignCenterBtn').click(function () {
                    document.execCommand('justifyCenter');
                });

                // Align Right
                $('#alignRightBtn').click(function () {
                    document.execCommand('justifyRight');
                });

                // Insert Unordered List
                $('#unorderedListBtn').click(function () {
                    document.execCommand('insertUnorderedList');
                });

                // Insert Ordered List
                $('#orderedListBtn').click(function () {
                    document.execCommand('insertOrderedList');
                });

                // Save content as .txt file
                // $('#saveBtn').click(function () {
                //     var content = $('#editor').text();
                //     var blob = new Blob([content], { type: 'text/plain' });
                //     var link = document.createElement('a');
                //     link.href = URL.createObjectURL(blob);
                //     link.download = 'document.txt';
                //     link.click();
                // });
            });


            // select to function
            $(document).ready(function () {
                // Toggle dropdown visibility
                $(".dropdown-toggle").on("click", function () {
                    $(".dropdown-content").toggle();
                });

                // Filter list based on search input
                $(".search-input").on("input", function () {
                    const filter = $(this).val().toLowerCase();
                    $(".checkbox-item").each(function () {
                        const label = $(this).find("label").text().toLowerCase();
                        $(this).toggle(label.includes(filter));
                    });
                });

                // Close dropdown if clicked outside
                $(document).on("click", function (e) {
                    if (!$(e.target).closest(".dropdown").length) {
                        $(".dropdown-content").hide();
                    }
                });
            });
            // $('select>option:eq(3)').attr('selected', true);

            // Searching Input function

            $(document).ready(function () {
                // Expand and collapse the search bar
                $(".search-btns").on("click", function (e) {
                    e.preventDefault(); // Prevent form submission on button click
                    $(".search-containers").toggleClass("expanded");
                    $(".search-inputs").focus();
                });

                // Handle form submission for search
                $("#search-form").on("submit", function (e) {
                    e.preventDefault(); // Prevent default form submission
                    const query = $(".search-inputs").val().trim();

                    if (query) {
                        // Log the search query or perform an action
                        console.log("Searching for:", query);

                        // Redirect or process search here
                        // Example: window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    } else {
                        alert("Please enter a search term.");
                    }
                });

                // Collapse the search bar when clicking outside
                $(document).on("click", function (e) {
                    if (!$(e.target).closest(".search-containers").length) {
                        $(".search-containers").removeClass("expanded");
                    }
                });
            });
        </script>
    @endpush
@endsection
