<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .footer-section {
            width: 30%;
            text-align: center;
        }

        .footer-link {
            text-decoration: none;
            color: #000;
            margin: 5px 0;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: #333;
        }

        .social-icon {
            font-size: 1.5rem;
            color: #606060;
            margin: 0 10px;
            transition: transform 0.3s, color 0.3s;
        }

        .social-icon:hover {
            color: #000;
            transform: scale(1.2);
        }
</style>
</head>




<body>

    <footer class="bg-blue-200 shadow-md rounded px-8 py-6 mt-12 mb-4 flex justify-between">
        <!-- Left Section -->
        <div class="footer-section">
            <div class="flex justify-center mb-4">
                <a href="#" target="_blank" class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" target="_blank" class="social-icon">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" target="_blank" class="social-icon">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" target="_blank" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>

        <!-- Middle Section -->
        <div class="footer-section">
            <div class="flex flex-col items-center mb-4">
                <h4 class="text-lg font-bold text-gray-800 mb-2">Quick Links</h4>
                <nav class="flex flex-col items-center">
                    <a href="{{ route('profile.edit') }}" class="footer-link">Profile</a>
                    <a href="{{ route('about') }}" class="footer-link">About Us</a>
                    <a href="{{ route('contact') }}" class="footer-link">Contact Us</a>
                </nav>
            </div>
        </div>

        <!-- Right Section -->
        <div class="footer-section">
            <div class="flex flex-col items-center mb-4">
                <img src="/images/b2.jpeg" alt="Humpty Dumpty" class="w-12 h-12 rounded-full mb-2">
                <h4 class="text-lg font-bold text-gray-800">My Blog</h4>
                <p class="text-gray-600">koralalagejayaneththi@gmail.com</p>
            </div>
        </div>
    </footer>


