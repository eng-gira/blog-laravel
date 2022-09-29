<x-layout>


    <!-- <h3>A blog, the creating of which started in August 2022.</h3>
    <hr>
    <br>
    @foreach ($posts as $post)
    <a href="/blog-laravel/public/posts/{{$post->slug}}">{{ $post->title; }}</a>
    <p>
        By <a href="/blog-laravel/public/authors/{{$post->author->username}}">{{ $post->author->name }}</a>
    </p>
    <div>{{ $post->excerpt; }}</div>
    <a href="/blog-laravel/public/categories/{{$post->category_id}}">{{ $post->category->name }}</a>
    <hr>
    <br>
    @endforeach -->


    @include('posts._header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count() > 0)
            <x-post-featured-card :post="$posts[0]" />
        @else
            <p>No posts yet. Please come back later.</p>
        @endif
        @if($posts->count() > 1)
            <div class="lg:grid lg:grid-cols-2">
                @php
                    $upperLimit = $posts->count() < 3 ? $posts->count() : 3;   
                @endphp
                @for ($i=1; $i < $upperLimit; $i++)
                    <x-some-post :post="$posts[$i]"/>
                @endfor
            </div>
        @endif
        @if($posts->count() > 3)
            <div class="lg:grid lg:grid-cols-3">
                @for ($i=3; $i<$posts->count(); $i++)
                    <x-some-post :post="$posts[$i]"/>
                @endfor
            </div>
        @endif

        {{$posts->links()}}
    </main>

</x-layout>