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

        const exportButtons = ['copy', 'excel', 'csv', 'pdf', 'print'].map(type => ({
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
                scrollY: 300,
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
                    start: 2
                },
            })
            table.buttons().container().appendTo(`#right-icon-${index}`);
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 300);

        }

    {{--    /** Create Record */--}}
    {{--    $('#create-form').on('submit', function (e) {--}}
    {{--        e.preventDefault();--}}
    {{--        AjaxRequestPromise('{{ route("company.store") }}', new FormData(this), 'POST', {useToastr: true})--}}
    {{--            .then(response => {--}}
    {{--                if (response?.data) {--}}
    {{--                    const {id, logo, name, special_key, url, status} = response.data;--}}
    {{--                    $('#create-modal').modal('hide');--}}
    {{--                    const logoUrl = isValidUrl(logo) ? logo : `{{ asset('assets/images/company-logos/') }}/${logo}`;--}}
    {{--                    const columns = [--}}
    {{--                        id,--}}
    {{--                        `<img src="${logoUrl}" alt="${name}" class="avatar avatar-sm me-3" title="${name}">`,--}}
    {{--                        special_key,--}}
    {{--                        name,--}}
    {{--                        url,--}}
    {{--                        `<input type="checkbox" class="status-toggle change-status" data-id="${id}" ${status == 1 ? "checked" : ""} data-bs-toggle="toggle">`,--}}
    {{--                        `<a href="javascript:void(0)" data-id="${id}" class="text-secondary editBtn" title="Edit company"><i class="fas fa-edit"></i></a>&nbsp;<a href="javascript:void(0)" class="text-secondary deleteBtn" data-id="${id}" title="Delete company"><i class="fas fa-trash"></i></a>`--}}
    {{--                    ];--}}
    {{--                    table.row.add($('<tr>', {id: `tr-${id}`}).append(columns.map(col => $('<td>').html(col)))).draw();--}}
    {{--                    $('#create-form')[0].reset();--}}
    {{--                }--}}
    {{--            })--}}
    {{--            .catch(error => console.log(error));--}}
    {{--    });--}}

    {{--    function setDataAndShowEditModel(data) {--}}
    {{--        $('#edit_name').val(data.name);--}}
    {{--        $('#edit_url').val(data.url);--}}
    {{--        $('#edit_email').val(data.email);--}}
    {{--        $('#edit_description').val(data.description);--}}
    {{--        $('#edit_status').val(data.status);--}}
    {{--        if (data.logo) {--}}
    {{--            var isValidUrl = data.logo.match(/^(https?:\/\/|\/|\.\/)/);--}}
    {{--            if (isValidUrl) {--}}
    {{--                $('#company-logo').attr('src', data.logo);--}}
    {{--            } else {--}}
    {{--                $('#company-logo').attr('src', `{{asset('assets/images/company-logos/')}}/` + data.logo);--}}
    {{--            }--}}
    {{--            $('#company-logo').attr('alt', data.name);--}}
    {{--            $('#company-logo').show();--}}
    {{--        }--}}

    {{--        $('#update-form').attr('action', `{{route('company.update')}}/` + data.id);--}}
    {{--        $('#edit-modal').modal('show');--}}
    {{--    }--}}

    {{--    /** Edit */--}}
    {{--    $(document).on('click', '.editBtn', function () {--}}
    {{--        const id = $(this).data('id');--}}
    {{--        if (!id) {--}}
    {{--            Swal.fire({--}}
    {{--                title: 'Error!',--}}
    {{--                text: 'Record not found. Do you want to reload the page?',--}}
    {{--                icon: 'error',--}}
    {{--                showCancelButton: true,--}}
    {{--                confirmButtonText: 'Reload',--}}
    {{--                cancelButtonText: 'Cancel'--}}
    {{--            }).then((result) => {--}}
    {{--                if (result.isConfirmed) {--}}
    {{--                    location.reload();--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}
    {{--        $('#update-form')[0].reset();--}}
    {{--        $.ajax({--}}
    {{--            url: `{{route('company.edit')}}/` + id,--}}
    {{--            type: 'GET',--}}
    {{--            success: function (data) {--}}
    {{--                setDataAndShowEditModel(data);--}}
    {{--            },--}}
    {{--            error: function () {--}}
    {{--                alert('Error fetching company data.');--}}
    {{--            }--}}
    {{--        });--}}
    {{--    });--}}

    {{--    /** Update Record */--}}
    {{--    $('#update-form').on('submit', function (e) {--}}
    {{--        e.preventDefault();--}}
    {{--        const url = $(this).attr('action');--}}
    {{--        AjaxRequestPromise(url, new FormData(this), 'POST', {useToastr: true})--}}
    {{--            .then(response => {--}}
    {{--                if (response?.data) {--}}
    {{--                    const {id, logo, name, special_key, url, status} = response.data;--}}
    {{--                    $('#edit-modal').modal('hide');--}}
    {{--                    const logoUrl = isValidUrl(logo) ? logo : `{{ asset('assets/images/company-logos/') }}/${logo}`;--}}
    {{--                    const columns = [--}}
    {{--                        id,--}}
    {{--                        `<img src="${logoUrl}" alt="${name}" class="avatar avatar-sm me-3" title="${name}">`,--}}
    {{--                        special_key,--}}
    {{--                        name,--}}
    {{--                        url,--}}
    {{--                        `<input type="checkbox" class="status-toggle change-status" data-id="${id}" ${status == 1 ? "checked" : ""} data-bs-toggle="toggle">`,--}}
    {{--                        `<a href="javascript:void(0)" data-id="${id}" class="text-secondary editBtn" title="Edit company"><i class="fas fa-edit"></i></a>&nbsp;<a href="javascript:void(0)" class="text-secondary deleteBtn" data-id="${id}" title="Delete company"><i class="fas fa-trash"></i></a>`--}}
    {{--                    ];--}}
    {{--                    table.row($('#tr-' + id)).data(columns).draw();--}}
    {{--                }--}}
    {{--            })--}}
    {{--            .catch(error => console.log('An error occurred while updating the record.'));--}}
    {{--    });--}}

    {{--    /** Change Status*/--}}
    {{--    $('.change-status').on('change', function () {--}}
    {{--        AjaxRequestPromise(`{{ route('company.change.status') }}/${$(this).data('id')}?status=${+$(this).is(':checked')}`, null, 'GET', {useToastr: true})--}}
    {{--            .then(response => {--}}
    {{--            })--}}
    {{--            .catch(() => alert('An error occurred'));--}}
    {{--    });--}}
    {{--    /** Delete Record */--}}
    {{--    $(document).on('click', '.deleteBtn', function () {--}}
    {{--        const id = $(this).data('id');--}}
    {{--        AjaxDeleteRequestPromise(`{{ route("company.delete", "") }}/${id}`, null, 'DELETE', {--}}
    {{--            useDeleteSwal: true,--}}
    {{--            useToastr: true,--}}
    {{--        })--}}
    {{--            .then(response => {--}}
    {{--                table.row(`#tr-${id}`).remove().draw();--}}
    {{--            })--}}
    {{--            .catch(error => {--}}
    {{--                Swal.fire('Error!', 'An error occurred while deleting the record.', 'error');--}}
    {{--                console.error('Error deleting record:', error);--}}
    {{--            });--}}
    {{--    });--}}
    {{--    @if (session()->get('edit_company') !== null)--}}
    {{--    const data = @json(session()->get('edit_company'));--}}
    {{--    setDataAndShowEditModel(data);--}}
    {{--    @endif--}}
    {{--    @php session()->forget('edit_company') @endphp--}}

    /** Edit */
    $(document).on('click', '.editBtn', function (e) {
        e.preventDefault();
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
            url: `{{route('invoice.edit')}}/` + id,
            type: 'GET',
            success: function (response) {
                setDataAndShowEdit(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }
        });
    });

        function setDataAndShowEdit(data) {
            const invoice = data?.invoice;

            $('#manage-form').data('id', invoice.id);
            $('#brand_key').val(invoice.brand_key);
            $('#team_key').val(invoice.team_key);
            $('#type').val(invoice.type).trigger('change');

            $('#customer_contact_name').val(invoice.customer_contact?.name);
            $('#customer_contact_email').val(invoice.customer_contact?.email);
            $('#customer_contact_phone').val(invoice.customer_contact?.phone);
            $('#cus_contact_key').val(invoice.customer_contact?.special_key);
            $('#agent_id').val(invoice.agent_id);
            $('#due_date').val(invoice.due_date);
            $('#amount').val(invoice.amount);
            $('#total_amount').val(invoice.total_amount);
            $('#description').val(invoice.description);
            $('#status').val(invoice.status);

            $('#manage-form').attr('action', `{{route('invoice.update')}}/` + invoice.id);
            $('#formContainer').addClass('open');
        }

        const decodeHtml = (html) => {
            const txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        };

        /** Manage Record */
        $('#manage-form').on('submit', function (e) {
            e.preventDefault();
            var dataId = $('#manage-form').data('id');
            var formData = new FormData(this);
            if (!dataId) {
                AjaxRequestPromise(`{{ route("invoice.store") }}`, formData, 'POST', {useToastr: true})
                    .then(response => {
                        if (response?.data) {
                            const {id, invoice_number, invoice_key, brand, team, customer_contact, agent, amount, status, date} = response.data;
                            const index = table.rows().count() + 1;
                            const columns = `
                        <td class="align-middle text-center text-nowrap"></td>
                        <td class="align-middle text-center text-nowrap">${index}</td>
                        <td class="align-middle text-center text-nowrap text-sm invoice-cell">
                                                    <span class="invoice-number">${invoice_number }</span><br>
                                                    <span class="invoice-key">${invoice_key }</span>
                                                </td>
                        <td class="align-middle text-center text-nowrap">
                            ${brand ? `<a href="">${brand.name}</a><br> ${brand.brand_key}` : '---'}
                        </td>
                        <td class="align-middle text-center text-nowrap">${team ? `<a href="">${team.name}</a><br> ${team.team_key}` : '---'}</td>
                        <td class="align-middle text-center text-nowrap">${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}</td>
                        <td class="align-middle text-center text-nowrap">${agent ? `<a href="">${agent.name}</a>` : '---'}</td>
                        <td class="align-middle text-center text-nowrap">${amount}</td>
                        <td class="align-middle text-center text-nowrap">
                            ${status == 0 ? '<span class="badge bg-warning text-dark">Due</span>' : status == 1 ? '<span class="badge bg-success">Paid</span>' : status == 2 ? '<span class="badge bg-danger">Refund</span>' : ''}
                        </td>
                        <td class="align-middle text-center text-nowrap">${date}</td>
                        <td class="align-middle text-center table-actions">
                            <button type="button" class="btn btn-sm btn-primary editBtn" data-id="${id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="${id}" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>`;

                            table.row.add($('<tr>', {id: `tr-${id}`}).append(columns)).draw(false);

                            $('#manage-form')[0].reset();
                            $('#formContainer').removeClass('open');
                        }
                    })
                    .catch(error => console.log('An error occurred while updating the record.', error));
            } else {
                const url = $(this).attr('action');
                AjaxRequestPromise(url, formData, 'POST', {useToastr: true})
                    .then(response => {
                        if (response?.data) {
                            const {id, invoice_number, invoice_key, brand, team, customer_contact, agent, amount, status, date} = response.data;
                            const index = table.row($('#tr-' + id)).index();
                            const rowData = table.row(index).data();

                            // Update columns in the table dynamically
                            // Column 3: Invoice Number & Invoice Key
                            if (decodeHtml(rowData[2]) !== `${invoice_number}<br>${invoice_key}`) {
                                table.cell(index, 2).data(`
                                    <span class="invoice-number">${invoice_number}</span><br>
                                    <span class="invoice-key">${invoice_key}</span>
                                `).draw();
                            }

                            // Column 4: Brand
                            if (decodeHtml(rowData[3]) !== `${brand ? `<a href="">${brand.name}</a><br> ${brand.brand_key}` : '---'}`) {
                                table.cell(index, 3).data(`${brand ? `<a href="">${brand.name}</a><br> ${brand.brand_key}` : '---'}`).draw();
                            }

                            // Column 5: Team
                            if (decodeHtml(rowData[4]) !== `${team ? `<a href="">${team.name}</a><br> ${team.team_key}` : '---'}`) {
                                table.cell(index, 4).data(`${team ? `<a href="">${team.name}</a><br> ${team.team_key}` : '---'}`).draw();
                            }

                            // Column 6: Customer Contact
                            if (decodeHtml(rowData[5]) !== `${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}`) {
                                table.cell(index, 5).data(`${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}`).draw();
                            }

                            // Column 7: Agent
                            if (decodeHtml(rowData[6]) !== `${agent ? `<a href="">${agent.name}</a>` : '---'}`) {
                                table.cell(index, 6).data(`${agent ? `<a href="">${agent.name}</a>` : '---'}`).draw();
                            }

                            // Column 8: Amount
                            if (decodeHtml(rowData[7]) !== amount) {
                                table.cell(index, 7).data(amount).draw();
                            }
                            // Column 9: Status

                            const statusHtml = status == 0 ? '<span class="badge bg-warning text-dark">Due</span>' : status == 1 ? '<span class="badge bg-success">Paid</span>' : status == 2 ? '<span class="badge bg-danger">Refund</span>' : '';
                            if (decodeHtml(rowData[8]) !== statusHtml) {
                                table.cell(index, 8).data(statusHtml).draw();
                            }

                            // Column 10: Date
                            if (decodeHtml(rowData[9]) !== date) {
                                table.cell(index, 9).data(date).draw();
                            }
                            $('#manage-form')[0].reset();
                            $('#formContainer').removeClass('open')
                        }
                    })
                    .catch(error => console.log(error));
            }
        });
    });
</script>
