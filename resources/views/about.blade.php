<x-app-layout>
    @include('common.header')
    
    <div class="container mx-auto p-4 pt-6 md:p-6">
        
        <div class="space-y-12">
            <!-- Our Mission -->
            <div class="group flex flex-col md:flex-row items-center bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-indigo-50">
                <div class="md:w-1/2 p-4">
                    <img src="/images/s4.svg" alt="Our Mission" class="rounded-lg shadow-md w-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="md:w-1/2 p-4">
                    <h2 class="text-2xl font-bold text-indigo-900 mb-4 group-hover:text-indigo-700 transition-colors duration-300">Our Mission</h2>
                    <p class="text-gray-700">
                        Our mission is to provide the best service to our clients and make a significant impact in the industry.
                    </p>
                </div>
            </div>
    
            <!-- Our Goal -->
            <div class="group flex flex-col md:flex-row-reverse items-center bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-indigo-50">
                <div class="md:w-1/2 p-4">
                    <img src="/images/s5.svg" alt="Our Goal" class="rounded-lg shadow-md w-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="md:w-1/2 p-4">
                    <h2 class="text-2xl font-bold text-indigo-900 mb-4 group-hover:text-indigo-700 transition-colors duration-300">Our Goal</h2>
                    <p class="text-gray-700">
                        Our goal is to achieve excellence through innovation and dedication to our customers.
                    </p>
                </div>
            </div>
    
            <!-- Our Story -->
            <div class="group flex flex-col md:flex-row items-center bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-indigo-50">
                <div class="md:w-1/2 p-4">
                    <img src="/images/s3.svg" alt="Our Story" class="rounded-lg shadow-md w-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="md:w-1/2 p-4">
                    <h2 class="text-2xl font-bold text-indigo-900 mb-4 group-hover:text-indigo-700 transition-colors duration-300">Our Story</h2>
                    <p class="text-gray-700">
                        Our story began with a vision to create something unique and valuable for our community.
                    </p>
                </div>
            </div>
    
            <!-- Our Partners -->
            <div class="group flex flex-col md:flex-row-reverse items-center bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:bg-indigo-50">
                <div class="md:w-1/2 p-4">
                    <img src="/images/s6.svg" alt="Our Partners" class="rounded-lg shadow-md w-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="md:w-1/2 p-4">
                    <h2 class="text-2xl font-bold text-indigo-900 mb-4 group-hover:text-indigo-700 transition-colors duration-300">Our Partners</h2>
                    <p class="text-gray-700">
                        We are proud to collaborate with industry leaders and innovators who share our vision.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    @include('common.footer')
</x-app-layout>
