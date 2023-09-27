 {{-- <!DOCTYPE html>
<html>
    <head>
        <title>Blog/Index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
        <h1>The index method inside the blog folder</h1> --}}
        {{-- <a href={{ route('blog.show',['id'=>1]) }}> Blog</a> --}}
        {{-- first method --}}
        {{-- <h1>
        {{ $posts->title }}  <br><br>
        {{ $posts->body }}
        </h1> --}}

                {{-- second method --}}
                    {{-- {{ dump($posts) }} --}}



                    {{-- control structure --}}
{{--
                    @if (count($posts < 100))
                            <h1>
                                {{ dd( $sposts )}}
                            </h1>
                     @elseif (count($posts === 305))

                              <h1>
                              You have exactly 305 postts
                              </h1>

                    @else

                            <h1>
                                NO posts
                            </h1>

                    @endif --}}

                    {{-- @unless ($posts)
                        <h1>
                            Posts has been added
                        </h1>
                    @endunless --}}

                    {{-- @forelse ($posts as $post ) --}}
                        {{-- {{ $post->title }} --}}
                        {{-- {{ $loop->index }} --}}
                        {{-- {{ $loop->iteration }} --}}
                        {{-- {{ $loop->remaining }} --}}
                        {{-- {{ $loop->count }} --}}
                        {{-- {{ $loop->first }} --}}
                        {{-- {{ $loop->depth }} --}}
                        {{-- {{ $loop->parent }} --}}
                    {{-- @empty
                         <h1>No title has been set</h1>
                    @endforelse --}}
     {{-- </body> --}}
{{-- </html> --}}

 {{-- {{$name}} --}}


<html>
    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        />
        <meta
            http-equiv="X-UA-Compatible"
            content="ie=edge"
        />
        <title>
            Laravel App
        </title>
        {{-- <link
            rel="stylesheet"
            href="{{ asset('css/app.css') }}"
        /> --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="w-full h-full bg-gray-100">
        <div class="w-4/5 mx-auto pb-10">
            <div class="text-center pt-20">
                <h1 class="text-3xl text-gray-700">
                    All Articles
                </h1>
                <hr class="border border-1 border-gray-300 mt-10">
            </div>

                @if (Auth::user())
                <div class="py-10 sm:py-20">
                    <a class="primary-btn inline text-base sm:text-xl bg-green-500 py-4 px-4 shadow-xl rounded-full transition-all hover:bg-green-400"
                       href="{{ route('blog.create') }}">
                        New Article
                    </a>
                </div>
                @endif
        </div>

                        @if (session()->has('message'))
                        <div class="mx-auto w-4/5 pb-10">
                                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                    Warning..
                                </div>

                                <div class="border border-t-1 border-red-400  rounded-b bg-red-100  px-4  text-red-700">
                                            {{ session()->get('message') }}
                                </div>
                        </div>

                        @endif

        @foreach($posts as $post)
            <div class="w-4/5 mx-auto pb-10">
                <div class="bg-white pt-10 rounded-lg drop-shadow-2xl sm:basis-3/4 basis-full sm:mr-8 pb-10 sm:pb-0">
                    <div class="w-11/12 mx-auto pb-10">
                        <h2 class="text-gray-900 text-2xl font-bold pt-6 pb-0 sm:pt-0 hover:text-gray-700 transition-all">
                            <a href="{{ route('blog.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-gray-900 text-lg py-8 w-full break-words">
                            {{ $post->excerpt }}
                        </p>

                        <span class="text-gray-500 text-sm sm:text-base">
                        Made by:
                            <a href=""
                               class="text-green-500 italic hover:text-green-400 hover:border-b-2 border-green-400 pb-3 transition-all">
                                {{ $post->user->name }}
                            </a>
                        on  {{ $post->updated_at->format('d/m/Y') }}
                    </span>
                      @if (Auth::id() === $post->user->id)
                      <a href="{{ route('blog.edit',$post->id) }}" class="block italic text-green-500
                        border-b-1 border-green-400">Edit</a>

                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="pt-1 text-red-5OO pr-3"  type="submit">
                            Delete</button>
                        </form>

                      @endif
                    </div>
                </div>
            </div>
        @endforeach

                    {{-- <div class="mx-100 pb-10 w-4/5" > --}}
                    <div class="mx-auto pb-10 w-4/5" >
                     {{ $posts->links() }}



                    </div>
    </body>
    </html>
