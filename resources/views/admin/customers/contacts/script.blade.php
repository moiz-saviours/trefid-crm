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
                    start: 0,
                    end: 0
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
                    url: `{{route('admin.customer.contact.edit')}}/` + id,
                    type: 'GET',
                    success: function (data) {
                        setDataAndShowEdit(data);
                    },
                    error: function () {
                        alert('Error fetching data.');
                    }
                });
            });

            const decodeHtml = (html) => {
                const txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            };

            function setDataAndShowEdit(data) {
                let client = data?.client;
                $('#manage-form').data('id', client.id);
                $('#brand_key').val(client.brand_key);
                $('#team_key').val(client.team_key);
                $('#name').val(client.name);
                $('#email').val(client.email);
                $('#phone').val(client.phone);
                $('#address').val(client.address);
                $('#city').val(client.city);
                $('#state').val(client.state);
                $('#country').val(client.country);
                $('#zipcode').val(client.zipcode);
                $('#status').val(client.status);

                $('#manage-form').attr('action', `{{route('admin.customer.contact.update')}}/` + client.id);
                $('#formContainer').addClass('open')
            }


            /** Manage Record */
            $('#manage-form').on('submit', function (e) {
                e.preventDefault();
                var dataId = $('#manage-form').data('id');
                var formData = new FormData(this);
                if (!dataId) {
                    AjaxRequestPromise(`{{ route("admin.customer.contact.store") }}`, formData, 'POST', {useToastr: true})
                        .then(response => {
                            if (response?.data) {
                                const {id, brand_key, team_key, name, email, phone,address,city,state,status,country,zipcode } = response.data;
                                const index = table.rows().count() + 1;
                                const columns = `
                                    <td class="align-middle text-center text-nowrap"></td>
                                    <td class="align-middle text-center text-nowrap">${index}</td>

                                    <td class="align-middle text-center text-nowrap">${brand_key}</td>
                                    <td class="align-middle text-center text-nowrap">${team_key}</td>
                                    <td class="align-middle text-center text-nowrap">${name}</td>
                                    <td class="align-middle text-center text-nowrap">${email}</td>
                                    <td class="align-middle text-center text-nowrap">${phone}</td>
                                    <td class="align-middle text-center text-nowrap">${address}</td>
                                    <td class="align-middle text-center text-nowrap">${city}</td>
                                    <td class="align-middle text-center text-nowrap">${state}</td>


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
                                const {id, brand_key, team_key, name, email, phone,address,city,state,status } = response.data;
                                const index = table.row($('#tr-' + id)).index();
                                const rowData = table.row(index).data();
                                // Column 2: Brand
                                if (decodeHtml(rowData[2]) !== brand_key) {
                                    table.cell(index, 2).data(brand_key).draw();
                                }
                                /** Column 3: Team */
                                if (decodeHtml(rowData[3]) !== team_key) {
                                    table.cell(index, 3).data(team_key).draw();
                                }
                                // Column 4: name
                                if (decodeHtml(rowData[4]) !== name) {
                                    table.cell(index, 4).data(name).draw();
                                }
                                // Column 5: email
                                if (decodeHtml(rowData[5]) !== email) {
                                    table.cell(index, 5).data(email).draw();
                                }
                                // Column 6: phone
                                if (decodeHtml(rowData[6]) !== phone) {
                                    table.cell(index, 6).data(phone).draw();
                                }
                                // Column 7: address
                                if (decodeHtml(rowData[7]) !== address) {
                                    table.cell(index, 7).data(address).draw();
                                }

                                // Column 8: city
                                if (decodeHtml(rowData[8]) !== city) {
                                    table.cell(index, 8).data(city).draw();
                                }
                                // Column 9: state
                                if (decodeHtml(rowData[9]) !== state) {
                                    table.cell(index, 9).data(state).draw();
                                }

                                // Column 10: Status
                                const statusHtml = `<input type="checkbox" class="status-toggle change-status" data-id="${id}" ${status == 1 ? "checked" : ""} data-bs-toggle="toggle">`;
                                if (decodeHtml(rowData[10]) !== statusHtml) {
                                    table.cell(index, 10).data(statusHtml).draw();
                                }


                                $('#manage-form')[0].reset();
                                $('#formContainer').removeClass('open')
                            }
                        })
                        .catch(error => console.log(error));
                }
            });
        /** Change Status*/
        $('tbody').on('change', '.change-status', function () {
            const statusCheckbox = $(this);
            const status = +statusCheckbox.is(':checked');
            const rowId = statusCheckbox.data('id');
            AjaxRequestPromise(`{{ route('admin.customer.contact.change.status') }}/${rowId}?status=${status}`, null, 'GET', {useToastr: true})
                .then(response => {
                    const rowIndex = table.row($('#tr-' + rowId)).index();
                    const statusHtml = `<input type="checkbox" class="status-toggle change-status" data-id="${rowId}" ${status ? "checked" : ""} data-bs-toggle="toggle">`;
                    table.cell(rowIndex, 10).data(statusHtml).draw();
                })
                .catch(() => {
                    statusCheckbox.prop('checked', !status);
                });
        });
        /** Delete Record */
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            AjaxDeleteRequestPromise(`{{ route("admin.customer.contact.delete", "") }}/${id}`, null, 'DELETE', {
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
