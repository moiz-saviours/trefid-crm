<style>
    td object {
        width: 48px;
        height: 48px;
    }
</style>

<style>

    .void {
        cursor: not-allowed;
    }

    .custm_header {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .actions {
        display: flex;
    }

    .actions h1 {
        margin: auto;
        color: #52a0bf;
        font-size: 15px;
    }

    .filters,
    .table-controls {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        border-bottom: 1px solid #ddd;
    }

    .filters .filter-tabs button,
    .actions button {
        padding: 5px 12px;
        border: 1px solid #ff5722;
        border-radius: 4px;
        background-color: #fff;
        cursor: pointer;
    }

    .filters .actions .create-contact {
        background-color: #ff5722;
        color: #fff;
        border: none;
    }

    .search-bar input {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 250px;
    }

    .contacts-table {
        width: 100%;
        border-collapse: collapse;
    }

    .contacts-table th,
    .contacts-table td {
        padding: 10px;
        text-align: left;
        /*border: 1px solid #ddd;*/
    }

    .contacts-table th {
        /*background-color: #f1f5f9;*/
        font-weight: bold;
    }

    .contacts-table tbody tr:hover {
        background-color: #f9f9f9;
    }


    .header .new_head h1 {
        font-size: 20px;
        color: #52a0bf;
        font-weight: 700;

    }

    .header_btn {
        padding: 0px 30px;
        color: #ff5722;
        margin: 0px 10px;
    }

    .custom-tabs {
        margin: 10px 0px;
        display: flex;
    }

    .tab-nav {
        display: flex;
        justify-content: space-around;
        list-style: none;
        padding: 0;
        margin: 0;
        width: 70%;
    }

    .tab-buttons {
        margin-left: 100px;
    }

    .tab-item {
        padding: 10px 20px;
        cursor: pointer;
        border: 1px solid #cbd6e2;
        background: #f9f9f9;
        width: 100%;
        transition: background 0.3s ease;
    }

    .tab-item.active {
        background: #fff;
        border-bottom: none;

    }

    .tab-item.active i {
        float: right;
        font-size: 14px;
        margin: auto;
    }

    .tab-content {
        /*padding: 10px;*/
        /*margin-top: 10px;*/
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;

    }

    .fltr-sec {
        padding-top: 20px;
    }

    .table-li {
        display: flex;
    }

    .table-li .page-title {
        font-size: 14px;
        padding: 0px 30px 0px 0px;

        font-weight: 700;
    }

    .right-icon i {
        float: right;
        margin: 0px 4px;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 5px;
        font-size: 12px;
    }

    .custom-form .form-container {
        position: fixed;
        top: 0;
        right: -100%;
        width: 500px;
        height: 100%;
        background: #ffffff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        transition: right 0.5s ease;
        box-sizing: border-box;
        z-index: 1001;
    }

    .custom-form .form-container.open {
        right: 0;
    }

    .custom-form .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #52a0bf;
        color: white;
        font-size: 18px;
        font-weight: bold;
    }

    .custom-form .form-header .close-btn {
        font-size: 20px;
        font-weight: bold;
        background: none;
        border: none;
        color: white;
        cursor: pointer;
    }

    .custom-form .form-body {
        padding: 20px;
    }

    .custom-form .form-body label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .custom-form .form-body input:not(.is-invalid) {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .custom-form .form-body button {
        width: 100%;
        padding: 10px;
        background: #52a0bf;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .close-icon {
        display: none;
    }

    .tab-item.active .close-icon {
        display: inline;
    }

</style>
