<x-slot name="header">
    
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center gap-x-2">
                <a href="{{ route('profile.edit') }}" class="ml-4 text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Profile</a>
                <a href="{{ route('about') }}" class="ml-4 text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">About Us</a>
                <a href="{{ route('contact') }}" class="ml-4 text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Contact Us</a>
                <a href="{{ route('welcome') }}" class="ml-4 text-sm text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out py-2 px-4 rounded-full bg-blue-100 hover:bg-blue-200">Home</a>
            </div>
        </div>
    </x-slot>