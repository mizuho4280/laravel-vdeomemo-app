@extends('layouts.app')

@section('content')

    <body>

        <main>
            <article>
                <div>
                    <h1>詳細</h1>

                    @if (session('flash_message'))
                        <p>{{ session('flash_message') }}</p>
                    @endif

                    <div>
                        <a href="{{ route('contents.index') }}">&lt; 戻る</a>
                    </div>


                    <div>
                        <div>
                            <h2>{{ $content->title }}</h2>
                            <p><iframe width="560" height="315" src="{{ $content->url }}" title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe></p>
                            <p>{{ $content->body }}</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('contents.edit', $content) }}">編集</a>
                    </div>
                </div>

                <div>
                    @include('modals.delete')
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete{{ $content->id }}">削除</a>
                </div>


                </div>
            </article>
        </main>



    </body>
@endsection
