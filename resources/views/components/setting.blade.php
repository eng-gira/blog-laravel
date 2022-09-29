@props(['heading'])

<section class="px-6 py-8 max-w-4xl m-auto border border-gray-200 rounded-xl mt-6">
    <h1 class="text-lg font-bold mb-8 border-b pb-2">{{ $heading }}</h1>
    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-6">Links</h4>
            <ul>
                <li class="mb-3">
                    <a href="/blog-laravel/public/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">Manage Posts</a>
                </li>
                <li class="mb-3">
                    <a href="/blog-laravel/public/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                </li>
            </ul>
        </aside>
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>
</section>