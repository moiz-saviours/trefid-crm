<script>
    <!---- SCRIPT BLADE----->
    $(document).ready(function () {
        console.log('Document ready fired');
    });

    $(document).ready(function () {
        /** Valid Url */
        function isValidUrl(url) {
            try {
                new URL(url);
                return true;
            } catch (_) {
                return false;
            }
        }

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
        const exportButtons = ['copy', 'excel', 'csv'
            // , 'pdf'
            , 'print'].map(type => ({
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
        if ($('.initTable').length) {
            $('.initTable').each(function (index) {
                initializeDatatable($(this), index)
            })
        }
        var table;

        function initializeDatatable(table_div, index) {
            console.log(`Initializing table: ${table_div.attr('id')} - Instance: ${index}`);
            if ($.fn.DataTable.isDataTable(table_div)) {
                table_div.DataTable().destroy();
            }
            table = table_div.DataTable({
                dom:
                // "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                buttons: exportButtons,
                order: [[1, 'desc']],
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
                    start: 0
                },
            });
            table.buttons().container().appendTo(`#right-icon-${index}`);
        }

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
                url: `{{route('admin.invoice.edit')}}/` + id,
                type: 'GET',
                success: function (response) {
                    setDataAndShowEdit(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });


        function updateTotalAmount() {
            const amount = parseFloat($('#amount').val());
            const taxAmount = parseFloat($('#tax_amount').val()) || 0;
            const totalAmount = amount + taxAmount;

            $('#total_amount').val(totalAmount.toFixed(2));
        }

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

            $('#taxable').prop('checked', invoice.taxable);
            if (invoice.taxable) {
                $('#tax-fields').slideDown();
                $('#tax_type').val(invoice.tax_type);
                $('#tax_value').val(invoice.tax_value);
                $('#tax_amount').val((parseFloat(invoice.tax_amount) || 0).toFixed(2));
            } else {
                $('#tax-fields').slideUp();
                $('#tax_type').val('');
                $('#tax_value').val('');
                $('#tax_amount').val(0);
            }

            updateTotalAmount();

            $('#manage-form').attr('action', `{{route('admin.invoice.update')}}/` + invoice.id);
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
                AjaxRequestPromise(`{{ route("admin.invoice.store") }}`, formData, 'POST', {useToastr: true})
                    .then(response => {
                        if (response?.data) {
                            const {
                                id,
                                invoice_number,
                                invoice_key,
                                brand,
                                team,
                                customer_contact,
                                agent,
                                amount,
                                tax_type,
                                tax_value,
                                tax_amount,
                                total_amount,
                                currency,
                                status,
                                due_date,
                                date
                            } = response.data;

                            const index = table.rows().count() + 1;
                            const columns = `
                        <td class="align-middle text-center text-nowrap"></td>
                        <td class="align-middle text-center text-nowrap">${index}</td>
                        <td class="align-middle text-center text-nowrap text-sm invoice-cell">
                            <span class="invoice-number">${invoice_number}</span><br>
                            <span class="invoice-key">${invoice_key}</span>
                        </td>
                        <td class="align-middle text-center text-nowrap">
                            ${brand ? `<a href="{{route('admin.brand.index')}}">${brand.name}</a><br> ${brand.brand_key}` : '---'}
                        </td>
                        <td class="align-middle text-center text-nowrap">${team ? `<a href="{{route('admin.team.index')}}">${team.name}</a><br> ${team.team_key}` : '---'}</td>
                        <td class="align-middle text-center text-nowrap">${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}</td>
                        <td class="align-middle text-center text-nowrap">${agent ? `<a href="{{route('admin.employee.index')}}">${agent.name}</a>` : '---'}</td>
                        <td class="align-middle space-between text-nowrap" style="text-align: left;">
                            <div style="display: flex; justify-content: space-between; gap: 10px;">
                                <span style="width: 120px;">Amount:</span>
                                <span>${currency} ${parseFloat(amount).toFixed(2)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; gap: 10px;">
                                <span style="width: 120px;">Tax:</span>
                                <span>${tax_type === 'percentage' ? '%' : (tax_type === 'fixed' ? currency : '')} ${tax_value??0}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; gap: 10px;">
                                <span style="width: 120px;">Tax Amount:</span>
                                <span>${currency} ${parseFloat(tax_amount).toFixed(2)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; gap: 10px;">
                                <span style="width: 120px;">Total Amount:</span>
                                <span>${currency} ${parseFloat(total_amount).toFixed(2)}</span>
                            </div>
                        </td>
                        <td class="align-middle text-center text-nowrap">
                            ${status == 0 ? '<span class="badge bg-warning text-dark">Due</span>' : status == 1 ? '<span class="badge bg-success">Paid</span>' : status == 2 ? '<span class="badge bg-danger">Refund</span>' : ''}
                        </td>
                        <td class="align-middle text-center text-nowrap">${date}</td>
                        <td class="align-middle text-center text-nowrap">${due_date}</td>
                        <td class="align-middle text-center table-actions">
                            ${status != 1 ? '<button type="button" class="btn btn-sm btn-primary editBtn" data-id="'+id+'" title="Edit"><i class = "fas fa-edit" > </i></button>' +
                                '<button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="'+id+'" title="Delete"><i class="fas fa-trash"></i></button>'
                                : ''}
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
                            const {
                                id,
                                invoice_number,
                                invoice_key,
                                brand,
                                team,
                                customer_contact,
                                agent,
                                amount, tax_type, tax_value,
                                tax_amount, total_amount, currency,
                                status,
                                due_date,
                                date
                            } = response.data;
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
                            if (decodeHtml(rowData[3]) !== `${brand ? `<a href="{{route('admin.brand.index')}}">${brand.name}</a><br> ${brand.brand_key}` : '---'}`) {
                                table.cell(index, 3).data(`${brand ? `<a href="{{route('admin.brand.index')}}">${brand.name}</a><br> ${brand.brand_key}` : '---'}`).draw();
                            }

                            // Column 5: Team
                            if (decodeHtml(rowData[4]) !== `${team ? `<a href="{{route('admin.team.index')}}">${team.name}</a><br> ${team.team_key}` : '---'}`) {
                                table.cell(index, 4).data(`${team ? `<a href="{{route('admin.team.index')}}">${team.name}</a><br> ${team.team_key}` : '---'}`).draw();
                            }

                            // Column 6: Customer Contact
                            if (decodeHtml(rowData[5]) !== `${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}`) {
                                table.cell(index, 5).data(`${customer_contact ? `<a href="/admin/contact/edit/${customer_contact.id}">${customer_contact.name}</a>` : '---'}`).draw();
                            }
                            // Column 7: Agent
                            if (decodeHtml(rowData[6]) !== `${agent ? `<a href="{{route('admin.employee.index')}}">${agent.name}</a>` : '---'}`) {
                                table.cell(index, 6).data(`${agent ? `<a href="{{route('admin.employee.index')}}">${agent.name}</a>` : '---'}`).draw();
                            }

                            const newContent = `
                                <div style="display: flex; justify-content: space-between; gap: 10px;">
                                    <span style="width: 120px;">Amount:</span>
                                    <span>${currency} ${parseFloat(amount).toFixed(2)}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; gap: 10px;">
                                    <span style="width: 120px;">Tax:</span>
                                    <span>${tax_type === 'percentage' ? '%' : (tax_type === 'fixed' ? currency : '')} ${tax_value??0}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; gap: 10px;">
                                    <span style="width: 120px;">Tax Amount:</span>
                                    <span>${currency} ${parseFloat(tax_amount).toFixed(2)}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; gap: 10px;">
                                    <span style="width: 120px;">Total Amount:</span>
                                    <span>${currency} ${parseFloat(total_amount).toFixed(2)}</span>
                                </div>`;
                            // Column 8: Amount
                            if (decodeHtml(rowData[7]) !== newContent) {
                                table.cell(index, 7).data(newContent).draw();
                            }

                            // Column 9: Status

                            const statusHtml = status == 0 ? '<span class="badge bg-warning text-dark">Due</span>' : status == 1 ? '<span class="badge bg-success">Paid</span>' : status == 2 ? '<span class="badge bg-danger">Refund</span>' : '';
                            if (decodeHtml(rowData[8]) !== statusHtml) {
                                table.cell(index, 8).data(statusHtml).draw();
                            }

                            // Column 10: Date
                            if (decodeHtml(rowData[9]) !== due_date) {
                                table.cell(index, 9).data(due_date).draw();
                            }
                            // Column 11: Date
                            if (decodeHtml(rowData[10]) !== date) {
                                table.cell(index, 10).data(date).draw();
                            }
                            $('#manage-form')[0].reset();
                            $('#formContainer').removeClass('open')
                        }
                    })
                    .catch(error => console.log(error));
            }
        });

        /** Delete Record */
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            AjaxDeleteRequestPromise(`{{ route("admin.invoice.delete", "") }}/${id}`, null, 'DELETE', {
                useDeleteSwal: true,
                useToastr: true,
            })
                .then(response => {
                    table.row(`#tr-${id}`).remove().draw();
                })
                .catch(error => {
                    if (error.isConfirmed === false) {
                        Swal.fire({
                            title: 'Action Canceled',
                            text: error?.message || 'The deletion has been canceled.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                        console.error('Record deletion was canceled:', error?.message);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while deleting the record.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                        console.error('An error occurred while deleting the record:', error);
                    }
                });
        });
    });
</script>
