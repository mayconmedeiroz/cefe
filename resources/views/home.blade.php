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
                    <h1>{{ $slider->title }}</h1>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="site-section">
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
                            <!--<img src="img/global/course_1.jpg" alt="Image" class="img-fluid">-->
                            <div class="category text-center"><h3>{{ $sportClass->sport_name }}</h3></div>
                        </figure>
                        <div class="course-1-content pb-4">
                            <h2>Turma {{ $sportClass->name }}</h2>
                            <p class="desc mb-4">{{ $sportClass->sport_time }}</p>
                            <p><a href="/student/enroll/{{ $sportClass->id }}" class="btn btn-primary btn-red rounded-0 px-4">Inscrever-se na turma</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content-down')
<div class="news-updates">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9">
                <div class="section-heading">
                    <h2 class="text-black">Notícias</h2>
                    <a href="/blog">Ler todas as notícias</a>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="post-entry-big">
                            <a href="/blog/{{ $posts[0]->id }}" class="img-link"><img src="/storage/posts/{{ $posts[0]->image }}" alt="Image" class="img-fluid"></a>
                            <div class="post-content">
                                <div class="post-meta">
                                    <a href="/blog/{{ $posts[0]->id }}">{{ strftime("%d de %B de %Y", strtotime($posts[0]->created_at)) }}</a>
                                </div>
                                <h3 class="post-heading"><a href="/blog/{{ $posts[0]->id }}">{{ $posts[0]->title }}</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @foreach($posts as $post)
                            @if (!$loop->first)
                        <div class="post-entry-big horizontal d-flex mb-4">
                            <a href="/blog/{{ $post->id }}" class="img-link mr-4"><img src="/storage/posts/{{ $post->image }}" alt="Image" class="img-fluid"></a>
                            <div class="post-content">
                                <div class="post-meta">
                                    <a href="/blog/{{ $post->id }}">{{ strftime("%d de %B de %Y", strtotime($post->created_at)) }}</a>
                                </div>
                                <h3 class="post-heading"><a href="/blog/{{ $post->id }}">{{ $post->title }}</a></h3>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection