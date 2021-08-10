@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
    <h1 class="mb-6 text-4xl font-sans ...">{{$topic -> title}}</h1>
        @auth
        <form action="{{route('posts.add', $topic)}}" method="post" class="mb-4 border-b-2 border-solid border-gray-200">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4"
                 class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                 placeholder="Post something!"></textarea>

                 @error('body')
                    <div class="text-red-500 mt-2 text-sm">{{$message}}</div>    
                 @enderror
            </div>

            <div class="flex flex-row-reverse">
                <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded font-medium mb-2">Post</button>
            </div>
        </form>
        @endauth

        @if($posts->count())
            @foreach($posts as $post)
                <div class="border-b-2 border-solid border-gray-200 mt-4 mb-4 pb-4">
                    <div class="flex flex-row items-baseline justify-between">
                        <div>
                            <a href="" class="font-bold">{{$post->user->username}}</a>
                            <span class="text-gray-600 text-sm pl-4">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                                       
                    
                        <div class="flex">
                            @auth                       
                            @if($post->likedBy(auth()-> user()))
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="pr-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-green-400">Unlike</button>
                                </form>
                            @else
                                <form action="{{ route('posts.likes', $post) }}" method="post" class="pr-4">
                                    @csrf
                                    <button type="submit" class="text-green-400">Like</button>
                                </form>
                            @endif                             
                            @endauth
                            <span>{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}}</span>
                        </div>
                    </div>    
                    
                       
                    <p class="mb-2">{{$post->body}}</p>

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded">Delete</button>
                        </form>
                    @endcan
                </div>
            @endforeach
            {{$posts -> links()}}
        @else
            @guest
            <h1>No posts yet!</h1> 
            @endguest   
        @endif
    </div>
</div>
@endsection