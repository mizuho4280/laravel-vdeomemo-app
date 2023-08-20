@extends('layouts.app')

@section('content')

    <body>


        <form action="{{ route('contents.index') }}" method="get">
            <div>
                <input type="text" name="search" placeholder="検索">
            </div>
            <button type="submit">検索</button>
        </form>



        <main>
            <article>
                <div>
                    <h1>投稿一覧</h1>
                    <div>
                        <a href="{{ route('contents.create') }}">新規投稿</a>

                        @foreach ($contents as $content)
                            <div>
                                <div>
                                    <a href="{{ route('contents.show', $content) }}">
                                        <h2>{{ $content->title }}</h2>
                                        <p><iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/pfS_gOXkCU8" title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe></p>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </article>
        </main>


    </body>
@endsection
