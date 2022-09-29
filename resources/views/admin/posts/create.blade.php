<x-layout>
    <x-setting heading="Publish New Post">
        <form action="/blog-laravel/public/admin/posts" method="post" enctype="multipart/form-data">
            @csrf
            
            <x-form.input name="title" required/>
            <x-form.input name="slug" required/>
            <x-form.input name="thumbnail" type="file" required/>
    
            <x-form.textarea name="excerpt" required/>
            <x-form.textarea name="body" required/>
    
            
    
            <x-form.field>
                <x-form.label name="category_id"/>
                <select name="category_id" id="category_id" class="border border-gray-400 p-2 w-full" required>
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> 
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>
                
                <x-form.error name="category_id"/>
            </x-form.field>
    
            <x-form.field>
                <x-form.button>
                    Publish
                </x-form.button>
            </x-form.field>
    
        </form>
    </x-setting>
</x-layout>