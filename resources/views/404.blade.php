@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/error.css') }}">
@endsection
@section('content')
    <!-- 404 Content -->
    <section class="error-content">
        <div class="container">
            <div class="error-container">
                <h1 class="error-code">404</h1>
                <h2 class="error-title">Page Not Found</h2>
                <p class="error-message">Oops! It seems like the page you're looking for has gone missing. Maybe it's off exploring the digital universe without us!</p>
                
                <div class="meme-container">
                    <div class="meme-text">When you're looking for a page but it's 404</div>
                    {{-- <img src="https://i.imgflip.com/4/30b1gx.jpg" alt="404 Meme" class="meme-img"> --}}
                    {{-- <div class="meme-caption">
                        <span>#404Problems</span>
                        <span>@EventHub</span>
                    </div> --}}
                </div>                
                <a href="/" class="btn btn-primary">Take Me Home</a>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script>
        // Add floating animation to the meme container
        document.addEventListener('DOMContentLoaded', function() {
            const memeContainer = document.querySelector('.meme-container');
            memeContainer.classList.add('floating');
            
            // Focus on search input when clicked
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.boxShadow = '0 5px 20px rgba(138, 43, 226, 0.3)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.boxShadow = 'none';
            });
            
            // Search functionality
            const searchBtn = document.querySelector('.search-btn');
            searchBtn.addEventListener('click', function() {
                const query = searchInput.value.trim();
                if(query) {
                    alert(`Searching for: ${query}\nIn a real application, this would redirect to search results.`);
                }
            });
            
            // Press Enter to search
            searchInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    searchBtn.click();
                }
            });
        });
    </script>
@endsection