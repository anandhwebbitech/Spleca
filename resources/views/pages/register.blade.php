 @extends('layouts.app')
 @section('content')

    <div class="form-container my-5">
        <div class="form-header">I'm a new customer! <span style="color: #666; font-weight: normal;">or</span> <a href="#" style="color: #0066cc; text-decoration: none; font-weight: 600;">Login</a></div>

        <form id="registerForm">
            @csrf
            <!-- Account Type -->
            <!-- <div class="mb-3">
                <label for="accountType" class="form-label">Account type<span class="required">*</span></label>
                <select class="form-select"name="account_type" id="accountType" required>
                    <option value="">Select...</option>
                    <option value="personal">Personal</option>
                    <option value="business">Business</option>
                </select>
            </div> -->

            <!-- Salutation -->
            <!-- <div class="mb-3">
                <label for="salutation" class="form-label">Salutation</label>
                <select class="form-select" id="salutation"name="salutation">
                    <option value="">Not specified</option>
                    <option value="mr">Mr.</option>
                    <option value="mrs">Mrs.</option>
                    <option value="ms">Ms.</option>
                    <option value="dr">Dr.</option>
                </select>
            </div> -->

            <!-- First and Last Name -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName" class="form-label">First name<span class="required">*</span></label>
                    <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter first name..." required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName" class="form-label">Last name<span class="required">*</span></label>
                    <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Enter last name..." required>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail address<span class="required">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address..." required>
            </div>

            <!-- Password -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password<span class="required">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password..." required>
                    <div class="password-hint">Password(s) must have a minimum length of 8 characters.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="confirmPassword" class="form-label">(Password confirmation)<span class="required">*</span></label>
                    <input type="password" class="form-control"  name="password_confirmation" id="confirmPassword" placeholder="Enter your new password once again..." required>
                </div>
            </div>

            <!-- Address Section -->
            <!-- <div class="section-header">Your Address</div> -->

            <!-- Street Address and Postal Code -->
            <!-- <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="streetAddress" class="form-label">Street address<span class="required">*</span></label>
                    <input type="text" class="form-control" name="street" id="streetAddress" placeholder="Enter street address..." required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="postalcode" class="form-label">Postal code</label>
                    <input type="number" class="form-control" id="postalcode" name="postalcode" placeholder="Enter postal code...">
                </div>
            </div> -->
            <!-- Country -->
            <!-- <div class="mb-3">
                <label for="country" class="form-label">Country<span class="required">*</span></label>
                <select class="form-select" name="country_id" id="country" required>
                        <option value="">Select country</option>
                </select>
            </div> -->

            <!-- <div class="shipping-note">Shipping and billing address do not match.</div> -->

            <!-- City and State -->
            <div class="row">
                <!-- <div class="col-md-4 mb-3">
                    <label for="city" class="form-label">City<span class="required">*</span></label>
                    <input type="text" class="form-control" id="city" placeholder="Enter city..." required>
                </div> -->
                <!-- <div class="col-md-8 mb-3">
                    <label for="state" class="form-label">State<span class="required">*</span></label>
                    <select class="form-select"name="state_id" id="state"required>
                           <option value="">Select state</option>
                    </select>
                </div> -->
                <!-- <div class="col-md-8 mb-3">
                    <label for="state" class="form-label">City<span class="required">*</span></label>
                    <select class="form-select"name="city_id" id="city" required>
                           <option value="">Select city</option>
                    </select>
                </div> -->
            </div>

            

            <!-- CAPTCHA -->
            <!-- <div class="captcha-box">
                <span class="captcha-text">efRNh9E</span>
                <button type="button" class="captcha-refresh">⟲</button>
            </div>
            <div class="captcha-instruction">To continue, enter the characters shown above<span class="required">*</span></div>
            <input type="text" class="form-control mt-2" id="captcha" placeholder="Enter CAPTCHA" required> -->

            <!-- Privacy -->
            <!-- <div class="privacy-text">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="privacyCheck">
                    <label class="form-check-label" for="privacyCheck">
                        By selecting continue you confirm that you have been <a href="#">data protection information</a> and <a href="#">general terms and conditions</a>.
                    </label>
                </div>
                <div>I also read and am familiar <span class="required">*</span> my <a href="#">right of revocation</a>.</div>
            </div> -->

            <!-- Submit Buttons -->
            <div class="row g-2 justify-content-center">
                <div class="col-md-6">
                    <button type="submit" class="btn-continue">Continue</button>
                </div>

            </div>
            <div class="row justify-content-center ">
                <h4 class="text-center my-3">or</h4>
                <div class="col-md-6 ">
                    <a href="{{route('loginpage')}}" >
                        <button type="button" class="btn-login mt-0" style="background-color: #6c757d;" > Login</button>
                    </a>
                </div>
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

    const countryApi = "https://countriesnow.space/api/v0.1/countries/positions";
    const stateApi   = "https://countriesnow.space/api/v0.1/countries/states";
    const cityApi    = "https://countriesnow.space/api/v0.1/countries/state/cities";

    // LOAD COUNTRIES
    $.get(countryApi, function (response) {
        let options = '<option value="">Select country</option>';
        $.each(response.data, function (i, country) {
            options += `<option value="${country.name}">${country.name}</option>`;
        });
        $('#country').html(options);
    });

    // COUNTRY CHANGE → LOAD STATES
    $('#country').on('change', function () {
        let country = $(this).val();
        $('#state').html('<option>Loading...</option>');
        $('#city').html('<option>Select city</option>');

        $.ajax({
            url: stateApi,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ country: country }),
            success: function (response) {
                let options = '<option value="">Select state</option>';
                $.each(response.data.states, function (i, state) {
                    options += `<option value="${state.name}">${state.name}</option>`;
                });
                $('#state').html(options);
            }
        });
    });

    // STATE CHANGE → LOAD CITIES
    $('#state').on('change', function () {
        let state = $(this).val();
        let country = $('#country').val();
        $('#city').html('<option>Loading...</option>');

        $.ajax({
            url: cityApi,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                country: country,
                state: state
            }),
            success: function (response) {
                let options = '<option value="">Select city</option>';
                $.each(response.data, function (i, city) {
                    options += `<option value="${city}">${city}</option>`;
                });
                $('#city').html(options);
            }
        });
    });

});
$(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        let formData = {
            _token: $('input[name="_token"]').val(),
            account_type: $('#accountType').val(),
            salutation: $('#salutation').val(),
            first_name: $('#firstName').val(),
            last_name: $('#lastName').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#confirmPassword').val(),
            street: $('#streetAddress').val(),
            postalcode:$('#postalcode').val(),
            country: $('#country').val(),
            state: $('#state').val(),
            city: $('#city').val(),
        };

        $.ajax({
            url: "{{ route('register') }}",
            type: "POST",
            data: formData,
            beforeSend: function () {
                $('.btn-continue').prop('disabled', true).text('Processing...');
            },
            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    confirmButtonColor: '#3085d6'
                });

                $('#registerForm')[0].reset();
                $('.btn-continue').prop('disabled', false).text('Continue');
            },
            error: function (xhr) {
                $('.btn-continue').prop('disabled', false).text('Continue');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul style="text-align:left;">';

                    $.each(errors, function (key, value) {
                        errorHtml += `<li>${value[0]}</li>`;
                    });

                    errorHtml += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorHtml,
                        confirmButtonColor: '#d33'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#d33'
                    });
                }
            }
        });
    });

});
</script>
@endsection
