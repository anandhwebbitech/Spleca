@extends('admin.layouts.app')
@section('content')
    <style>
        /* ===== PAGE WRAPPER ===== */
        .page-wrapper {
            background: #f4f6fb;
            padding: 25px;
            border-radius: 18px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            padding: 20px 25px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-header h4 {
            margin: 0;
            font-weight: 600;
        }

        /* ===== CARD ===== */
        .card-box {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        /* ===== TABLE ===== */
        .table {
            font-size: 12px;
        }

        .table thead th {
            background: #f1f5f9;
            font-weight: 600;
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        /* ===== STATUS BADGE ===== */
        .status-badge {
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 30px;
        }

        /* ===== MODAL ===== */
        .modal-content {
            border-radius: 18px;
        }

        .modal-header {
            background: #f8fafc;
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        /* ===== IMAGE PREVIEW ===== */
        .preview-box {
            position: relative;
            margin: 6px;
        }

        .preview-box img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .preview-box .remove-img {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ef4444;
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 12px;
            text-align: center;
            cursor: pointer;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .form-switch .form-check-input {
            width: 45px;
            height: 22px;
            cursor: pointer;
        }

        /* Section Card Style */
        .form-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #e3e6f0;
        }

        /* Section Title */
        .section-title {
            font-weight: 600;
            font-size: 14px;
            color: #4e73df;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Switch alignment */
        .form-check.form-switch {
            padding-left: 2.5rem;
        }

        /* Variant Box */
        #variantSection {
            background: #ffffff;
            border: 1px dashed #4e73df;
            border-radius: 8px;
            padding: 15px;
        }

        .variantRow input {
            border-radius: 6px 0 0 6px;
        }

        .variantRow button {
            border-radius: 0 6px 6px 0;
        }

        /* Modal Header */
        .custom-header {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            padding: 18px 25px;
            border-bottom: none;
        }

        /* Card Section */
        .resource-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        /* Section Header */
        .section-header {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }

        /* Resource Item */
        .resource-item {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        /* Remove Button */
        .remove-row {
            margin-top: 10px;
        }

        /* Modal Border Radius */
        .custom-modal {
            border-radius: 14px;
            overflow: hidden;
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
                    <h5 class="modal-title fw-bold">Add / Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="productForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="product_id">

                    <div class="modal-body">

                        <!-- ================= BASIC INFO ================= -->
                        <div class="form-section">
                            <div class="section-title">Basic Information</div>
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">Select</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sub Category</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control"></select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <input type="text" name="type" id="type" class="form-control">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Product Images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>

                                </div>

                            </div>
                        </div>

                        <!-- ================= VISIBILITY ================= -->
                        <div class="form-section">
                            <div class="section-title">Visibility</div>
                            <div class="row">

                                <div class="col-md-3 mb-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1">
                                        <label class="form-check-label ms-2">Featured Product</label>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_best_seller" value="1">
                                        <label class="form-check-label ms-2">Best Seller</label>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3 d-flex align-items-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="has_variants">
                                        <label class="form-check-label ms-2">Has Variants</label>
                                    </div>
                                </div>

                            </div>

                            <!-- Variant Section -->
                            <div id="variantSection" style="display:none;">
                                <label class="form-label fw-bold text-primary mb-2">Product Variants</label>

                                <div id="variantWrapper"></div>

                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addVariant">
                                    + Add Another Variant
                                </button>
                            </div>

                        </div>

                        <!-- ================= PRICING & INVENTORY ================= -->
                        <div class="form-section">
                            <div class="section-title">Pricing & Inventory</div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" id="price" class="form-control">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stock Status</label>
                                    <select name="stock_status" id="stock_status" class="form-control">
                                        <option value="in_stock">In Stock</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ================= DESCRIPTION ================= -->
                        <div class="form-section">
                            <div class="section-title">Product Description</div>

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control"
                                    rows="2"></textarea>
                            </div>

                            <div>
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            </div>
                             <div class="col-md-12 mb-3">
                        <label class="form-label">Sub Categories</label>

                        <div class="row">
                            @foreach($subcategories as $sub)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="add_sub_category_id[]"
                                            value="{{ $sub->id }}"
                                            id="sub_{{ $sub->id }}">

                                        <label class="form-check-label" for="sub_{{ $sub->id }}">
                                            {{ $sub->sub_category_name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                        </div>

                    </div>
                   

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Product
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

            <div class="card-box">
                <table class="table table-bordered nowrap" id="productTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
        <!-- PRODUCT RESOURCE MODAL -->
        {{-- <div class="modal fade" id="resourceModal" tabindex="-1">
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
                                        <input type="file" name="datasheet_file[]" class="form-control"
                                            accept="application/pdf">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h5>
                                Brochure

                            </h5>

                            <!-- BROCHURE -->
                            <div class="resource-box brochure-box" id="brochure-wrapper">

                                <div class="brochure-row border p-3 mb-2">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Brochure (PDF)</label>
                                        <input type="file" name="brochure_file[]" class="form-control"
                                            accept="application/pdf" multiple>
                                        <small class="text-muted">You can select multiple PDFs</small>

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
                                        <input type="url" name="video_url[]" class="form-control"
                                            placeholder="https://youtube.com/...">
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
        </div> --}}

        <div class="modal fade" id="resourceModal" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content custom-modal">

                    <!-- HEADER -->
                    <div class="modal-header custom-header">
                        <h4 class="modal-title fw-bold">
                            📦 Product Resource Manager
                        </h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="resourceForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="resource_id">
                        <input type="hidden" name="product_id" id="resource_product_id">

                        <div class="modal-body">

                            <!-- DATA SHEET CARD -->
                            <div class="resource-card">
                                <div class="section-header">
                                    📄 Data Sheets
                                    <button type="button" class="btn btn-sm btn-primary add-datasheet float-end">
                                        + Add
                                    </button>
                                </div>

                                <div id="datasheet-wrapper">
                                    <div class="datasheet-row resource-item">
                                        <!--<input type="text" name="datasheet_title[]" class="form-control mb-2"-->
                                        <!--    placeholder="Enter Data Sheet Title">-->

                                        <input type="file" name="datasheet_file[]" class="form-control"
                                            accept="application/pdf">
                                    </div>
                                </div>
                                <div id="datasheet-existing"></div>
                            </div>

                            <!-- BROCHURE CARD -->
                            <div class="resource-card mt-4">
                                <div class="section-header">
                                    📘 Brochures
                                </div>

                                <div class="resource-item">
                                    <input type="file" name="brochure_file[]" class="form-control" accept="application/pdf"
                                        multiple>
                                    <small class="text-muted">
                                        You can upload multiple PDF files
                                    </small>
                                </div>
                            </div>
                            <div id="brochure-existing" class="mt-2"></div>

                            <!-- VIDEO CARD -->
                            <div class="resource-card mt-4">
                                <div class="section-header">
                                    🎥 Product Videos
                                    <button type="button" class="btn btn-sm btn-primary add-video float-end">
                                        + Add
                                    </button>
                                </div>

                                <div id="video-wrapper">
                                    <div class="video-row resource-item">
                                        <input type="url" name="video_url[]" class="form-control"
                                            placeholder="https://youtube.com/...">
                                    </div>
                                </div>
                            </div>
                            <div id="video-existing" class="mt-2"></div>

                            <!-- STATUS -->
                            <div class="mt-4">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="modal-footer border-0 pb-4">
                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success px-4">
                                💾 Save Resources
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

            $(document).ready(function () {
                $(document).on('click', '.resourceBtn', function () {

                    let productId = $(this).data('product');

                    $('#resourceForm')[0].reset();
                    $('#resource_id').val('');
                    $('#resource_product_id').val(productId);

                    // $('.resource-box').addClass('d-none');

                    $('#resourceModal').modal('show');
                });
                $('#resourceForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('product-resource.store') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend: function () {
                            Swal.fire({
                                title: 'Uploading...',
                                text: 'Please wait while we process your request.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },

                        success: function (res) {

                            Swal.close(); // close loader

                            if (res.status) {
                                Swal.fire('Success', res.message, 'success');
                                $('#resourceModal').modal('hide');
                                $('#resourceForm')[0].reset();
                            } else {
                                Swal.fire('Error', res.message, 'error');
                            }
                        },

                        error: function (xhr) {

                            Swal.close(); // close loader

                            let msg = '';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function (k, v) {
                                    msg += v[0] + '<br>';
                                });
                            } else {
                                msg = 'Something went wrong.';
                            }

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

                // $('#price, #discount_percent').on('input', calculateDiscountPrice);


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
                        render: function (status, type, row) {
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

                                                            `
                    }
                    ]
                });
                // <button class="btn btn-outline-primary btn-xs viewBtn" data-id="${id}">
                //                         <i class="fa fa-eye"></i>
                //                     </button>

                /* ================= ADD ================= */
                $('#addBtn').click(function () {
                    $('#productForm')[0].reset();
                    $('#product_id').val('');
                    $('#imagePreview').html('');
                    selectedFiles = [];
                    $('#productModal').modal('show');
                    $('#variantSection').hide();
                    $('#variantWrapper').html('');
                    $('#price').closest('.col-md-3').show();
                });


                /* ================= IMAGE PREVIEW ================= */
                $('#images').on('change', function (e) {
                    selectedFiles = Array.from(e.target.files);
                    renderPreview();
                });

                function renderPreview() {
                    $('#imagePreview .new-img').remove();

                    selectedFiles.forEach((file, index) => {
                        let reader = new FileReader();

                        reader.onload = function (e) {
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
                $(document).on('click', '.preview-box.new-img .remove-img', function () {
                    let index = $(this).parent().data('index');
                    selectedFiles.splice(index, 1);
                    renderPreview();
                });


                /* ================= SAVE ================= */
                $('#productForm').on('submit', function (e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    formData.delete('images[]');

                    selectedFiles.forEach(file => {
                        formData.append('images[]', file);
                    });
                    let productId = $('#product_id').val();
                    let url = productId 
                        ? "{{ url('product-update') }}/" + productId
                        : "{{ route('productstore') }}";

                    let btn = $('#saveBtn');

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        beforeSend: function () {

                            // Disable button + spinner
                            btn.prop('disabled', true)
                                .html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                            // Show global loader
                            Swal.fire({
                                title: 'Saving Product...',
                                text: 'Please wait...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },

                        success: function (res) {

                            Swal.close(); // Close loader

                            btn.prop('disabled', false)
                                .html('<i class="fas fa-save"></i> Save');

                            if (!res.status) {
                                Swal.fire('Error', res.message, 'error');
                            } else {
                                $('#productModal').modal('hide');
                                table.ajax.reload(null, false);
                                Swal.fire('Success', res.message, 'success');

                                $('#productForm')[0].reset();
                                selectedFiles = [];
                                $('#imagePreview').html('');
                            }
                        },

                        error: function (xhr) {

                            Swal.close();

                            btn.prop('disabled', false)
                                .html('<i class="fas fa-save"></i> Save');

                            let msg = 'Something went wrong.';

                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                msg = '';
                                $.each(xhr.responseJSON.errors, (k, v) => {
                                    msg += v[0] + '<br>';
                                });
                            }

                            Swal.fire('Validation Error', msg, 'error');
                        }
                    });
                });
                $(document).on('click', '.editBtn', function () {

                    let id = $(this).data('id');

                    $('#productForm')[0].reset();
                    $('#product_id').val(id);
                    $('#variantWrapper').html('');
                    $('#imagePreview').html('');
                    $('#variantSection').hide();
                    $('#has_variants').prop('checked', false);

                    $.get("{{ url('product-edit') }}/" + id, function (res) {

                        $('#product_id').val(res.id);
                        $('#category_id').val(res.category_id);

                        // Load Subcategories
                        $.ajax({
                            url: "{{ route('get.subcategories', ':id') }}".replace(':id', res.category_id),
                            type: 'GET',
                            success: function (response) {

                                $('#sub_category_id').empty();
                                $('#sub_category_id').append('<option value="">Select</option>');

                                $.each(response, function (key, subcat) {
                                    $('#sub_category_id').append(
                                        '<option value="' + subcat.id + '">' + subcat.sub_category_name + '</option>'
                                    );
                                });

                                $('#sub_category_id').val(res.sub_category_id);
                            }
                        });

                        $('#name').val(res.name);
                        $('#type').val(res.sub);
                        $('#price').val(res.price);
                        $('#quantity').val(res.quantity);
                        $('#stock_status').val(res.stock_status);
                        $('#short_description').val(res.short_description);
                        $('#description').val(res.description);

                        $('input[name="is_featured"]').prop('checked', res.is_featured == 1);
                        $('input[name="is_best_seller"]').prop('checked', res.is_best_seller == 1);

                        // ================= VARIANTS =================
                        if (res.variants && res.variants.length > 0) {

                            $('#has_variants').prop('checked', true);
                            $('#variantSection').slideDown();
                            $('#variantWrapper').html('');

                            res.variants.forEach(function (variant) {

                                $('#variantWrapper').append(`
                                            <div class="row mb-2 variantRow align-items-center">

                                                <div class="col-md-5">
                                                    <input type="text" 
                                                        name="variants[]" 
                                                        class="form-control"
                                                        value="${variant.name ?? ''}"
                                                        required>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" 
                                                        name="variant_prices[]" 
                                                        class="form-control"
                                                        value="${variant.price ?? ''}"
                                                        step="0.01" min="0"
                                                        required>
                                                </div>

                                                <div class="col-md-3">
                                                    <button type="button" 
                                                        class="btn btn-outline-danger removeVariant w-100">
                                                        Remove
                                                    </button>
                                                </div>

                                            </div>
                                        `);

                            });
                        }

                        // ================= IMAGES =================
                        const productImagePath = "{{ url('public/uploads/products') }}/";

                        if (res.images && res.images.length > 0) {

                            res.images.forEach(function (img) {

                                $('#imagePreview').append(`
                                            <div class="preview-box" data-id="${img.id}">
                                                <img src="${productImagePath}${img.image}" 
                                                    style="width:80px;height:80px;object-fit:cover;">
                                            </div>
                                        `);

                            });
                        }
                        // First uncheck all
                        $('input[name="sub_category_id[]"]').prop('checked', false);

                        // Then check selected ones
                        if (res.additional_sub_category) {
                            res.additional_sub_category.forEach(function(id) {
                                $('#sub_' + id).prop('checked', true);
                            });
                        }

                        $('#productModal').modal('show');
                    });
                });

                /* Remove OLD image */
                $(document).on('click', '.old-img', function () {
                    let box = $(this).closest('.preview-box');
                    let imageId = box.data('id');

                    $.ajax({
                        url: "{{ url('product-image-delete') }}/" + imageId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            box.remove();
                        }
                    });
                });


                /* ================= DELETE PRODUCT ================= */
                $(document).on('click', '.deleteBtn', function () {
                    let id = $(this).data('id');

                    Swal.fire({
                        title: 'Delete Product?',
                        icon: 'warning',
                        showCancelButton: true
                    }).then(res => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: "{{ route('product.delete', ':id') }}".replace(':id', id),
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
            $(document).on('click', '.viewBtn', function () {
                let productId = $(this).data('id');

                if (!productId) {
                    console.error('Product ID missing');
                    return;
                }

                window.location.href = "{{ url('/product') }}/" + productId;
            });

            $(document).ready(function () {

                // DATA SHEET
                $('.add-datasheet').click(function () {
                    $('#datasheet-wrapper').append(`
                                            <div class="datasheet-row resource-item">

                                                <input type="file"
                                                    name="datasheet_file[]"
                                                    class="form-control"
                                                    accept="application/pdf">

                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-row">
                                                    Remove
                                                </button>
                                            </div>
                                        `);
                });

                // VIDEO
                $('.add-video').click(function () {
                    $('#video-wrapper').append(`
                                            <div class="video-row resource-item">
                                                <input type="url"
                                                    name="video_url[]"
                                                    class="form-control"
                                                    placeholder="https://youtube.com/...">

                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-row">
                                                    Remove
                                                </button>
                                            </div>
                                        `);
                });

                // REMOVE
                $(document).on('click', '.remove-row', function () {
                    $(this).closest('.resource-item').remove();
                });

            });
            $(document).on('click', '.toggleStatus', function () {

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
                    success: function (res) {
                        if (res.status) {
                            table.ajax.reload(null, false); // reload without pagination reset
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });
            $(document).ready(function () {

                $('#category_id').on('change', function () {

                    let categoryId = $(this).val();

                    if (categoryId != '') {

                        $.ajax({
                            url: "{{ route('get.subcategories', ':id') }}".replace(':id', categoryId),
                            type: 'GET',
                            success: function (response) {

                                $('#sub_category_id').empty();
                                $('#sub_category_id').append('<option value="">Select</option>');

                                $.each(response, function (key, subcat) {
                                    $('#sub_category_id').append(
                                        '<option value="' + subcat.id + '">' + subcat.sub_category_name + '</option>'
                                    );
                                });

                            }
                        });

                    } else {
                        $('#sub_category_id').empty();
                        $('#sub_category_id').append('<option value="">Select</option>');
                    }

                });

            });
            $(document).ready(function () {

                // Show / Hide Variant Section
                // Toggle Variant Section
                $('#has_variants').change(function () {
                    if ($(this).is(':checked')) {
                        $('#variantSection').show();
                        $('#price').closest('.col-md-3').hide(); // Hide main price
                        $('#price').val('');
                    } else {
                        $('#variantSection').hide();
                        $('#variantWrapper').html('');
                        $('#price').closest('.col-md-3').show(); // Show main price
                    }
                });


                $('#addVariant').click(function () {
                    let variantField = `
                                <div class="row mb-2 variantRow align-items-center">

                                    <div class="col-md-5">
                                        <input type="text" name="variants[]" 
                                            class="form-control"
                                            placeholder="Example: 500g / 1kg / XL" required>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="number" name="variant_prices[]" 
                                            class="form-control"
                                            placeholder="Enter Price"
                                            step="0.01" min="0" required>
                                    </div>

                                    <div class="col-md-3">
                                        <button type="button" 
                                            class="btn btn-outline-danger removeVariant w-100">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            `;

                    $('#variantWrapper').append(variantField);
                });
                // Remove Variant
                $(document).on('click', '.removeVariant', function () {
                    $(this).closest('.variantRow').remove();
                });

            });

            $(document).on('click', '.resourceBtn', function () {

    let productId = $(this).data('product');

    $('#resourceForm')[0].reset();
    $('#resource_product_id').val(productId);

    // Clear old data
    $('#datasheet-existing').html('');
    $('#brochure-existing').html('');
    $('#video-existing').html('');

    $.ajax({
        url: "{{ route('product.resource.fetch', ':id') }}".replace(':id', productId),        
        type: "GET",
        success: function(res){

            let basePath = "{{ url('public/uploads/resources') }}/";

            res.forEach(function(item){

                /* ================= DATASHEET ================= */
                if(item.type === 'datasheet'){
                    $('#datasheet-existing').append(`
                        <div class="mt-2">
                            <a href="${basePath+item.file}" target="_blank" class="btn btn-sm btn-outline-primary">
                                📄 ${item.title}
                            </a>

                            <button class="btn btn-sm btn-danger deleteResource"
                                data-id="${item.id}">
                                Delete
                            </button>
                        </div>
                    `);
                }

                /* ================= BROCHURE ================= */
                if(item.type === 'brochure'){
                    $('#brochure-existing').append(`
                        <div class="mt-2">
                            <a href="${basePath+item.file}" target="_blank" class="btn btn-sm btn-outline-success">
                                📘 ${item.title}
                            </a>

                            <button class="btn btn-sm btn-danger deleteResource"
                                data-id="${item.id}">
                                Delete
                            </button>
                        </div>
                    `);
                }

                /* ================= VIDEO ================= */
                if(item.type === 'video'){
                    $('#video-existing').append(`
                        <div class="mt-2">
                            <a href="${item.video_url}" target="_blank">
                                🎥 ${item.video_url}
                            </a>

                            <button class="btn btn-sm btn-danger deleteResource"
                                data-id="${item.id}">
                                Delete
                            </button>
                        </div>
                    `);
                }

            });

        }
    });

    $('#resourceModal').modal('show');

});

</script>


    @endpush
@endsection