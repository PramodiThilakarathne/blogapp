<x-app-layout>
    @include('common.welcomeheader')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/contact.jpg') }}');">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="hidden md:block md:w-1/2 p-6">
                    <img src="/images/s9.svg" alt="Login Image" class="w-full h-auto">
                </div>
                <!-- Form Section -->
                <div class="md:w-1/2 p-6">
                    <div class="text-gray-900">
                        <h2 class="text-2xl font-bold mb-4">Leave Us a Feedback</h2>
                        <div class="max-w-md mx-auto bg-white shadow-md rounded overflow-hidden">
                            <div class="px-6 py-4">
                                @if (session('success'))
                                    <div class="bg-green-500 text-white p-2 rounded mb-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('contact.send') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name" class="block text-lg font-bold mb-2 text-gray-700">Name</label>
                                        <input type="text" id="name" name="name" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-lg font-bold mb-2 text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="message" class="block text-lg font-bold mb-2 text-gray-700">Feedback</label>
                                        <textarea id="message" name="message" class="w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required></textarea>
                                    </div>
                                    <button type="submit" class="bg-blue-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-md">Send Feedback</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('common.footer')
</x-app-layout>

@if(session('success'))
<script>
Swal.fire({
    title: "Good job!",
    text: "Thank you for the feedback!",
    icon: "success"
  });
</script>
@endif


