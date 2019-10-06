@extends('layouts.home', ['title' => 'Home'])

@php
    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
@endphp

@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
         style="background-image: url('{{ asset('img/global/bg_1.jpg') }}');padding-top: 8em;">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">Notícias</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('index') }}">Home</a>
            <span class="mx-3 fas fa-caret-right"></span>
            <span class="current">Notícias</span>
        </div>
    </div>

    <section class="site-section">
        <div class="news-updates" style="padding: 0;">
            <div class="container">
                <div class="row">
                    @foreach($posts as $post)
                        <article class="col-lg-4 col-md-6 mb-4">
                            <div class="post-entry-big">
                                <a href="/blog/{{ $post->id }}" class="img-link"><img
                                            src="/storage/posts/{{ $post->image }}" alt="Image" class="img-fluid"></a>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <a href="/blog/{{ $post->id }}">{{ strftime("%d de %B de %Y", strtotime($post->created_at)) }}</a>
                                    </div>
                                    <h3 class="post-heading"><a href="/blog/{{ $post->id }}">{{ $post->title }}</a></h3>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        $('.pagination').addClass('justify-content-center');
    </script>
@endsection
