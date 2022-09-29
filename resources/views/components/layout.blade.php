<!doctype html>

<title>A Blog Built with Laravel</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Alpine JS -->
<script src="//unpkg.com/alpinejs" defer></script>


<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/blog-laravel/public/">
                    {{-- <img src="/blog-laravel/public/images/logo.svg" alt="Laracasts Logo" width="165" height="16"> --}}
                    <h1 class="text-2xl font-bold p-2 rounded-lg">Blog - Built with Laravel</h1>
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @guest
                    <a href="/blog-laravel/public/register" class="text-xs font-bold uppercase">Register</a>
                    <a href="/blog-laravel/public/login" class="ml-6 text-xs font-bold uppercase">Login</a>
                @else
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</button>
                        </x-slot>
                        {{-- @if(auth()->user()->can('admin')) --}}
                        {{-- @can('admin') --}}
                        @admin
                            <x-dropdown-item href="/blog-laravel/public/admin/posts" :active="request()->is('admin/posts')">
                                Manage Posts
                            </x-dropdown-item>
                            <x-dropdown-item href="/blog-laravel/public/admin/posts/create" :active="request()->is('admin/posts/create')">
                                New Post
                            </x-dropdown-item>
                        @endadmin
                        {{-- @endcan --}}
                        {{-- @endif --}}
                        <x-dropdown-item href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">
                            Log Out
                        </x-dropdown-item>
                        <form id="logout-form" action="/blog-laravel/public/logout" method="post" class="hidden">
                            @csrf
                        </form>
                    </x-dropdown>

                @endguest

                <!-- Newsletter Button -->
                {{-- <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a> --}}
            </div>
        </nav>
        
        {{ $slot }}
        
        <!-- Newsletter Section -->
        {{-- <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/blog-laravel/public/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="#" class="lg:flex text-sm">
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/blog-laravel/public/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" type="text" placeholder="Your email address" class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit" class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer> --}}
    </section>
    <x-flash />
</body>