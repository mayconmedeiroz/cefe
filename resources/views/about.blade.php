@extends('layouts.home', ['title' => 'Sobre'])

@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
         style="background-image: url('{{ asset('img/bg_1.jpg') }}');padding-top:8em;">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">Sobre</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('index') }}">Home</a>
            <span class="mx-3 fas fa-caret-right"></span>
            <span class="current">Sobre</span>
        </div>
    </div>

    <section class="container pt-5 mb-5">
        <article class="row">
            <div class="col-lg-4">
                <h2 class="section-title-underline">
                    <span>Sobre o CEFE</span>
                </h2>
            </div>
            <div class="col-lg-4">
                <p>O CEFE é uma das partes mais importantes do campus.</p>
            </div>
            <div class="col-lg-4">
                <p>A Educação Física é uma disciplina muito significativa, porém, por diversas vezes, pouco valorizada na grade curricular. Ela insere, adapta e incorpora o aluno no saber corporal de movimento, sua função é formar o cidadão qualificando-o.</p>
            </div>
        </article>
    </section>

    <section class="site-section">
        <div class="container">
            <article class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{ asset('img/course_1.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Facilidade para os estudantes</span>
                    </h2>
                    <p>Através do site o estudante não terá problemas como ter que se deslocar ao centro esportivo fisicamente.</p>
                </div>
            </article>

            <article class="row">
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{ asset('img/course_1.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                    <h2 class="section-title-underline mb-5">
                        <span>Facilidades para o ambiente</span>
                    </h2>
                    <p>O lançamento de notas online, facilidade de acesso ao diario.</p>
                </div>
            </article>
        </div>
    </section>
@endsection
