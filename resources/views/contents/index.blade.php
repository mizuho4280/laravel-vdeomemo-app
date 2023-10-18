@extends('layouts.app')
@section('content')

    <body>
        <main>
            <article>
                <div class="container">

                    @if (session('flash_message'))
                        <p>{{ session('flash_message') }}</p>
                    @endif
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('contents.store') }}">
                                    <button type="submit" name="sort" value="asc"
                                        class="btn btn-outline-secondary">新しい順</button>
                                    <button type="submit" name="sort" value="desc"
                                        class="btn btn-outline-secondary">古い順</button>
                                </form>


                            </div>
                            <div class="col">
                                <h1 class="text-center">投稿一覧</h1>
                            </div>

                            <div class="col">
                                <form action="{{ route('contents.index') }}" method="get">
                                    <input type="text" name="search" placeholder="タイトル検索">
                                    <button type="submit" class="btn btn-outline-secondary">検索</button>
                                </form>
                                <form action="{{ route('contents.index') }}" method="get">
                                    <input type="text" name="key" placeholder="タグ検索">
                                    <button type="submit" class="btn btn-outline-secondary">検索</button>
                                </form>

                            </div>
                            <!-- タグの追加用モーダル -->
                            @include('modals.add_tag')

                            <div class="container">
                                <div>



                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="card border-info mb-3 g-4">
                                                @foreach ($contents as $content)
                                                    <div class="card text-center">
                                                        <div class="card-body">
                                                            <div class="text-end">
                                                                @if ($content->memo_status == 0)
                                                                    <p>プライベート</p>
                                                                @elseif ($content->memo_status == 1)
                                                                    <p>パブリック</p>
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('contents.show', $content) }}">
                                                                <h2 class="card-title fs-2 text-center">
                                                                    {{ $content->title }}
                                                                </h2>
                                                                <p><iframe width="100%" height="315"
                                                                        src="https://www.youtube.com/embed/{{ $content->url }}"
                                                                        title="YouTube video player" frameborder="0"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                        allowfullscreen></iframe></p>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-wrap mx-1 mb-1">
                                                            @foreach ($content->tags()->orderBy('id', 'asc')->get() as $tag)
                                                                <span
                                                                    class="badge bg-secondary mt-2 me-2 fw-light">{{ $tag->name }}</span>
                                                            @endforeach
                                                        </div>
                                                        <div>
                                                            @if ($content->is_liked_by_auth_user())
                                                                <a href="{{ route('like.destroy', $content->id) }}"
                                                                    class="btn btn-success btn-sm">いいね<span
                                                                        class="badge">{{ $content->likes->count() }}</span></a>
                                                            @else
                                                                <a href="{{ route('like.store', $content->id) }}"
                                                                    class="btn btn-secondary btn-sm">いいね<span
                                                                        class="badge">{{ $content->likes->count() }}</span></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach

                                                {{-- {{ $contents->appends(request()->query())->links() }} --}}

                                            </div>

                                        </div>
                                    </div>
                                </div>
            </article>
        </main>


    </body>
@endsection
