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

<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.10.25/extensions/Editor/js/dataTables.editor.min.js"></script>

<!-- New -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Jquery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- End Jquery UI -->

<!-- Toaster -->
<script src="{{asset('build/toaster/js/toastr.min.js')}}"></script>

<script>
    // Toastr options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "3000", // 5 seconds
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if(session('success'))
    setTimeout(function () {
        toastr.success("{{ session('success') }}");
    }, 1500);
    @php session()->forget('success'); @endphp
    @endif

    // Display error messages (multiple)
    @if(session('errors') && session('errors')->any())
    let errorMessages = {!! json_encode(session('errors')->all()) !!};
    let displayedCount = 0;

    setTimeout(function () {
        errorMessages.forEach((message, index) => {
            if (displayedCount < 5) {
                toastr.error(message);
                displayedCount++;
            } else {
                setTimeout(() => toastr.error(message), index * 1000);
            }
        });
    }, 1500);

    @php session()->forget('errors'); @endphp
    @endif
</script>


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

<script>
    function refreshCsrfToken() {
        return $.get('{{route('csrf.token')}}').then(response => {
            $('meta[name="csrf-token"]').attr('content', response.token);
        });
    }

    function AjaxDeleteRequestPromise(url, data, method = 'DELETE', options = {}) {
        method = method.toUpperCase();
        options = {
            useDeleteSwal: false, /* * Show SweetAlert confirmation for delete */
            deleteSwalMessage: 'This action cannot be undone.',
            ...options
        };
        if (options.useDeleteSwal && method === 'DELETE') {
            return Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: options.deleteSwalMessage,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    cancelButton: 'swal2-left-button',
                    confirmButton: 'swal2-right-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    return AjaxRequestPromise(url, data, method, options).then(response => {
                        return {isConfirmed: true, response: response};
                    });
                }
                return Promise.reject({isConfirmed: false, message: 'Phew! The delete action was saved.'});
            });
        } else {
            return AjaxRequestPromise(url, data, method, options);
        }
    }

    function AjaxRequestPromise(url, data, method = 'GET', options = {}) {
        method = method.toUpperCase();
        options = {
            useReload: false, /* * Reload the page after success */
            useRedirect: false, /* * Redirect to another page after success */
            redirectLocation: '', /* * Location to redirect to */
            useSwal: false, /* * Show SweetAlert notification */
            title: 'Success', /* * Title for SweetAlert */
            showConfirmButton: true, /* * Display confirm button in SweetAlert */
            confirmButtonText: 'OK', /* * Confirm button text in SweetAlert */
            cancelButtonText: 'Reload', /* * Cancel button text in SweetAlert */
            useSwalReload: false, /* * Reload the page if SweetAlert is confirmed */
            icon: 'success', /* * SweetAlert & toastr icon: 'success', 'error', 'warning', 'info' */
            useToastr: false, /* * Show toastr notification */
            message: 'Request was successful.', /* * Message text for toastr & SweetAlert*/
            useToastrReload: false, /* * Reload the page after toastr notification */
            ...options /* * Use provided options if any */
        };
        if (method === 'GET' && data && Object.keys(data).length > 0) {
            const queryString = $.param(data);
            url = `${url}?${queryString}`;
        }
        return new Promise((resolve, reject) => {
            $('form').find('.is-invalid').removeClass('is-invalid');
            $('form').find('.text-danger').fadeOut();
            $.ajax({
                url: url,
                type: method,
                data: method === 'GET' ? null : data,
                processData: method === 'GET',
                contentType: method === 'GET' ? 'application/x-www-form-urlencoded' : false,
                headers: method === 'GET' ? {} : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    // $('#loading').show();
                },
                success: function (response) {
                    const message = response.message || response.success || options.message || 'Request was successful.';

                    if (options.useSwal) {
                        Swal.fire({
                            icon: options.icon,
                            title: options.title,
                            text: message,
                            confirmButtonText: options.showConfirmButton ? options.confirmButtonText : null,
                            showConfirmButton: options.showConfirmButton,
                            cancelButtonText: options.useSwalReload ? options.cancelButtonText : null,
                            showCancelButton: options.useSwalReload,
                            focusConfirm: false,
                            customClass: {
                                cancelButton: 'swal2-left-button',
                                confirmButton: 'swal2-right-button'
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (options.useRedirect && options.redirectLocation) {
                                    window.location.href = options.redirectLocation;
                                }
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                if (options.useSwalReload) {
                                    location.reload();
                                }
                            }
                        });
                    }

                    /** Toastr notification */
                    if (options.useToastr) {
                        toastr[options.icon](message);
                        if (options.useToastrReload) {
                            setTimeout(() => location.reload(), 5000);
                        } else if (options.useRedirect && options.redirectLocation) {
                            setTimeout(() => window.location.href = options.redirectLocation, 5000);
                        }
                    }

                    /** Handle redirection or page reload */
                    if (!options.useSwal && !options.useToastr) {
                        if (options.useReload) {
                            location.reload();
                        } else if (options.useRedirect && options.redirectLocation) {
                            window.location.href = options.redirectLocation;
                        }
                    }
                    resolve(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    const response = jqXHR.responseJSON;
                    const message = response?.message || response?.error || errorThrown || 'Something went wrong. Please try again.';
                    if (jqXHR.status === 419 || message.includes("CSRF token mismatch")) {
                        return refreshCsrfToken().then(() => {
                            return AjaxRequestPromise(url, data, method, options);
                        }).catch(() => {
                            console.log("Failed to refresh CSRF token. Please try again.");
                            reject(textStatus);
                        });
                    }
                    if (jqXHR.status === 422 && response && response.errors) {
                        const isUpdate = url.includes('update');

                        for (let field in response.errors) {
                            const fieldWithPrefix = isUpdate ? `#edit_${field}` : `#${field}`;

                            const errorMessages = response.errors[field];
                            errorMessages.forEach(message => {
                                $(fieldWithPrefix).after(`<span class="text-danger">${message}</span>`);
                            });

                            $(fieldWithPrefix).addClass('is-invalid');

                            setTimeout(function () {
                                $(fieldWithPrefix).removeClass('is-invalid');
                                $(fieldWithPrefix).siblings('.text-danger').fadeOut();
                            }, 5000);
                        }
                    }
                    /** Show generic error with SweetAlert */
                    if (options.useSwal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: message,
                            confirmButtonText: options.showConfirmButton ? options.confirmButtonText : null,
                            showConfirmButton: options.showConfirmButton,
                            cancelButtonText: options.useSwalReload ? options.cancelButtonText : null,
                            showCancelButton: options.useSwalReload,
                            focusConfirm: false,
                            customClass: {
                                cancelButton: 'swal2-left-button',
                                confirmButton: 'swal2-right-button'
                            },
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (options.useRedirect && options.redirectLocation) {
                                    window.location.href = options.redirectLocation;
                                }
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                if (options.useSwalReload) {
                                    location.reload();
                                }
                            }
                        });
                    }
                    /** Show generic error with toastr */
                    if (options.useToastr) {
                        toastr['error'](message);
                        if (options.useToastrReload) {
                            setTimeout(() => location.reload(), 5000);
                        } else if (options.useRedirect && options.redirectLocation) {
                            setTimeout(() => window.location.href = options.redirectLocation, 5000);
                        }
                    }

                    reject(textStatus);
                },
                complete: function () {
                    $(".modal").modal('hide');
                    $('#formContainer').removeClass('open');
                    // $('#loading').hide();
                }
            });
        });
    }
</script>

<script>
    $(document).ready(function () {
        const formContainer = $('#formContainer');
        const manageForm = $('#manage-form');

        if (formContainer.length > 0) {
            $('.open-form-btn , .editBtn').click(function () {
                $(this).hasClass('void') ? $(this).attr('title', "You don't have access to create a company.").tooltip({placement: 'bottom'}).tooltip('show') : (formContainer.addClass('open'));
            });
        } else {
            // console.warn('#formContainer does not exist.');
        }
        $(document).on('click', function (event) {
            if ((!$(event.target).closest('#formContainer').length && !$(event.target).is('#formContainer') && !$(event.target).closest('.open-form-btn').length && !$(event.target).is('.editBtn')) || $(event.target).is('#formContainer .close-btn')) {
                formContainer.removeClass('open')
                if (manageForm.length > 0) {
                    manageForm[0].reset();
                    manageForm.removeData('id');

                }
            }
        });
        $(".tab-item").on("click", function () {
            $(".tab-item").removeClass("active");
            $(".tab-pane").removeClass("active");

            $(this).addClass("active");

            const targetPane = $(this).data("tab");
            $("#" + targetPane).addClass("active");
        });
    });
</script>
