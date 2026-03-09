@extends('admin.layouts.app')

@section('content')

<style>
    /* ================= TABLE FONT SIZE ================= */
    #orderTable,
    #orderTable th,
    #orderTable td {
        font-size: 12px !important;
    }

    /* ================= HEADER & CELLS ================= */
    #orderTable th,
    #orderTable td {
        padding: 6px 8px !important;
        white-space: nowrap;
        text-align: center;
    }

    /* ================= BUTTON ================= */
    #orderTable .btn {
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 5px;
    }

    /* ================= BADGE ================= */
    #orderTable .badge {
        font-size: 10px;
        padding: 4px 8px;
        border-radius: 10px;
    }

    /* ================= SEARCH ================= */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        padding: 5px 10px;
    }

    /* ================= RESPONSIVE CHILD ROW ================= */
    table.dataTable>tbody>tr.child td {
        background: #f9fafb;
        text-align: left;
        padding-left: 2rem;
    }

    /* ================= TABLE WRAPPER ================= */
    .table-card {
        background: #fff;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .06);
    }
</style>

<section class="form-sec mt-3">
    <div class="container-fluid">
        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap"
                    id="orderTable"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>S.No</th>
                            <th>Action</th>
                            <th>Order Id</th>
                            <th>Customer Name</th>
                            <th>Product Name</th>
                            <th>Discount</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- ================= ORDER STATUS MODAL ================= -->
<div class="modal fade" id="orderStatusModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-box-seam me-2"></i> Update Order Status
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                <input type="hidden" id="order_id">

                <!-- CUSTOMER INFO -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="bi bi-person-circle me-1"></i> Customer Details
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer_name" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="customer_email" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="customer_phone" readonly>
                        </div>
                    </div>
                </div>

                <!-- ADDRESS -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3 border-bottom pb-2">
                        <i class="bi bi-geo-alt me-1"></i> Shipping Address
                    </h6>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" id="customer_address" rows="2" readonly></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" id="customer_city" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="customer_pincode" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <hr>
                <!-- ORDER STATUS -->
                <div class="p-3 rounded-3 bg-light border border-success shadow-sm">
                    <h6 class="text-success mb-3 border-bottom pb-2 fw-semibold">
                        <i class="bi bi-clipboard-check me-1"></i> Order Status
                    </h6>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select border-success" id="order_status">
                            <option value="1">Pending</option>
                            <option value="3">Confirm</option>
                            <option value="2">Delivered</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer bg-light">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Close
                </button>
                <button class="btn btn-success" id="updateStatusBtn">
                    <i class="bi bi-check-circle me-1"></i> Update Status
                </button>
            </div>

        </div>
    </div>
</div>


@endsection

@push('scripts')

{{-- ================= DATATABLE CSS ================= --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

{{-- ================= DATATABLE JS ================= --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,

            ajax: "{{ route('orderfetch') }}",

            responsive: {
                details: {
                    type: 'column',
                    target: 0 // + icon column
                }
            },

            columnDefs: [{
                    targets: 0,
                    className: 'control',
                    orderable: false,
                    searchable: false
                },
                {
                    responsivePriority: 1,
                    targets: 2
                }, // Action
                {
                    responsivePriority: 2,
                    targets: 3
                }, // Order ID
                {
                    responsivePriority: 3,
                    targets: 4
                }, // Customer
                {
                    responsivePriority: 4,
                    targets: 10
                } // Status
            ],

            columns: [{
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'order_id'
                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'product_name'
                },
                {
                    data: 'discount'
                },
                {
                    data: 'total_amount'
                },
                {
                    data: 'order_date'
                },
                {
                    data: 'delivery_date'
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false
                }
            ]
        });

    });

    $(document).on('click', '.viewOrderBtn', function() {
        let orderId = $(this).data('id');

        $.ajax({
            url: "{{ route('order.show') }}",
            type: "GET",
            data: {
                id: orderId
            },
            success: function(res) {
                $('#order_id').val(res.id);
                $('#customer_name').val(res.user.name);
                $('#order_status').val(res.order_status);
                // ✅ ADDRESS DETAILS
                if (res.address) {
                    $('#customer_address').val(
                        res.address.address + ', ' +
                        res.address.city
                    );
                    $('#customer_city').val(res.address.city);
                    $('#customer_pincode').val(res.address.postal_code);
                    $('#customer_email').val(res.user.email);
                    $('#customer_phone').val(res.address.phone);
                } else {
                    $('#customer_address').val('N/A');
                    $('#customer_city').val('N/A');
                    $('#customer_pincode').val('N/A');
                    $('#customer_email').val('N/A');
                    $('#customer_phone').val('N/A');
                }
                $('#orderStatusModal').modal('show');
            }
        });
    });

    // UPDATE STATUS
    $('#updateStatusBtn').on('click', function() {

        $.ajax({
            url: "{{ route('order.updateStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                order_id: $('#order_id').val(),
                order_status: $('#order_status').val()
            },
            success: function(res) {

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                $('#orderStatusModal').modal('hide');
                $('#orderTable').DataTable().ajax.reload(null, false);
            }
        });
    });
</script>

@endpush