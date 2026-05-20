<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Nami Lontar</title>
    <meta name="description" content="Create a Nami Lontar account to manage your orders and profile.">
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
                <a href="{{ url('/') }}" class="logo-container center">
                    <img src="{{ asset('assets/product photo/logo.png') }}" alt="Logo" height="50"
                        width="50">
                    <div class="logo">Nami Lontar</div>
                </a>
                <h2>Create Account</h2>
                <p>Please enter your details to create a new account.</p>
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

            <form class="login-form" action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login" style="margin-top: 1.5rem;">Create Account</button>
            </form>

            <p class="create-account">
                Already have an account? <a href="{{ url('/login') }}">Log In</a>
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
