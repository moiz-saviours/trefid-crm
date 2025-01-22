<script>
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
                url: `{{route('admin.payment.edit')}}/` + id,
                type: 'GET',
                success: function (response) {
                    setDataAndShowEdit(response);
                },
                error: function () {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });



        function setDataAndShowEdit(data) {
            let payment = data.payment;
            $('#manage-form').data('id', payment.id);

            $('#brand_key').val(payment.brand_key);
            $('#team_key').val(payment.team_key);
            $('#agent_id').val(payment.agent_id);
            $('#payment_type').val(payment.payment_type).trigger('change');
            $('#address').val(payment.address);
            $('#customer_contact_name').val(payment.customer_contact?.name);
            $('#customer_contact_email').val(payment.customer_contact?.email);
            $('#customer_contact_phone').val(payment.customer_contact?.phone);
            $('#cus_contact_key').val(payment.customer_contact?.special_key);
            $('#amount').val(payment.amount);
            $('#description').val(payment.description);
            $('#payment_method').val(payment.payment_method);
            $('#transaction_id').val(payment.transaction_id);



            $('#manage-form').attr('action', `{{route('admin.payment.update')}}/` + payment.id);
            $('#formContainer').addClass('open')
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
                AjaxRequestPromise(`{{ route("admin.payment.store") }}`, formData, 'POST', {useToastr: true})
                    .then(response => {
                        if (response?.data) {
                            const {id, brand_key, team_key, agent_id, payment_type, client_name, client_email,client_phone,address,client_key,amount,description,payment_method,transaction_id} = response.data;
                            const index = table.rows().count() + 1;
                            const columns = `
                                <td class="align-middle text-center text-nowrap"></td>
                                <td class="align-middle text-center text-nowrap">${index}</td>
                                <td class="align-middle text-center text-nowrap">${brand_key}</td>
                                <td class="align-middle text-center text-nowrap">${team_key}</td>
                                <td class="align-middle text-center text-nowrap">${agent_id}</td>
                                <td class="align-middle text-center text-nowrap">${payment_type}</td>
                                <td class="align-middle text-center text-nowrap">${client_name}</td>
                                <td class="align-middle text-center text-nowrap">${client_email}</td>
                                <td class="align-middle text-center text-nowrap">${client_phone}</td>
                                <td class="align-middle text-center text-nowrap">${address}</td>
                                <td class="align-middle text-center text-nowrap">${client_key}</td>
                                <td class="align-middle text-center text-nowrap">${amount}</td>
                                <td class="align-middle text-center text-nowrap">${description}</td>
                                <td class="align-middle text-center text-nowrap">${payment_method}</td>
                                <td class="align-middle text-center text-nowrap">${transaction_id}</td>

                                <td class="align-middle text-center text-nowrap">
                                    <input type="checkbox" class="status-toggle change-status" data-id="${id}" ${status == 1 ? 'checked' : ''} data-bs-toggle="toggle">
                                </td>
                                <td class="align-middle text-center table-actions">
                                    <button type="button" class="btn btn-sm btn-primary editBtn" data-id="${id}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="${id}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                        `;
                            table.row.add($('<tr>', {id: `tr-${id}`}).append(columns)).draw(false);
                            $('#manage-form')[0].reset();
                            $('#formContainer').removeClass('open')
                        }
                    })
                    .catch(error => console.log('An error occurred while updating the record.'));
            } else {
                const url = $(this).attr('action');
                AjaxRequestPromise(url, formData, 'POST', {useToastr: true})
                    .then(response => {
                        if (response?.data) {
                            const {id, image, name, email, designation, team_name, status} = response.data;
                            const imageUrl = isValidUrl(image) ? image : (image ? `{{ asset('assets/images/employees/') }}/${image}` : `{{ asset("assets/images/no-image-available.png") }}`);
                            const index = table.row($('#tr-' + id)).index();
                            const rowData = table.row(index).data();
                            // Column 2: Image
                            const imageHtml = imageUrl ? `<object data="${imageUrl}" class="avatar avatar-sm me-3" title="${name}"><img src="${imageUrl}" alt="${name}" class="avatar avatar-sm me-3" title="${name}"></object>` : '';
                            if (decodeHtml(rowData[2]) !== imageHtml) {
                                table.cell(index, 2).data(imageUrl ? `<object data="${imageUrl}" class="avatar avatar-sm me-3" title="${name}">
                                                            <img src="${imageUrl}" alt="${name}" class="avatar avatar-sm me-3" title="${name}">
                                                        </object>` : '').draw();
                            }
                            /** Column 3: Name */
                            if (decodeHtml(rowData[3]) !== name) {
                                table.cell(index, 3).data(name).draw();
                            }
                            // Column 4: Email
                            if (decodeHtml(rowData[4]) !== email) {
                                table.cell(index, 4).data(email).draw();
                            }
                            // Column 5: Designation
                            if (decodeHtml(rowData[5]) !== designation) {
                                table.cell(index, 5).data(designation).draw();
                            }
                            // Column 6: Team
                            if (decodeHtml(rowData[6]) !== team_name) {
                                table.cell(index, 6).data(team_name).draw();
                            }
                            // Column 7: Status
                            const statusHtml = `<input type="checkbox" class="status-toggle change-status" data-id="${id}" ${status == 1 ? "checked" : ""} data-bs-toggle="toggle">`;
                            if (decodeHtml(rowData[7]) !== statusHtml) {
                                table.cell(index, 7).data(statusHtml).draw();
                            }
                            $('#manage-form')[0].reset();
                            $('#image-display').attr('src', null);
                            $('#formContainer').removeClass('open')
                        }
                    })
                    .catch(error => console.log(error));
            }
        });


    });
</script>
