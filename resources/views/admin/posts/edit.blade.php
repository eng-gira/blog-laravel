<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form action="/blog-laravel/public/admin/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <x-form.input name="title" :value="old('title', $post->title)" required/>
            <x-form.input name="slug" :value="old('slug', $post->slug)" required/>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>
                </div>

                <img src="{{ asset('storage') . '/' . $post->thumbnail }}" alt="" class="rounded-xl ml-6 max-w-xs">
            </div>
    
            <x-form.textarea name="excerpt" required>
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>
            <x-form.textarea name="body" required>
                {{ old('body', $post->body) }}
            </x-form.textarea>
    
            
    
            <x-form.field>
                <x-form.label name="category_id"/>
                <select name="category_id" id="category_id" class="border border-gray-400 p-2 w-full" required>
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}> 
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>
                
                <x-form.error name="category_id"/>
            </x-form.field>
    
            <x-form.field>
                <x-form.button>
                    Update
                </x-form.button>
            </x-form.field>
    
        </form>
    </x-setting>
</x-layout>