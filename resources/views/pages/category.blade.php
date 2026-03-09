 @extends('layouts.app')
 @section('content')

 <section class="page-banner">
     <div class="content-wrapper">
         <h1>Category</h1>
         <div class="breadcrumb">
             <a href="{{ route('homepage') }}">
                 <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                     <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                     <polyline points="9 22 9 12 15 12 15 22"></polyline>
                 </svg>
                 Home
             </a>
             <span>/</span>
             <span>Category</span>
         </div>
     </div>
 </section>


 <section class="about-hero">
     <div class="bg-decoration bg-decoration-1"></div>
     <div class="bg-decoration bg-decoration-2"></div>

     <!-- <div class="wrapper">
            <div class="hero-grid">
                <div class="content-block">
                    <div class="badge">About SPLECA</div>

                    <h1 class="headline">
                        Serving Diverse<br>
                        Industries with<br>
                        <span class="accent-word">Precision</span>
                    </h1>

                    <p class="body-text">
                        <strong>SPLECA</strong> is a premier provider of technical sprays, adhesives, and sealants, delivering high-quality solutions designed to enhance industrial efficiency, durability, and performance. As an extension of <strong>LECA India</strong>, a company with over two decades of expertise in automation and industrial solutions, SPLECA is built on a strong foundation of quality, innovation, and customer-centric service.
                    </p>

                    <p class="body-text">
                        Partnering with <strong>WEICON</strong>, a globally recognized brand, we specialize in providing technical sprays, adhesives, assembly pastes, sealants, and special tools for the electrical industry. As the sole distributors for WEICON in Western Australia, we deliver premium products and customized solutions.
                    </p>

                    <a href="#" class="action-button" aria-label="Contact SPLECA">
                        Connect Now
                    </a>

                </div>

                <div class="image-block">
                    <div class="image-container">
                        <div class="dot-pattern"></div>

                        <div class="main-visual">
                            <img src="asset/img/product/about.jpg" alt="SPLECA Industrial Products and Solutions">
                        </div>

                        <div class="metric-badge">
                            <div class="metric-value">100%</div>
                            <div class="metric-label">Quality</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
 </section>

 <div class="modal fade" id="categoryModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Add / Edit Sub Category</h5>
             </div>

             <div class="modal-body">
                 <input type="hidden" id="id">

                 <div class="mb-3">
                     <label>Category</label>
                     <select id="categories" class="form-control">
                         <option value="">Select</option>
                         @foreach($categories as $cat)
                         <option value="{{ $cat->id }}">{{ $cat->type_name }}</option>
                         @endforeach
                     </select>
                 </div>

                 <div class="mb-3">
                     <label>Sub Category</label>
                     <input type="text" id="sub_category_name" class="form-control">
                 </div>
             </div>

             <div class="modal-footer">
                 <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button class="btn btn-primary" id="saveBtn">Save</button>
             </div>
         </div>
     </div>
 </div>


 <section class="form-sec">
     <div class="inquiry-wrapper">

         <!-- Header Row -->
         <div class="d-flex justify-content-end mb-1">
             <button class="btn btn-primary btn-sm" id="addBtn"style="border-radius: 20px;">
                 <i class="fa fa-plus"></i> Add Category
             </button>
         </div>

         <div class="row g-0">
             <table class="table table-bordered nowrap" id="subcategoryTable" style="width:100%">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Category</th>
                         <th>Sub Category</th>
                         <th>Status</th>
                         <th>Action</th>
                     </tr>
                 </thead>
             </table>
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
     //  
     // 
     let table;

     $(document).ready(function() {
         table = $('#subcategoryTable').DataTable({
             responsive: true,
             autoWidth: false,
             ajax: {
                 url: "{{ route('categoryfetch') }}",
                 dataSrc: ''
             },
             columns: [{
                     data: 'id'
                 },
                 {
                     data: 'category.type_name',
                     defaultContent: ''
                 },
                 {
                     data: 'sub_category_name'
                 },
                 {
                     data: 'status',
                     render: function(status, type, row) {
                         let btnClass = status == 1 ? 'btn-success' : 'btn-danger';
                         let btnText = status == 1 ? 'Active' : 'Inactive';

                         return `
                            <button class="btn ${btnClass} btn-sm statusBtn tiny-btn"
                                data-id="${row.id}">
                                ${btnText}
                            </button>
                        `;
                     }
                 },
                 {
                     data: 'id',
                     orderable: false,
                     searchable: false,
                     render: function(id) {
                         return `
            <button class="btn btn-outline-warning btn-xs editBtn" 
                data-id="${id}">
                <i class="fa fa-pen"></i>
            </button>

            <button class="btn btn-outline-danger btn-xs deleteBtn" 
                data-id="${id}">
                <i class="fa fa-trash"></i>
            </button>
        `;
                     }
                 }
             ]
         });

         $('#addBtn').click(function() {
             $('#id').val('');
             $('#categoryModal').modal('show');
         });

         $('#saveBtn').click(function() {
             //  let url = $('#id').val() ? "{{ url('categoryupdate') }}" : "{{ url('categorstore') }}";
             let url = $('#id').val() ?
                 "{{ route('categoryupdate') }}" :
                 "{{ route('categorstore') }}";

             $.ajax({
                 url: url,
                 type: "POST",
                 data: {
                     _token: "{{ csrf_token() }}",
                     id: $('#id').val(),
                     categories: $('#categories').val(),
                     sub_category_name: $('#sub_category_name').val()
                 },
                 success: function(res) {
                     if (!res.status) {
                         Swal.fire('Error', res.errors.join('<br>'), 'error');
                     } else {
                         $('#categoryModal').modal('hide');
                         table.ajax.reload();
                         Swal.fire('Success', 'Saved successfully', 'success');
                     }
                 }
             });
         });

         $(document).on('click', '.editBtn', function() {
             $.get("sub-category-edit/" + $(this).data('id'), function(data) {
                 $('#id').val(data.id);
                 $('#categories').val(data.categories);
                 $('#sub_category_name').val(data.sub_category_name);
                 $('#categoryModal').modal('show');
             });
         });

         $(document).on('click', '.deleteBtn', function() {
             let id = $(this).data('id');

             Swal.fire({
                 title: 'Delete?',
                 showCancelButton: true,
                 confirmButtonText: 'Yes'
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "sub-category-delete/" + id,
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

     });

     $(document).on('click', '.statusBtn', function() {
         let id = $(this).data('id');

         Swal.fire({
             title: 'Change status?',
             text: 'Do you want to update the status?',
             icon: 'question',
             showCancelButton: true,
             confirmButtonText: 'Yes, change it'
         }).then((result) => {

             if (result.isConfirmed) {
                 $.ajax({
                     url: "{{ route('subcategorystatus') }}",
                     type: "POST",
                     data: {
                         _token: "{{ csrf_token() }}",
                         id: id
                     },
                     success: function() {
                         table.ajax.reload(null, false);

                         Swal.fire({
                             icon: 'success',
                             title: 'Updated!',
                             timer: 1000,
                             showConfirmButton: false
                         });
                     }
                 });
             }
         });
     });
 </script>
 @endpush

 @endsection