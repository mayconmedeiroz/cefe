@extends('layouts.home', ['title' => 'News'])

@php
    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');
@endphp

@section('content')
<div class="site-section ftco-subscribe-1 site-blocks-cover bg-light pb-4" style="background-image: url('{{ asset('img/global/bg_1.jpg') }}');padding-top: 8em;">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">{{ $post->title }}</h2>
              <p>{{ strftime("%d de %B de %Y", strtotime($post->created_at)) }}</p>
            </div>
          </div>
        </div>
      </div>
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{ route('index') }}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Notícias</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="post post-content col-md-9 mb-4">
                    {!!  $post->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $('img').addClass('img-fluid');
        $('.post-content p, .post-content span').css('font-family','Muli');
    </script>
@endsection