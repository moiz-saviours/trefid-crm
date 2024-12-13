<!-- Bootstrap JS [ OPTIONAL ] -->
<script
    src="../assets/themes/nifty/assets/js/bootstrap.min.705accd2201a27b32a1b95615e20fbb58fc9f3200388517b3a66f322ad955857.js"></script>


<!-- JS [ OPTIONAL ] -->
<script
    src="../assets/themes/nifty/assets/js/nifty.min.b960437305df20c97b96bfb28e62b7d655ad70041fcfed38fae70d11012b2b58.js"></script>

<!-- Plugin scripts [ OPTIONAL ] -->
<script
    src="../assets/themes/nifty/assets/pages/dashboard-1.min.b651fbd1a6f6a43e11bc01617b4481ab0edc4ba4582106c466d7ae2a9a9ac178.js"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<!-- New -->
<link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/sc-2.4.3/sp-2.3.3/sl-2.1.0/datatables.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/sc-2.4.3/sp-2.3.3/sl-2.1.0/datatables.min.js"></script>
<!-- New -->

<!-- Jquery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- End Jquery UI -->
<script>

    $(function () {
        $("#_dm-profileWidgetCheckbox").prop("checked") && $("#_dm-profileWidgetCheckbox").click();
        $("#_dm-stickyHeaderCheckbox").prop("checked") || $("#_dm-stickyHeaderCheckbox").click();
        $("#dm_colorModeContainer ._dm-colorModeBtn[data-color-mode='tm--primary-mn']:not(.active)").click();
    });

    <!-- Loader -->
    const loaders = ['sk-plane', 'sk-chase', 'sk-bounce', 'sk-wave', 'sk-pulse', 'sk-flow', 'sk-swing', 'sk-circle', 'sk-circle-fade', 'sk-grid', 'sk-fold', 'sk-wander'];
    let randomLoader;

    function randomLoaderFunction() {
        return loaders[Math.floor(Math.random() * loaders.length)];
    }

    randomLoader = randomLoaderFunction();

    $(`#loader`).show();
    $(`.${randomLoader}`).removeClass('load-spinner');
    $(document).ready(function () {
        if (@json(View::hasSection('datatable'))) {
            setTimeout(() => {$('#loader').hide();$(`.${randomLoader}`).toggleClass('load-spinner');}, 1000);
        } else {
            $(`#loader`).hide();
            $(`.${randomLoader}`).toggleClass('load-spinner');
        }

        $('#testTable').DataTable();
    });
</script>
