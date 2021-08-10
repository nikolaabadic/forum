@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
    @auth
        <form action="{{route('topics')}}" method="post" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="title" class="sr-only">Title</label>
                <textarea name="title" id="title" cols="30" rows="4"
                 class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
                 placeholder="Add a topic!"></textarea>

                 @error('title')
                    <div class="text-red-500 mt-2 text-sm">{{$message}}</div>    
                 @enderror
            </div>

            <div class="flex flex-row-reverse">
                <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded font-medium">Add topic</button>
            </div>
        </form>
        @endauth

        @if($topics->count())
            <h1 class="text-3xl mb-6">Choose a topic</h1>
            @foreach($topics as $topic)
                <div class="border-b-2 border-solid border-gray-200 flex items-center mt-4 mb-4 pb-4">
                    <a href="{{route('topics.get', $topic)}}" class="text-lg pr-4">{{$topic->title}}</a>
                    <a href="" class="font-bold pr-1">{{$topic->user->username}}</a>
                    <span class="text-gray-600 text-sm">{{$topic->created_at->diffForHumans()}}</span>   
                    
                    @can('delete', $topic)
                    <form action="{{ route('topics.destroy', $topic) }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-green-800 text-white px-3 py-1 rounded font-medium ml-3">Delete</button>
                    </form>
                    @endcan
                </div>
            @endforeach
            {{$topics -> links()}}
        @endif
    </div>
</div>
@endsection