<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nami Lontar</title>
    <meta name="description" content="Login to your Nami Lontar account to manage your orders and profile.">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <main class="login-page">
        <div class="login-card">
            <div class="login-header">
                <div class="center">
                    <img src="{{ asset('assets/Logo.png') }}" alt="Logo" height="200" width="200">
                </div>
                <h2>Welcome Back</h2>
                <p>Please enter your details to access your account.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger" style="color: red; margin-bottom: 1rem; font-size: 0.9rem;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="login-form" action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-options">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="remember">
                        <span class="checkmark"><i class="fa-solid fa-check"></i></span>
                        <span class="checkbox-label">Keep me logged in for 30 days</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">Log In</button>

                <div class="social-login">
                    <div class="social-divider">
                        <span>Or continue with</span>
                    </div>
                    <div class="social-buttons">
                        <button type="button" class="btn-social">
                            <i class="fa-brands fa-google"></i>
                            <span>Google</span>
                        </button>
                        <button type="button" class="btn-social">
                            <i class="fa-brands fa-apple"></i>
                            <span>Apple</span>
                        </button>
                    </div>
                </div>
            </form>

            <p class="create-account">
                Don't have an account? <a href="{{ url('/register') }}">Create an account</a>
            </p>
        </div>

        <footer class="login-footer">
            <div class="container">
                <p>&copy; 2024 NAMI LONTAR. ALL RIGHTS RESERVED.</p>
            </div>
        </footer>
    </main>
</body>

</html>