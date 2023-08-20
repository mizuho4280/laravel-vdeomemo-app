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


                    <h1>新規投稿</h1>

                    <div>
                        <a href="{{ route('contents.index') }}">&lt; 戻る</a>
                    </div>

                    <form action="{{ route('contents.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="title">メモタイトル</label>
                            <input type="text" name="title">
                        </div>
                        <div>
                            <label for="url">動画ID　https://www.youtube.com/embed/</label>
                            <input type="text" name="url">
                        </div>
                        <div>
                            <label for="body">メモ本文</label>
                            <textarea name="body"></textarea>
                        </div>
                        <button type="submit">メモ作成</button>
                    </form>
                </div>
            </article>
        </main>

    </body>
@endsection

</html>
