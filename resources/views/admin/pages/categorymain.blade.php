@extends('admin.layouts.app')
@section('content')

<style>
    .page-card {
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .05);
    }

    .table thead th {
        white-space: nowrap;
        background: #f8f9fa;
    }

    .action-btns button {
        margin-right: 4px;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_filter {
            float: none;
            text-align: left;
            margin-bottom: 10px;
        }
    }

    .action-btns {
        display: flex;
        justify-content: center;
        gap: 6px;
    }

    /* Mobile stacking */
    @media (max-width: 576px) {
        .action-btns {
            flex-direction: column;
        }
    }

    /* Responsive child row spacing */
    table.dataTable>tbody>tr.child td {
        padding-left: 2.5rem;
        
    }
    #categoryTable{
         font-size: 12px;
    }
</style>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add / Edit Category</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" id="category_name" class="form-control" placeholder="Enter category">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="saveBtn">
                    <i class="fa fa-save me-1"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ================= PAGE ================= -->
<div class="page-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"> Categories</h5>
        <button class="btn btn-primary btn-sm" id="addBtn">
            <i class="fa fa-plus me-1"></i> Add  Category
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle w-100 dt-responsive nowrap" id="categoryTable">
            <thead>
                <tr>
                    <th></th> <!-- Responsive control -->
                    <th>#</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('scripts')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let table;

    $(document).ready(function() {

        table = $('#categoryTable').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 0
                }
            },
            autoWidth: false,
            processing: true,
            ajax: {
                url: "{{ route('maincategoryfetch') }}",
                dataSrc: ''
            },
            columnDefs: [{
                    targets: 0,
                    className: 'control',
                    orderable: false,
                    searchable: false
                },
                {
                    targets: -1,
                    orderable: false,
                    searchable: false
                }
            ],
            columns: [{
                    data: null,
                    defaultContent: ''
                }, // control
                {
                    data: 'id'
                },
                {
                    data: 'type_name',
                    defaultContent: '-'
                },
                {
                    data: 'status',
                    render: function(status, type, row) {
                    return `
                        <span class="badge ${status == 1 ? 'bg-success' : 'bg-danger'} statusBtn"
                            data-id="${row.id}">
                            ${status == 1 ? 'Active' : 'Inactive'}
                        </span>
                    `;
                }
                },
                {
                    data: 'id',
                    className: 'text-center',
                    render: function(id) {
                        return `
                    <div class="action-btns">
                        <button class="btn btn-outline-warning btn-sm editBtn" data-id="${id}">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm deleteBtn" data-id="${id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                `;
                    }
                }
            ]
        });

        $('#addBtn').click(function() {
            $('#id').val('');
            $('#category_name').val('');
            $('#categoryModal').modal('show');
        });

        $('#saveBtn').click(function() {
            let url = $('#id').val() ?
                "{{ route('maincategoryupdate') }}" :
                "{{ route('maincategorstore') }}";

            $.post(url, {
                _token: "{{ csrf_token() }}",
                id: $('#id').val(),
                category_name: $('#category_name').val(),
            }, function(res) {
                if (!res.status) {
                    Swal.fire('Error', res.errors.join('<br>'), 'error');
                } else {
                    $('#categoryModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire('Success', 'Saved successfully', 'success');
                }
            });
        });

        $(document).on('click', '.editBtn', function() {
            $.get("category-edit/" + $(this).data('id'), function(data) {
                $('#id').val(data.id);
                $('#categories').val(data.categories);
                $('#categoryModal').modal('show');
            });
        });

        $(document).on('click', '.deleteBtn', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Delete this record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "maincategory-delete/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            table.ajax.reload();
                            Swal.fire('Deleted!', '', 'success');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.statusBtn', function() {
            let id = $(this).data('id');

            $.post("{{ route('maincategorystatus') }}", {
                _token: "{{ csrf_token() }}",
                id: id
            }, function() {
                table.ajax.reload(null, false);
            });
        });

    });
</script>

@endpush