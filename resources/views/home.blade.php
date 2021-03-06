@extends('layouts.home', ['title' => 'Home'])

@php
    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
@endphp

@section('content')
    <div class="hero-slide owl-carousel site-blocks-cover">
        @foreach($sliders as $slider)
            <div class="intro-section" style="background-image: url('storage/sliders/{{ $slider->image }}');">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                            <h3>{{ $slider->title }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <section class="site-section" style="{{ ($sliders == "[]") ? 'padding-top:8em' : '' }}">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6 mb-5">
                    <h2 class="section-title-underline mb-3">
                        <span>Turmas Disponíveis</span>
                    </h2>
                    <p>Para a visualização completa, acesse o <a href="/student/enroll/">painel de usuário</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-slide-3 owl-carousel">
                        @foreach($sportClasses as $sportClass)
                            <div class="course-1-item">
                                <figure class="thumnail">
                                    <div class="category text-center"><h3>{{ $sportClass->sport_name }}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    <h2>Turma {{ $sportClass->name }}</h2>
                                    <p class="desc mb-4">{{ $sportClass->sport_time }}</p>
                                    <p><a href="{{ route('student.enroll.index') }}"
                                          class="btn btn-primary btn-red rounded-0 px-4">Inscrever-se na turma</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content-down')
    @if($posts != "[]")
        <section class="news-updates">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9">
                        <div class="section-heading">
                            <h2 class="text-black">Notícias</h2>
                            <a href="{{ route('blog') }}">Ler todas as notícias</a>
                        </div>
                        <div class="row">
                            <article class="col-lg-6">
                                <div class="post-entry-big">
                                    <a href="{{ route('article.show', ['id' => $posts[0]->id]) }}" class="img-link"><img
                                                src="{{ asset('storage/article') }}/{{ ($posts[0]->image) ? $posts[0]->image : 'default.jpg' }}" alt="Image"
                                                class="img-fluid"></a>
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <a href="{{ route('article.show', ['id' => $posts[0]->id]) }}">{{ strftime("%d de %B de %Y", strtotime($posts[0]->created_at)) }}</a>
                                        </div>
                                        <h3 class="post-heading"><a
                                                    href="{{ route('article.show', ['id' => $posts[0]->id]) }}">{{ $posts[0]->title }}</a></h3>
                                    </div>
                                </div>
                            </article>
                            <div class="col-lg-6">
                                @foreach($posts as $post)
                                    @if (!$loop->first)
                                        <article class="post-entry-big horizontal d-flex mb-4">
                                            <a href="{{ route('article.show', ['id' => $post->id]) }}" class="img-link mr-4"><img
                                                        src="{{ asset('storage/article/') }}/{{ ($posts[0]->image) ? $posts[0]->image : 'default.jpg' }}" alt="Image"
                                                        class="img-fluid"></a>
                                            <div class="post-content">
                                                <div class="post-meta">
                                                    <a href="{{ route('article.show', ['id' => $post->id]) }}">
                                                        {{ strftime("%d de %B de %Y", strtotime($post->created_at)) }}
                                                    </a>
                                                </div>
                                                <h3 class="post-heading">
                                                    <a href="{{ route('article.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                                </h3>
                                            </div>
                                        </article>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
