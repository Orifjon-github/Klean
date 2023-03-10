<x-layouts.main>
    <x-slot:title>
        Post O'zgartirish #{{$post->id}}
        
        </x-slot>

        <x-page-header>
            Post O'zgartirish #{{$post->id}}
        </x-page-header>
        <div class="container py-5">
            <div class="w-50 py-4">
                <div class="contact-form">
                    <div id="success"></div>
                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{$post->title}}" placeholder="Sarlavha" />
        
                            @error('title')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <input type="file" class="form-control p-4" name="photo" placeholder="Rasm" />
        
                            @error('photo')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{$post->shorts_content}}</textarea>
                            @error('short_content')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="6" name="content" placeholder="Maqola">{{$post->content}}</textarea>
                            @error('content')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block py-3 px-5" type="submit">Yaratish</button>
                            <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-danger btn-block py-3 px-5" type="submit">Bekor qilish</a>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-layouts.main>