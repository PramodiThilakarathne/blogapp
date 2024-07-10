<x-slot name="header">
    
<div class="flex justify-end items-center">
    <div class="flex items-center gap-x-2">
        <a href="{{ route('profile.edit') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Profile</a>
        <a href="{{ route('about') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">About Us</a>
        <a href="{{ route('contact') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Contact Us</a>
        <a href="{{ route('welcome') }}" class="text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Home</a>
    </div>
</div>

    </x-slot>