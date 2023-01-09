<x-layouts.main>
    <x-slot:title>
        Post yaratish
        </x-slot>

        <x-page-header>
            Post Yaratish
        </x-page-header>
        <div class="container py-5">
            <div class="w-50 py-4">
                <div class="contact-form">
                    <div id="success"></div>
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="control-group mb-4">
                            <input type="text" class="form-control p-4" name="title" value="{{old('title')}}" placeholder="Sarlavha" />
        
                            @error('title')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{old('short_content')}}</textarea>
                            @error('short_content')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="control-group mb-4">
                            <textarea class="form-control p-4" rows="6" name="content" placeholder="Maqola">{{old('content')}}</textarea>
                            @error('content')
                            <p class="help-block text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block py-3 px-5" type="submit">Yaratish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-layouts.main>
