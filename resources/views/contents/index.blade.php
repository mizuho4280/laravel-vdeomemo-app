@extends('layouts.app')

@section('content')

    <body>


        <form action="{{ route('contents.index') }}" method="get">
            <div>
                <input type="text" name="search" placeholder="検索">
                <button type="submit">検索</button>
            </div>
        </form>



        <main>
            <article>
                <div>
                    <h1>投稿一覧</h1>
                    <div>
                        <a href="{{ route('contents.create') }}">新規投稿</a>
                        <div>
                            <form action="{{ route('contents.store') }}">
                                <button type="submit" name="sort" value="asc">新しい順</button>
                                <button type="submit" name="sort" value="desc">古い順</button>
                            </form>
                        </div>
                        @foreach ($contents as $content)
                            <div>
                                <div>
                                    <a href="{{ route('contents.show', $content) }}">
                                        <h2>{{ $content->title }}</h2>
                                        <p><iframe width="560" height="315"
                                                src="https://www.youtube.com/embed/{{ $content->url }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe></p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        {{ $contents->links() }}
                    </div>
                </div>
            </article>
        </main>


    </body>
@endsection
