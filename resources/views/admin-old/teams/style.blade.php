<style>
    .team-emp {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        text-align: center;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgb(0 0 0 / 0%) 0px 18px 36px -18px;
        border-radius: 25px;
        padding: 20px;
    }

    .team-emp .col-md-2 {
        display: flex;
        flex-direction: column;
        border: none;
        font-size: 12px;
        align-items: center;
        position: relative;
    }

    .image-checkbox-container {
        position: relative;
        width: 50px;
        height: 50px;
        cursor: pointer;
    }

    .image-checkbox-container strong {
        font-size: 11px;
    }

    .select-user-checkbox {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0; /* Invisible but clickable */
        cursor: pointer;
    }

    .user-image {
        width: 100%;
        height: auto;
        border-radius: 50%;
        pointer-events: none; /* Prevents checkmark overlay from blocking clicks */
    }

    .checkmark-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        align-items: center;
        justify-content: center;
        color: green;
        font-size: 24px;
        font-weight: bold;
        pointer-events: none; /* Allows clicks to pass through to checkbox */
    }

    .select-user-checkbox:checked + .checkmark-overlay {
        display: flex;
    }

    .assign-brands-div {
        border-radius: 25px;
        max-height: 85vh;
        /*overflow-y: scroll;*/
        padding: 20px;
        /*overflow-x: hidden;*/
        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgb(0 0 0 / 0%) 0px 18px 36px -18px;
    }

    .assign-brands-div label {
        margin: 0px;
    }

    .assign-brands-div p {
        font-size: 12px;
        font-weight: 600;
        color: #000;
        margin-bottom: 0px;
    }

    .assign-brands-div span.brand-url {
        font-size: 12px;
    }

    .assign-brands-div i {
        font-weight: 600;
    }

    .assign-brands {
        max-height: 65vh;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    @media (max-width: 576px) {
        .team-emp .col-md-2 {
            width: 25%;
        }

    }
</style>
