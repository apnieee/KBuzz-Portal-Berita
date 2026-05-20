@extends('layouts.app')

@section('title', $author->user->name)

@section('content')
    <!-- Author -->
    <div class="flex gap-4 items-center mb-10 p-10 bg-primary"> 
      <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile" class="rounded-full max-w-28">
      <div class="">
        <p class="font-bold text-lg text-white">{{ $author->user->name }}</p>
        <p class="text-white">{{ $author->bio }}</p>
      </div>
    </div>

    <!-- Berita -->
    <div class="flex flex-col gap-5 px-4 lg:px-14">
      @if($author->news->count() > 0) 
        @foreach ($author->news as $news)
          <a href="{{ route('news.show', $news->slug) }}">
            <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out" style="height: 100%;">
              <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                {{ $news->newsCategory->title }}
              </div>
              <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="" class="w-full rounded-xl mb-3" style="height: 200px; object-fit: cover;">
              <p class="font-bold text-base mb-1">{{ $news->title }}</p>
              <p class="text-slate-400">{{\Carbon\Carbon::parse($news->created_at)->format('d F Y') }}</p>
            </div>
          </a>
        @endforeach
      </div>
      @else
        <p class="text-slate-400 text-center">Author ini belum memiliki berita.</p>
      @endif
    </div>
@endsection