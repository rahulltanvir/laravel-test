<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(-45deg, #4f46e5, #06b6d4, #10b981, #6366f1);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .register-wrapper {
            width: 100%;
            max-width: 1100px;
            min-height: 650px;
            display: flex;
            overflow: hidden;
            border-radius: 25px;
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, .12);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
        }

        .left-side {
            flex: 1;
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(255, 255, 255, .08);
        }

        .left-side h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .left-side p {
            font-size: 18px;
            line-height: 1.8;
            opacity: .9;
        }

        .feature {
            margin-top: 30px;
        }

        .feature p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .right-side {
            flex: 1;
            background: white;
            padding: 50px;
            display: flex;
            align-items: center;
        }

        .form-box {
            width: 100%;
        }

        .form-box h2 {
            font-weight: 800;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 35px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            background: #f8fafc;
        }

        .form-control {
            height: 55px;
            border-radius: 0 14px 14px 0;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4f46e5;
        }

        .btn-register {
            width: 100%;
            height: 55px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            color: white;
            font-weight: 700;
            font-size: 17px;
            transition: .3s;
        }

        .btn-register:hover {
            transform: translateY(-2px);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #999;
        }

        .social-btn {
            width: 100%;
            height: 50px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background: white;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
        }

        .login-link a {
            text-decoration: none;
            font-weight: 700;
        }

        @media(max-width:991px) {

            .register-wrapper {
                flex-direction: column;
            }

            .left-side {
                text-align: center;
                padding: 40px 25px;
            }

            .left-side h1 {
                font-size: 2rem;
            }

            .right-side {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

    <div class="register-wrapper">

        <!-- Left Side -->
        <div class="left-side">
            <h1>Welcome!</h1>

            <p>
                Create your account and enjoy a seamless shopping experience.
                Browse products, track orders and receive exclusive offers.
            </p>

            <div class="feature">
                <p>✔ Fast & Secure Checkout</p>
                <p>✔ Order Tracking</p>
                <p>✔ Exclusive Discounts</p>
                <p>✔ Easy Returns</p>
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">

            <div class="form-box">

                <h2>Create Account</h2>
                <p class="subtitle">
                    Join thousands of happy customers
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customer.register.post') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-telephone-fill"></i>
                        </span>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-person-plus-fill"></i>
                        Create Account
                    </button>
                </form>



                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('customer.login') }}">
                        Sign In
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>
