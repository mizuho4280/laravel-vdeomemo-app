@extends('layouts.app')

@section('content')

    <body>

        <main>
            <article>
                <div class="container">

                    @if (session('flash_message'))
                        <p>{{ session('flash_message') }}</p>
                    @endif

                    <div class="float-start">
                        <a href="{{ route('contents.index') }}">&lt; 戻る</a>
                    </div>

                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
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

                                    <p class="fs-3" style="white-space:pre-wrap;">{{ $content->body }}</p>

                                    <div class="d-flex flex-wrap mx-1 mb-1">
                                        @foreach ($content->tags()->orderBy('id', 'asc')->get() as $tag)
                                            <span class="badge bg-secondary mt-2 me-2 fw-light">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>


                                    <a href="{{ route('contents.edit', $content) }}" class="btn btn-outline-primary">編集</a>

                                    @include('modals.delete')
                                    <a class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $content->id }}">削除</a>
                                </div>
                            </div>



                        </div>

                    </div>
            </article>
        </main>



    </body>
@endsection
