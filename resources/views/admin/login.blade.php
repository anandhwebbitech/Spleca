<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Spleca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #5d95eaff, #91b9f6ff);
            min-height: 100vh;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-box {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        /* .login-left {
            background: linear-gradient(
                rgba(13,110,253,0.9),
                rgba(13,110,253,0.9)
            ),
            url('https://images.unsplash.com/photo-1581090700227-1e37b190418e') center/cover;
            color: #fff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h2 {
            font-weight: 700;
        }

        .login-left p {
            font-size: 15px;
            opacity: 0.9;
        } */
        .login-left {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: #fff;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-left img {
            max-width: 220px;
            margin-bottom: 25px;
        }

        .login-left h2 {
            font-weight: 700;
        }

        .login-left p {
            font-size: 15px;
            opacity: 0.9;
        }

        .login-right {
            padding: 40px;
        }

        .brand-logo img {
            height: 45px;
        }

        .login-right h4 {
            color: #0d6efd;
            font-weight: 600;
        }

        .form-control {
            height: 46px;
            border-radius: 10px;
        }

        .btn-login {
            height: 46px;
            border-radius: 10px;
            font-weight: 600;
        }

        .forgot-link {
            font-size: 14px;
        }

        @media(max-width: 768px) {
            .login-left {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-box row g-0">

            <!-- LEFT BRAND SECTION -->
            <div class="col-md-6 login-left">
                <img src="{{ asset('asset/img/logo.png') }}" alt="Spleca Logo">
                <h2>Welcome Back!</h2>
                <p>
                    Login to manage your orders, track shipments,
                    and explore industrial solutions with Spleca.
                </p>
            </div>

            <!-- RIGHT FORM SECTION -->
            <div class="col-md-6 login-right">

                <div class="brand-logo mb-4 text-center">
                    <!-- Replace with your logo -->
                    <img src="{{ asset('asset/img/logo.png') }}" alt="Spleca">
                </div>

                <h4 class="text-center mb-4">Sign in to your account</h4>

                <form id="loginForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <small class="text-danger error-email"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        <small class="text-danger error-password"></small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login">
                        Login
                    </button>
                </form>

                <div class="alert alert-danger mt-3 d-none" id="loginError"></div>
                <!-- <p class="text-center mt-4 mb-0">
                Don’t have an account?
                <a href="#" class="text-primary fw-semibold">Register</a>
            </p> -->

            </div>

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$('#loginForm').submit(function (e) {
    e.preventDefault();

    $('.error-email, .error-password').text('');
    $('#loginError').addClass('d-none');

    $.ajax({
        url: "{{ route('admin.login.submit') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function (response) {
            if (response.status === true) {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                if (errors.email) {
                    $('.error-email').text(errors.email[0]);
                }
                if (errors.password) {
                    $('.error-password').text(errors.password[0]);
                }
            } else {
                $('#loginError')
                    .removeClass('d-none')
                    .text(xhr.responseJSON.message);
            }
        }
    });
});
</script>
</body>

</html>