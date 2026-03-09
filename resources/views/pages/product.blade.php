@extends('layouts.app')
@section('content')
<style>
    .status-badge {
        font-size: 13px;        /* text size */
        padding: 6px 12px;      /* height & width */
        border-radius: 20px;    /* pill look */
    }
    #productModal .modal-dialog {
        max-width: 95%;
        height: 90vh;
    }

    #productModal .modal-content {
        height: 100%;
    }

    #productModal .modal-body {
        overflow-y: auto;
        max-height: calc(90vh - 140px);
    }

    .preview-box {
        position: relative;
        margin: 5px;
    }

    .preview-box img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .preview-box .remove-img {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: #fff;
        border-radius: 50%;
        font-size: 12px;
        width: 20px;
        height: 20px;
        text-align: center;
        cursor: pointer;
    }
</style>
<!-- <section class="page-banner">
    <div class="content-wrapper">
        <h1>Products</h1>
    </div>
</section> -->

<!-- PRODUCT MODAL -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add / Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="productForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="product_id">

                <div class="modal-body">
                    <div class="row">

                        <!-- Category -->
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->sub_category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <!-- Product Images -->
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Product Images</label>
                            <input type="file"
                                name="images[]"
                                id="images"
                                class="form-control"
                                multiple>
                            <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>

                        </div>

                        <!-- Price -->
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control">
                        </div>

                        <!-- Discount -->
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Discount (%)</label>
                            <input type="number" step="0.01" name="discount_percent" id="discount_percent" class="form-control">
                        </div>

                        <!-- Original Price -->
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Discount Price</label>
                            <input type="number" step="0.01" name="original_price" id="original_price" class="form-control" readonly>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control">
                        </div>

                        <!-- Stock Status -->
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Stock Status</label>
                            <select name="stock_status" id="stock_status" class="form-control">
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>

                        <!-- Tags -->
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Tags</label>
                            <input type="text"
                                name="tags"
                                id="tags"
                                class="form-control"
                                placeholder="comma separated">
                        </div>

                        <!-- Short Description -->
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description"
                                id="short_description"
                                class="form-control"
                                rows="2"></textarea>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                id="description"
                                class="form-control"
                                rows="4"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<section class="form-sec">
    <div class="inquiry-wrapper">

        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary btn-sm" id="addBtn" style="border-radius:20px;">
                <i class="fa fa-plus"></i> Add Product
            </button>
        </div>

        <table class="table table-bordered nowrap" id="productTable" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

    </div>
    <!-- PRODUCT RESOURCE MODAL -->
    <div class="modal fade" id="resourceModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Product Resource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="resourceForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="resource_id">
                    <input type="hidden" name="product_id" id="resource_product_id">

                    <div class="modal-body">
                        <!-- DATA SHEET -->
                        <h5>Data Sheet
                            <button type="button" class="btn btn-sm btn-success float-end add-datasheet">
                                + Add
                            </button>
                        </h5>
                        <div class="resource-box datasheet-box" id="datasheet-wrapper">

                            <div class="datasheet-row border p-3 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Data Sheet Title</label>
                                    <input type="text" name="datasheet_title[]" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Upload Data Sheet (PDF)</label>
                                    <input type="file" name="datasheet_file[]" class="form-control" accept="application/pdf">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <h5>
                            Brochure
                            <button type="button" class="btn btn-sm btn-success float-end add-brochure">
                                + Add
                            </button>
                        </h5>

                        <!-- BROCHURE -->
                        <div class="resource-box brochure-box" id="brochure-wrapper">

                            <div class="brochure-row border p-3 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Upload Brochure (PDF)</label>
                                    <input type="file" name="brochure_file[]" class="form-control" accept="application/pdf">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <h5>
                            Video
                            <button type="button" class="btn btn-sm btn-success float-end add-video">
                                + Add
                            </button>
                        </h5>

                        <!-- VIDEO -->
                        <div class="resource-box video-box" id="video-wrapper">

                            <div class="video-row border p-3 mb-2">
                                <div class="mb-3">
                                    <label class="form-label">Video URL (YouTube / Vimeo)</label>
                                    <input type="url" name="video_url[]" class="form-control" placeholder="https://youtube.com/...">
                                </div>
                            </div>

                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



</section>
@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let table;
    let selectedFiles = [];

    $(document).ready(function() {
        $(document).on('click', '.resourceBtn', function() {

            let productId = $(this).data('product');

            $('#resourceForm')[0].reset();
            $('#resource_id').val('');
            $('#resource_product_id').val(productId);

            // $('.resource-box').addClass('d-none');

            $('#resourceModal').modal('show');
        });
        $('#resourceForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('product-resource.store') }}", // create this route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {
                    if (res.status) {
                        Swal.fire('Success', res.message, 'success');
                        $('#resourceModal').modal('hide');
                        $('#resourceForm')[0].reset();
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },

                error: function(xhr) {
                    let msg = '';
                    $.each(xhr.responseJSON.errors, function(k, v) {
                        msg += v[0] + '<br>';
                    });
                    Swal.fire('Validation Error', msg, 'error');
                }
            });
        });

        /* ================= DISCOUNT CALC ================= */
        function calculateDiscountPrice() {
            let price = parseFloat($('#price').val()) || 0;
            let discount = parseFloat($('#discount_percent').val()) || 0;
            if (discount > 100) discount = 100;

            let finalPrice = price - (price * discount / 100);
            $('#original_price').val(finalPrice.toFixed(2));
        }

        $('#price, #discount_percent').on('input', calculateDiscountPrice);


        /* ================= DATATABLE ================= */
        table = $('#productTable').DataTable({
            responsive: true,
            ajax: {
                url: "{{ route('productfetch') }}",
                dataSrc: ''
            },
            columns: [{
                    data: null,
                    render: (d, t, r, m) => m.row + 1
                },
                {
                    data: 'name'
                },
                {
                    data: 'price'
                },
                {
                    data: 'quantity'
                },
                {
                    data: 'status',
                    render: function(status, type, row) {
                        let badgeClass = status == 1 ? 'bg-success' : 'bg-danger';
                        let badgeText = status == 1 ? 'Active' : 'Inactive';

                        return `
                            <span 
                                class="badge badge-pill ${badgeClass} toggleStatus tatus-badge " 
                                style="cursor:pointer;border-radius: 25px;"
                                data-id="${row.id}"
                                data-status="${status}">
                                ${badgeText}
                            </span>
                        `;
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: id => `
                    <button class="btn btn-outline-warning btn-xs editBtn" data-id="${id}">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-xs deleteBtn" data-id="${id}">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-xs resourceBtn" data-product="${id}">
                        <i class="fa fa-folder-plus"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-xs viewBtn" data-id="${id}">
                        <i class="fa fa-eye"></i>
                    </button>
                `
                }
            ]
        });


        /* ================= ADD ================= */
        $('#addBtn').click(function() {
            $('#productForm')[0].reset();
            $('#product_id').val('');
            $('#imagePreview').html('');
            selectedFiles = [];
            $('#productModal').modal('show');
        });


        /* ================= IMAGE PREVIEW ================= */
        $('#images').on('change', function(e) {
            selectedFiles = Array.from(e.target.files);
            renderPreview();
        });

        function renderPreview() {
            $('#imagePreview .new-img').remove();

            selectedFiles.forEach((file, index) => {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').append(`
                    <div class="preview-box new-img" data-index="${index}">
                        <span class="remove-img">&times;</span>
                        <img src="${e.target.result}">
                    </div>
                `);
                };

                reader.readAsDataURL(file);
            });
        }

        /* Remove NEW image */
        $(document).on('click', '.preview-box.new-img .remove-img', function() {
            let index = $(this).parent().data('index');
            selectedFiles.splice(index, 1);
            renderPreview();
        });


        /* ================= SAVE ================= */
        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.delete('images[]');

            selectedFiles.forEach(file => {
                formData.append('images[]', file);
            });

            let btn = $('#saveBtn');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

            $.ajax({
                url: "{{ route('productstore') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save');

                    if (!res.status) {
                        Swal.fire('Error', res.message, 'error');
                    } else {
                        $('#productModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Success', res.message, 'success');
                        $('#productForm')[0].reset();
                        selectedFiles = [];
                        $('#imagePreview').html('');
                    }
                },

                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="fas fa-save"></i> Save');
                    let msg = '';
                    $.each(xhr.responseJSON.errors, (k, v) => msg += v[0] + '<br>');
                    Swal.fire('Validation Error', msg, 'error');
                }
            });
        });


        /* ================= EDIT ================= */
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            selectedFiles = [];
            $('#imagePreview').html('');

            $.get("{{ url('product-edit') }}/" + id, function(res) {

                $('#product_id').val(res.id);
                $('#category_id').val(res.category_id);
                $('#name').val(res.name);
                $('#price').val(res.price);
                $('#discount_percent').val(res.discount_percent);
                $('#original_price').val(res.original_price);
                $('#quantity').val(res.quantity);
                $('#stock_status').val(res.stock_status);
                $('#tags').val(res.tags);
                $('#short_description').val(res.short_description);
                $('#description').val(res.description);

                const productImagePath = "{{ url('public/uploads/products') }}/";

                res.images.forEach(img => {
                    $('#imagePreview').append(`
                    <div class="preview-box" data-id="${img.id}">
                        <span class="remove-img old-img">&times;</span>
                        <img src="${productImagePath}${img.image}">
                    </div>
                `);
                });

                $('#productModal').modal('show');
            });
        });


        /* Remove OLD image */
        $(document).on('click', '.old-img', function() {
            let box = $(this).closest('.preview-box');
            let imageId = box.data('id');

            $.ajax({
                url: "{{ url('product-image-delete') }}/" + imageId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    box.remove();
                }
            });
        });


        /* ================= DELETE PRODUCT ================= */
        $(document).on('click', '.deleteBtn', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Delete Product?',
                icon: 'warning',
                showCancelButton: true
            }).then(res => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: "product-delete/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: () => {
                            table.ajax.reload();
                            Swal.fire('Deleted', 'Product removed', 'success');
                        }
                    });
                }
            });
        });

    });
    $(document).on('click', '.viewBtn', function() {
        let productId = $(this).data('id');

        if (!productId) {
            console.error('Product ID missing');
            return;
        }

        window.location.href = "{{ url('/product') }}/" + productId;
    });

    $(document).ready(function() {

        // DATA SHEET
        $('.add-datasheet').click(function() {
            $('#datasheet-wrapper').append(`
            <div class="datasheet-row border p-3 mb-2">
                <div class="mb-3">
                    <label class="form-label">Data Sheet Title</label>
                    <input type="text" name="datasheet_title[]" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Data Sheet (PDF)</label>
                    <input type="file" name="datasheet_file[]" class="form-control" accept="application/pdf">
                </div>

                <button type="button" class="btn btn-sm btn-danger remove-row">
                    Remove
                </button>
            </div>
        `);
        });

        // BROCHURE
        $('.add-brochure').click(function() {
            $('#brochure-wrapper').append(`
            <div class="brochure-row border p-3 mb-2">
                <div class="mb-3">
                    <label class="form-label">Upload Brochure (PDF)</label>
                    <input type="file" name="brochure_file[]" class="form-control" accept="application/pdf">

                    <button type="button" class="btn btn-sm btn-danger remove-row mt-2">
                        Remove
                    </button>
                </div>
            </div>
        `);
        });

        // VIDEO
        $('.add-video').click(function() {
            $('#video-wrapper').append(`
            <div class="video-row border p-3 mb-2">
                <div class="mb-3">
                    <label class="form-label">Video URL</label>
                    <input type="url" name="video_url[]" class="form-control">

                    <button type="button" class="btn btn-sm btn-danger remove-row mt-2">
                        Remove
                    </button>
                </div>
            </div>
        `);
        });

        // REMOVE ROW (GLOBAL)
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.datasheet-row, .brochure-row, .video-row').remove();
        });

    });
    $(document).on('click', '.toggleStatus', function() {

        let productId = $(this).data('id');
        let currentStatus = $(this).data('status');

        $.ajax({
            url: "{{ route('product.status.toggle') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: productId,
                status: currentStatus
            },
            success: function(res) {
                if (res.status) {
                    table.ajax.reload(null, false); // reload without pagination reset
                } else {
                    alert(res.message);
                }
            }
        });
    });
</script>


@endpush
@endsection