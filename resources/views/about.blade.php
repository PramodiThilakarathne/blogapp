<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('contact') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Contact Us</a>
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold py-2 px-4 rounded mx-1">Profile</a>
        </div>
    </x-slot>

    <div class="container mx-auto p-4 pt-6 md:p-6">
        <div x-data="carousel()" class="relative w-full h-64 overflow-hidden rounded-lg shadow-md">
            <div class="carousel-inner relative w-full h-full">
                <!-- Carousel items -->
                <template x-for="(image, index) in images" :key="index">
                    <div x-show="currentIndex === index" class="carousel-item absolute w-full h-full transition-all duration-500 ease-in-out">
                        <img :src="image.src" :alt="'Image ' + (index + 1)" class="w-full h-full object-cover rounded-lg" />
                    </div>
                </template>
            </div>
            <!-- Carousel navigation -->
            <button @click="prevSlide" class="carousel-control-prev absolute top-1/2 left-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 bg-black bg-opacity-50 rounded-full cursor-pointer group">
                <span class="carousel-control-prev-icon inline-block w-4 h-4 bg-white" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button @click="nextSlide" class="carousel-control-next absolute top-1/2 right-4 transform -translate-y-1/2 z-30 flex items-center justify-center w-10 h-10 bg-black bg-opacity-50 rounded-full cursor-pointer group">
                <span class="carousel-control-next-icon inline-block w-4 h-4 bg-white" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
            <!-- Carousel indicators -->
            <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2 z-30">
                <template x-for="(image, index) in images" :key="index">
                    <button @click="currentIndex = index" :class="{
                        'bg-blue-600': currentIndex === index,
                        'bg-white': currentIndex !== index
                    }" class="w-2 h-2 rounded-full focus:outline-none" aria-current="true" :aria-label="'Slide ' + (index + 1)"></button>
                </template>
            </div>
        </div>

        <!-- Blog content -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md prose prose-lg">
            <p>A blog (a truncation of "weblog") is an informational website consisting of discrete, often informal diary-style text entries (posts). Posts are typically displayed in reverse chronological order so that the most recent post appears first, at the top of the web page. In the 2000s, blogs were often the work of a single individual, occasionally of a small group, and often covered a single subject or topic. In the 2010s, "multi-author blogs" (MABs) emerged, featuring the writing of multiple authors and sometimes professionally edited. MABs from newspapers, other media outlets, universities, think tanks, advocacy groups, and similar institutions account for an increasing quantity of blog traffic. The rise of Twitter and other "microblogging" systems helps integrate MABs and single-author blogs into the news media. Blog can also be used as a verb, meaning to maintain or add content to a blog.</p>

            <p>The emergence and growth of blogs in the late 1990s coincided with the advent of web publishing tools that facilitated the posting of content by non-technical users who did not have much experience with HTML or computer programming. Previously, knowledge of such technologies as HTML and File Transfer Protocol had been required to publish content on the Web, and early Web users therefore tended to be hackers and computer enthusiasts. As of the 2010s, the majority are interactive Web 2.0 websites, allowing visitors to leave online comments, and it is this interactivity that distinguishes them from other static websites. In that sense, blogging can be seen as a form of social networking service. Indeed, bloggers not only produce content to post on their blogs but also often build social relations with their readers and other bloggers. Blog owners or authors often moderate and filter online comments to remove hate speech or other offensive content. There are also high-readership blogs which do not allow comments.</p>
        </div>
    </div>

    <script>
        function carousel() {
            return {
                currentIndex: 0,
                images: [
                    { src: '/images/h2.jpg' },
                    { src: '/images/b2.jpeg' },
                    { src: '/images/b1.jpeg' },
                    { src: '/images/b5.png' },
                ],
                prevSlide() {
                    this.currentIndex = (this.currentIndex === 0) ? this.images.length - 1 : this.currentIndex - 1;
                },
                nextSlide() {
                    this.currentIndex = (this.currentIndex === this.images.length - 1) ? 0 : this.currentIndex + 1;
                },
                init() {
                    setInterval(() => {
                        this.nextSlide();
                    }, 3000);

                    this.$watch('currentIndex', () => {
                        const carouselItems = document.querySelectorAll('.carousel-item');
                        carouselItems.forEach((item, index) => {
                            item.style.display = (index === this.currentIndex) ? 'block' : 'none';
                        });
                    });
                }
            };
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('carousel', carousel);
        });
    </script>
</x-app-layout>
