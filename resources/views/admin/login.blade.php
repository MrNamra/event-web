@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h1 class="login-title">Login</h1>
                </div>
                <div class="login-body">
                    <form id="login-form" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">ID</label>
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your ID" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-key input-icon"></i>
                            <input type="password" class="form-control" id="password" name  ="password" placeholder="Enter your password" required>
                        </div>
                        <div class="remember-forgot">
                            <div class="remember-me">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary login-btn">Sign In</button>
                    </form>
                    
                    <div class="security-notice">
                        <h4><i class="fas fa-shield-alt"></i> Security Notice</h4>
                        <p>This portal is restricted to authorized personnel only. Any unauthorized access attempts will be logged and may be subject to legal action.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // const loginForm = document.getElementById('login-form');
            
            // Add pulse animation to the login button
            // const loginBtn = document.querySelector('.login-btn');
            // loginBtn.classList.add('pulse');
            
            // Form submission
            // loginForm.addEventListener('submit', function(e) {
            //     e.preventDefault();
                
            //     const username = document.getElementById('email').value;
            //     const password = document.getElementById('password').value;
                
            //     // Remove pulse animation during submission
            //     loginBtn.classList.remove('pulse');
                
            //     // Change button text to show loading
            //     loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
            //     loginBtn.disabled = true;
                
            //     // Simulate authentication process
            //     setTimeout(function() {
            //         // For demo purposes, accept any non-empty credentials
            //         if (username && password) {
            //             // Success feedback
            //             loginBtn.innerHTML = '<i class="fas fa-check"></i> Login Successful!';
            //             loginBtn.style.background = 'linear-gradient(45deg, #00b4d8, #4cc9f0)';
                        
            //             // Redirect to admin panel (simulated)
            //             setTimeout(function() {
            //                 alert('Login successful! Redirecting to admin panel...');
            //                 window.location.href = 'admin-panel.html'; // Change to your admin panel URL
            //             }, 1000);
            //         } else {
            //             // Error feedback
            //             loginBtn.innerHTML = 'Sign In';
            //             loginBtn.disabled = false;
            //             loginBtn.classList.add('pulse');
            //             alert('Please enter both username and password.');
            //         }
            //     }, 1500);
            // });
            
            // Add interactive effects to form inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = "#8a2be2";
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#888';
                });
            });
        });
    </script>
@endsection