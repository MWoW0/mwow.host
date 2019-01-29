@extends('layouts.app')

@section('content')
    <div class="container mx-auto min-h-screen">
        <h1 class="text-grey-darker text-center font-thin tracking-wide text-5xl mb-6">
            {{ __('Latest news') }}
        </h1>

        <ul class="list-reset">
            @foreach($news as $article)
                <div class="w-full lg:flex p-2">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ Storage::disk('public')->url($article->photo_url) }}')" title="News photo">
                    </div>
                    <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2">{{ $article->title }}</div>
                            <p class="text-grey-darker text-base">
                                {!!  Parsedown::instance()->parse($article->body) !!}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full mr-4" src="{{ $article->author->gravatar_url }}" alt="Gravatar of author.name">
                            <div class="text-sm">
                                <p class="text-black leading-none">{{ config('app.name') }} Staff</p>
                                <p class="text-grey-dark">{{ $article->published_at->toDayDateTimeString() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>
        {{ $news->links('pagination.tailwind') }}
    </div>
@endsection
