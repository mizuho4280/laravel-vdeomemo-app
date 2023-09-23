@extends('layouts.app')
@section('content')

    <body>
        <main>
            <article>
                <div class="container">

                    @if (session('flash_message'))
                        <p>{{ session('flash_message') }}</p>
                    @endif

                    <div class="float-end">
                        <form action="{{ route('contents.index') }}" method="get">
                            <input type="text" name="search" placeholder="検索">
                            <button type="submit" class="btn btn-outline-secondary">検索</button>
                        </form>
                    </div>
                    <div class="float-start">
                        <form action="{{ route('contents.store') }}">
                            <button type="submit" name="sort" value="asc"
                                class="btn btn-outline-secondary">新しい順</button>
                            <button type="submit" name="sort" value="desc"
                                class="btn btn-outline-secondary">古い順</button>
                        </form>
                    </div>
                    <!-- タグの追加用モーダル -->
                    @include('modals.add_tag')
                    <a href="#" class="ms-4 link-dark text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#addTagModal">
                        <div class="d-flex align-items-center">
                            <span class="fs-5 fw-bold">＋</span>&nbsp;タグの追加
                        </div>
                    </a>
                    <div>
                        <h1 class="text-center fs-2 ">投稿一覧</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @foreach ($contents as $content)
                                <div class="card text-center">
                                    <div class="card-body">
                                        @if ($content->memo_status == 0)
                                            <p>プライベート</p>
                                        @elseif ($content->memo_status == 1)
                                            <p>パブリック</p>
                                        @endif
                                        <a href="{{ route('contents.show', $content) }}">
                                            <h2 class="card-title fs-2 text-center">{{ $content->title }}</h2>
                                            <p><iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/{{ $content->url }}"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe></p>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap mx-1 mb-1">
                                        @foreach ($content->tags()->orderBy('id', 'asc')->get() as $tag)
                                            <span class="badge bg-secondary mt-2 me-2 fw-light">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            {{ $contents->links() }}

                        </div>

                    </div>
                </div>
            </article>
        </main>


    </body>
@endsection
