 @extends('layouts.app')
 @section('content')

 <div class="form-container my-5">
     <div class="form-header">Set New Password</div>

     <div class="form-description">
         Please enter your new password. Make sure it's strong and secure.
     </div>

     <form id="changePasswordForm">
         @csrf

         <!-- New Password -->
         <div class="mb-3">
             <label>New Password<span class="required">*</span></label>
             <div class="password-wrapper">
                 <input type="password"
                     class="form-control"
                     name="password"
                     id="newPassword"
                     placeholder="Enter new password..."
                     required>
                 <i class="fa-regular fa-eye toggle-password"></i>
             </div>
         </div>

         <!-- Confirm Password -->
         <div class="mb-3">
             <label>Confirm New Password<span class="required">*</span></label>
             <div class="password-wrapper">
                 <input type="password"
                     class="form-control"
                     name="password_confirmation"
                     id="confirmPassword"
                     placeholder="Re-enter your new password..."
                     required>
                 <i class="fa-regular fa-eye toggle-password"></i>
             </div>
         </div>

         <div class="button-group">
             <button type="button" class="btn-back">
                 <i class="fa-solid fa-arrow-left"></i> Back
             </button>
             <button type="submit" class="btn-submit">
                 <i class="fa-solid fa-check"></i> Reset Password
             </button>
         </div>
     </form>
 </div>
 @push('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     // Toggle password visibility
     document.querySelectorAll(".toggle-password").forEach((icon) => {
         icon.addEventListener("click", function() {
             const wrapper = this.parentElement;
             const input = wrapper.querySelector("input");

             if (input.type === "password") {
                 input.type = "text";
                 this.classList.remove("fa-eye");
                 this.classList.add("fa-eye-slash");
             } else {
                 input.type = "password";
                 this.classList.remove("fa-eye-slash");
                 this.classList.add("fa-eye");
             }
         });
     });

     // Back button
     document.querySelector(".btn-back").addEventListener("click", function() {
         window.history.back();
     });

     $(document).on('submit', '#changePasswordForm', function(e) {
         e.preventDefault();

         let form = $(this);
         let submitBtn = form.find('.btn-submit');

         $.ajax({
             url: "{{ route('password.update.custom') }}",
             type: "POST",
             data: form.serialize(),
             beforeSend: function() {
                 submitBtn.prop('disabled', true)
                     .html('<i class="fa-solid fa-spinner fa-spin"></i> Updating...');
             },
             success: function(response) {

                 submitBtn.prop('disabled', false)
                     .html('<i class="fa-solid fa-check"></i> Reset Password');

                 Swal.fire({
                     icon: 'success',
                     title: 'Password Updated',
                     text: response.message,
                     confirmButtonColor: '#0d6efd'
                 }).then(() => {
                     window.location.href = "{{ route('profilepage') }}";
                 });
             },
             error: function(xhr) {

                 submitBtn.prop('disabled', false)
                     .html('<i class="fa-solid fa-check"></i> Reset Password');

                 if (xhr.status === 422) {
                     let errors = xhr.responseJSON.errors;
                     let errorText = '';

                     $.each(errors, function(key, value) {
                         errorText += value[0] + '<br>';
                     });

                     Swal.fire({
                         icon: 'error',
                         title: 'Validation Error',
                         html: errorText,
                         confirmButtonColor: '#dc3545'
                     });

                 } else {
                     Swal.fire({
                         icon: 'error',
                         title: 'Oops!',
                         text: 'Something went wrong. Please try again.',
                         confirmButtonColor: '#dc3545'
                     });
                 }
             }
         });
     });
 </script>
 @endpush

 @endsection