@extends('layouts.home', ['title' => 'Home'])

@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4"
         style="background-image: url('{{ asset('img/global/bg_1.jpg') }}');padding-top: 8em;">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7">
                    <h2 class="mb-0">Contato</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ route('index') }}">Home</a>
            <span class="mx-3 fas fa-caret-right"></span>
            <span class="current">Contato</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fname">Nome</label>
                    <input type="text" id="fname" class="form-control form-control-lg">
                </div>
                <div class="col-md-6 form-group">
                    <label for="eaddress">Email</label>
                    <input type="text" id="eaddress" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message">Mensagem</label>
                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Enviar Mensagem" class="btn btn-primary btn-lg px-5">
                </div>
            </div>
        </div>
    </div>
@endsection
