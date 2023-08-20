@extends('layouts.app')

@section('content')

    <body>

        <main>
            <article>
                <div>

                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1>編集 </h1>

                    <div>
                        <a href="{{ route('contents.show', $content) }}">&lt; 戻る</a>
                    </div>

                    <form action="{{ route('contents.update', $content) }}" method="post">
                        @csrf
                        @method('patch')
                        <div>
                            <label for="title">メモタイトル</label>
                            <input type="text" name="title" id="title" value="{{ $content->title }}">
                        </div>
                        <div>
                            <label for="url">動画ID　https://www.youtube.com/embed/</label>
                            <input type="text" name="url" value="{{ $content->url }}"></textarea>
                        </div>
                        <div>
                            <label for="body">メモ本文</label>
                            <textarea name="body">{{ $content->body }}</textarea>
                        </div>
                        <button type="submit">メモ更新</button>
                    </form>
                </div>
            </article>
        </main>

    </body>
@endsection
