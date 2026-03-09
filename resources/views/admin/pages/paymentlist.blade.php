@extends('admin.layouts.app')

@section('content')

<style>
/* ===== TABLE WRAPPER ===== */
.payment-table-wrap {
    background: #fff;
    border-radius: 10px;
    padding: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

/* ===== TABLE ===== */
#paymentTable {
    width: 100% !important;
    font-size: 12px;
    border-collapse: separate;
    border-spacing: 0;
}

/* ===== HEADER ===== */
#paymentTable thead th {
    background: #f4f6f9;
    color: #333;
    font-weight: 600;
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: center;
    white-space: nowrap;
}

/* ===== BODY ===== */
#paymentTable tbody td {
    padding: 8px;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

/* ===== ROW HOVER ===== */
#paymentTable tbody tr:hover {
    background: #f9fafb;
}

/* ===== STATUS BADGES ===== */
.badge {
    font-size: 10px;
    padding: 4px 12px;
    border-radius: 20px;
}
.badge-success {
    background: #d1fae5;
    color: #065f46;
}
.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}
.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

/* ===== BUTTONS ===== */
#paymentTable .btn {
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 6px;
}

/* ===== MOBILE CARD VIEW ===== */
@media (max-width: 768px) {
    #paymentTable thead {
        display: none;
    }

    #paymentTable tbody tr {
        display: block;
        margin-bottom: 14px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 12px;
    }

    #paymentTable tbody td {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        text-align: left;
        white-space: normal;
    }

    #paymentTable tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #555;
    }
}
</style>

<section class="form-sec">
    <div class="inquiry-wrapper">
        <div class="payment-table-wrap">
            <div class="table-responsive">
                <table class="table table-bordered nowrap" id="paymentTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Payment ID</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection

 @push('scripts')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     //  
     // 
     let table;

  $(document).ready(function () {
    $('#paymentTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: false,
        autoWidth: false,
        ajax: "{{ route('paymentfetch') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'razorpay_order_id', name: 'razorpay_order_id' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'product_name', name: 'product_name' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'status', name: 'status' },
            
        ]
    });
});

 </script>
 @endpush

