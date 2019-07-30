@extends('layouts.home', ['title' => 'Sobre'])

@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
         style="background-image: url('{{ asset('img/global/bg_1.jpg') }}');padding-top:8em;">
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

    <div class="container pt-5 mb-5">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="section-title-underline">
                    <span>Lorem ipsum dolor sit</span>
                </h2>
            </div>
            <div class="col-lg-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, iure dolorum! Nam veniam tempore
                    tenetur aliquam architecto, hic alias quia quisquam, obcaecati laborum dolores. Ex libero cumque
                    veritatis numquam placeat?</p>
            </div>
            <div class="col-lg-4">
                <p>Nam veniam tempore tenetur aliquam
                    architecto, hic alias quia quisquam, obcaecati laborum dolores. Ex libero cumque veritatis numquam
                    placeat?</p>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <img src="{{ asset('img/global/course_1.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <h2 class="section-title-underline mb-5">
                        <span>Lorem ipsum dolor sit</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At itaque dolore libero corrupti!
                        Itaque, delectus?</p>
                    <p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum
                        totam facere.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0">
                    <img src="{{ asset('img/global/course_1.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-lg-5 mr-auto align-self-center order-2 order-lg-1">
                    <h2 class="section-title-underline mb-5">
                        <span>Lorem ipsum dolor sit</span>
                    </h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At itaque dolore libero corrupti!
                        Itaque, delectus?</p>
                    <p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum
                        totam facere.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
