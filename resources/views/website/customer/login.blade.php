<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background: linear-gradient(135deg,#4e73df,#224abe);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:Arial, Helvetica, sans-serif;
        }

        .login-card{
            width:100%;
            max-width:420px;
            background:#fff;
            border-radius:20px;
            padding:40px;
            box-shadow:0 20px 40px rgba(0,0,0,.2);
            animation:fadeIn .5s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(20px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .login-card h2{
            font-weight:700;
            text-align:center;
            margin-bottom:10px;
        }

        .login-card p{
            text-align:center;
            color:#777;
            margin-bottom:30px;
        }

        .form-control{
            height:50px;
            border-radius:12px;
            margin-bottom:18px;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:#4e73df;
        }

        .input-group-text{
            border-radius:12px 0 0 12px;
            background:#fff;
        }

        .btn-login{
            width:100%;
            height:50px;
            border:none;
            border-radius:12px;
            background:#4e73df;
            color:#fff;
            font-size:18px;
            font-weight:600;
            transition:.3s;
        }

        .btn-login:hover{
            background:#224abe;
        }

        .register-link{
            text-align:center;
            margin-top:20px;
        }

        .register-link a{
            text-decoration:none;
            font-weight:600;
        }
    </style>

</head>
<body>

<div class="login-card">

    <h2>Customer Login</h2>
    <p>Welcome Back! Login to your account.</p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('customer.login.post') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-envelope-fill"></i>
            </span>
            <input
                type="email"
                name="email"
                class="form-control"
                placeholder="Enter Email"
                required>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="bi bi-lock-fill"></i>
            </span>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Enter Password"
                required>
        </div>

        <button type="submit" class="btn-login">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </button>

    </form>

    <div class="register-link">
        Don't have an account?
        <a href="{{ route('customer.register') }}">
            Register
        </a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>