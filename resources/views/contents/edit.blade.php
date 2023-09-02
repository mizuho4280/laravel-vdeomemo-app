@extends('layouts.app')

@section('content')

    <body>
        <main>
            <article>
                <div class="container">


                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="float-start">
                        <a href="{{ route('contents.index') }}">&lt; 戻る</a>
                    </div>
                    <div>
                        <h1 class="text-center">編集 </h1>
                    </div>
                    <br>

                    <form action="{{ route('contents.update', $content) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="title" class="form-label">メモタイトル</label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ $content->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">動画ID　(https://www.youtube.com/watch?v=......)</label>
                            <input type="text" class="form-control" name="url"
                                value="{{ $content->url }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">メモ本文</label>
                            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $content->body }}</textarea>
                        </div>
                        <button type="submit">メモ更新</button>
                    </form>
                </div>


            </article>
        </main>

    </body>
@endsection
