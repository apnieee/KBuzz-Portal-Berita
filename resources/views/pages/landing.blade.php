@extends('layouts.app')

@section('title', 'kbuzz | korean pop buzz')

@section('content')

    <!-- swiper -->
    <div class="swiper mySwiper mt-9">
      <div class="swiper-wrapper">
        @foreach ($banners as $banner)
          @if($banner->news && $banner->news->author)
          <div class="swiper-slide">
            <a href="{{ route('news.show' , $banner->news->slug) }}" class="block">
              <div class="relative flex flex-col gap-1 justify-end p-3 h-72 rounded-xl bg-cover bg-center overflow-hidden"
                style="background-image: url('{{ asset('storage/' . $banner->news->thumbnail) }}')">
                <div class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t from-[rgba(0,0,0,0.4)] to-[rgba(0,0,0,0)] rounded-b-xl">
                </div>
                <div class="relative z-10 mb-3" style="padding-left: 10px;">
                  <div class="bg-primary text-white text-xs rounded-lg w-fit px-3 py-1 font-normal mt-3">
                    {{ $banner->news->newsCategory->title }}
                  </div>
                  <p class="text-3xl font-semibold text-white mt-1">{{ $banner->news->title }}</p>
                  <div class="flex items-center gap-1 mt-1">
                    <img src="{{ asset('storage/' . $banner->news->author->avatar) }}" alt="" 
                    class="w-5 h-5 rounded-full">
                    <p class="text-white text-xs">{{ $banner->news->author->user->name }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endif
        @endforeach
      </div>
    </div>

    <!-- Berita Unggulan -->
    <div class="flex flex-col px-14 mt-10 ">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Unggulan</p>
          <p>Untuk Kamu</p>
        </div>
        <a href="{{ route('news.index') }}"
          class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
          Lihat Semua
        </a>
      </div>
      <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($featured as $item)
            <a href="{{ route('news.show' , $item->slug) }}">
          <div
            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
            style="height: 100%">
            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
              {{  $item->newsCategory->title }}
            </div>
            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="" 
              class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover;">
            <p class="font-bold text-base mb-1">{{ $item->title }}</p>
            <p class="text-slate-400">{{\Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
          </div>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Berita Terbaru -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
      <div class="flex flex-col md:flex-row w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Terbaru</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- Berita Utama -->
        <div
          class="relative col-span-7 lg:row-span-3 border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer">
          <a href="{{ route('news.show' , $news[0]->slug) }}">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-5 mt-5 absolute">
              {{ $news[0]->newsCategory->title }}
            </div>
            <img src="{{ asset('storage/' . $news[0]->thumbnail) }}" alt="berita1" class="rounded-2xl">
            <p class="font-bold text-xl mt-3">
              {{ $news[0]->title }}
            </p>
            <p class="text-slate-400 text-base mt-1">
              {!! \Str::limit($news[0]->content ?? '', 100) !!}
            </p>
            <p class="text-slate-400 text-base mt-1">{{\Carbon\Carbon::parse($news[0]->created_at)->format('d F Y') }}</p>
          </a>
        </div>

        <!-- Berita 1 -->
        @foreach ($news->skip(1) as $item)
        <a href="{{ route('news.show' , $item->slug) }}"
        class="relative col-span-5 flex flex-col md:flex-row gap-4 border border-slate-200 p-3 rounded-xl hover:border-primary transition">
            <div class="bg-primary text-white rounded-full w-fit px-4 py-1 ml-2 mt-2 absolute text-sm">
                {{ $item->newsCategory->title ?? 'News' }}
            </div>
            <img 
                src="{{ asset('storage/' . $item->thumbnail) }}" 
                alt="berita"
                class="rounded-xl w-full md:w-[220px] h-[180px] object-cover flex-shrink-0">
            <div class="flex-1">
                <p class="font-bold text-lg leading-snug">
                    {{ $item->title }}
                </p>
                <p class="text-slate-400 mt-2 text-sm leading-relaxed">
                    {!! \Str::limit(strip_tags($item->content ?? ''), 120) !!}
                </p>
            </div>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Author -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Kenali Author</p>
          <p>Terbaik Dari Kami</p>
        </div>
        <a href="/admin/register" class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit">
          Gabung Menjadi Author
        </a>
      </div>
      <div class="grid grid-cols-1  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <!-- Author 1 -->
        @foreach ($authors as $author)
        <a href="{{ route('author.show' , $author->username) }}">
          <div
            class="flex flex-col items-center border border-slate-200 px-4 py-8 rounded-2xl hover:border-primary hover:cursor-pointer">
            <img src="{{ asset('storage/' . $author->avatar) }}" alt="" class="rounded-full w-24 h-24">
            <p class="font-bold text-xl mt-4">{{ $author->user->name }}</p>
            <p class="text-slate-400">{{ $author->news->count() }} Berita</p>
          </div>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Pilihan Author -->
    <div class="flex flex-col px-14 mt-10 mb-10">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Pilihan Author</p>
        </div>
      </div>
      <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($news as $article)
            <a href="{{ route('news.show' , $article->slug) }}">
          <div
            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
            style="height: 100%">
            <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
              {{ $article->newsCategory->title }}
              </div>
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="" 
              class="w-full rounded-xl mb-3" style="height: 200px; object-fit: cover;">
            <p class="font-bold text-base mb-1">
              {{ $article->title }}
            </p>
            <p class="text-slate-400">{{\Carbon\Carbon::parse($article->created_at)->format('d F Y') }}</p>
          </div>
        </a>
        @endforeach
      </div>
    </div>
@endsection