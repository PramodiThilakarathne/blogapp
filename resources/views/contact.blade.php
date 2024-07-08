<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('about') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">About Us</a>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Profile</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Leave Us a Message</h2>
                    <div class="max-w-md mx-auto bg-white shadow-md rounded overflow-hidden">
                        <div class="px-6 py-4">
                            <form>
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-lg font-bold mb-2 text-gray-700">Name</label>
                                    <input type="text" id="name" name="name" value="" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-lg font-bold mb-2 text-gray-700">Email</label>
                                    <input type="email" id="email" name="email" value="" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="block text-lg font-bold mb-2 text-gray-700">Message</label>
                                    <textarea id="message" name="message" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                                </div>
                                <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-md">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>