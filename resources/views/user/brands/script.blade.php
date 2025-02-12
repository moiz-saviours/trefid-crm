<script>
    $(document).ready(function () {

        function decodeHtmlEntities(str) {
            return str ? $('<div>').html(str).text() : str;
        }

        const formatBody = (type) => (data, row, column, node) => {
            if (type === 'print') {
                if ($(node).find('img').length > 0) {
                    const src = $(node).find('img').attr('src');
                    return `<img src="${src}" style="max-width: 100px; max-height: 100px;" />`;
                }
            } else if (type !== 'print' && ($(node).find('object').length > 0 || $(node).find('img').length > 0)) {
                return $(node).find('object').attr('data') || $(node).find('object img').attr('src') || $(node).find('img').attr('src') || '';
            }
            if ($(node).find('.status-toggle').length > 0) {
                return $(node).find('.status-toggle:checked').length > 0 ? 'Active' : 'Inactive';
            }
            if ($(node).find('.invoice-cell').length > 0) {
                const invoiceNumber = $(node).find('.invoice-number').text().trim();
                const invoiceKey = $(node).find('.invoice-key').text().trim();
                return invoiceNumber + '\n' + invoiceKey;
            }
            return decodeHtmlEntities(data);
        };

        const exportButtons = [
            // 'copy', 'excel', 'csv'
            // , 'pdf'
            // , 'print'
        ].map(type => ({
            extend: type,
            text: type == "copy"
                ? '<i class="fas fa-copy"></i>'
                : (type == "excel"
                    ? '<i class="fas fa-file-excel"></i>'
                    : (type == "csv"
                        ? '<i class="fas fa-file-csv"></i>'
                        : (type == "pdf"
                            ? '<i class="fas fa-file-pdf"></i>'
                            : (type == "print"
                                ? '<i class="fas fa-print"></i>'
                                : "")))),
            orientation: type === 'pdf' ? 'landscape' : undefined,
            exportOptions: {
                columns: function (index, node, column) {
                    const columnHeader = column.textContent.trim().toLowerCase();
                    return columnHeader !== 'action' && !$(node).find('.table-actions').length && !$(node).find('i.fas.fa-edit').length && !$(node).find('i.fas.fa-trash').length && !$(node).find('.deleteBtn').length && !$(node).find('.editBtn').length;
                },
                format: {body: formatBody(type)}
            }
        }));
        /** Initializing Datatable */
        // if ($('#companiesTable').length) {
        //     var table = $('#companiesTable').DataTable({
        //         dom:
        //             "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
        //             "<'row'<'col-sm-12 col-md-php6'l><'col-sm-12 col-md-6'f>>" +
        //             "<'row'<'col-sm-12'tr>>" +
        //             "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
        //         buttons: exportButtons,
        //         order: [[0, 'asc']],
        //         responsive: true,
        //         scrollX: true,
        //     });
        // }
        if ($('.initTable').length) {
            $('.initTable').each(function (index) {
                initializeDatatable($(this),index)
            })
        }
        function initializeDatatable(table_div,index){
            var table = table_div.DataTable({
                dom:
                // "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                buttons: exportButtons,
                order: [[1, 'asc']],
                responsive: false,
                scrollX: true,
                scrollY: 450,
                scrollCollapse: true,
                paging: true,
                columnDefs: [
                    {
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                fixedColumns: {
                    start: 2,
                    end: 1
                },
            });
            table.buttons().container().appendTo(`#right-icon-${index}`);
        }

    //Code Paste Here

        /** Edit */
        $(document).on('click', '.editBtn', function () {
            const id = $(this).data('id');
            if (!id) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Record not found. Do you want to reload the page?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Reload',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
            $('#manage-form')[0].reset();
            $.ajax({
                url: `{{route('brand.edit')}}/` + id,
                type: 'GET',
                success: function (data) {
                    setDataAndShowEdit(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });

        var $defaultImage;
        const $imageInput = $('#image'), $logoUrl = $('#logo_url'), $imageDisplay = $('#image-display'),
            $imageDiv = $('#image-div');

        const updateImage = (src) => {
            $imageDisplay.attr('src', src || $defaultImage);
            $imageDiv.toggle(!!src)
        };
        $imageInput.on('change', function () {
            const file = this.files[0];
            if (file) {
                updateImage(URL.createObjectURL(file));
                $logoUrl.val(null);
            } else {
                updateImage($logoUrl.val());
            }
        });
        $logoUrl.on('input', function () {
            if (!$imageInput.val()) updateImage($(this).val());
        });
        updateImage();

        function setDataAndShowEdit(data) {

            $('#manage-form').data('id', data.id);

            $('#brand_key').val(data.brand_key);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#description').val(data.description);
            $('#url').val(data.url);
            $('#status').val(data.status);
            if (data.logo) {
                var isValidUrl = data.logo.match(/^(https?:\/\/|\/|\.\/)/);
                if (isValidUrl) {
                    $logoUrl.val(data.logo);
                    $defaultImage = data.logo;
                    updateImage(data.logo)
                } else {
                    $logoUrl.val(`{{asset('assets/images/brand-logos/')}}/` + data.logo);
                    $defaultImage = `{{asset('assets/images/brand-logos/')}}/` + data.logo;
                    updateImage(`{{asset('assets/images/brand-logos/')}}/` + data.logo)
                }
                $imageDisplay.attr('alt', data.name);
                $imageDiv.show();
            }
            $('#manage-form').attr('action', `{{route('brand.update')}}/` + data.id);
            $('#formContainer').addClass('open')
        }
        const decodeHtml = (html) => {
            const txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        };
    });
</script>
