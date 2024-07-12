<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="relative bg-blue-200 shadow-md rounded px-8 py-6 mt-12 mb-4">
    <div class="flex justify-center mb-4">
        <img src="/images/b2.jpeg" alt="Humpty Dumpty" class="w-12 h-12 rounded-full mr-6">
        <h4 class="text-lg font-bold text-gray-800">My Blog</h4>
    </div>
    
    <div class="flex justify-center mb-4">
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="#" target="_blank" class="text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">
            <i class="fab fa-instagram"></i>
        </a>
    </div>

    <div class="flex justify-center mb-4">
        <h4 class="text-lg font-bold text-gray-800">Quick Links</h4>
    </div>
    <nav class="flex justify-center mb-4">
        <a href="{{ route('profile.edit') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">Profile</a>
        <a href="{{ route('about') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">About Us</a>
        <a href="{{ route('contact') }}" class="text-black-600 hover:text-gray-900 transition duration-300 ease-in-out mr-4">Contact Us</a>
    </nav>
    <div class="text-center text-black-600 text-sm">
        <p>© 2024 — myblog.net . All Rights Reserved.</p>
    </div>

    <button id="scroll-to-top-btn" class="absolute bottom-4 right-4 bg-gray-800 text-white rounded-full p-2 hover:bg-gray-700 focus:outline-none">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const scrollToTopBtn = document.getElementById('scroll-to-top-btn');


        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
