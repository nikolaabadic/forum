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

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Add topic</button>
            </div>
        </form>
        @endauth

        @if($topics->count())
            @foreach($topics as $topic)
                <div class="mb-4">
                    <a href="" class="font-bold">{{$topic->user->username}}</a>
                    <span class="text-gray-600 text-sm">{{$topic->created_at->diffForHumans()}}</span>   
                    <a href="{{route('topics.get', $topic)}}" class="mb-2">{{$topic->title}}</a>

                    @can('delete', $topic)
                    <form action="{{ route('topics.destroy', $topic) }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
                    @endcan
                </div>
            @endforeach
            {{$topics -> links()}}
        @endif
    </div>
</div>
@endsection