@extends('layouts.dashboard', ['title' => 'Solicitar troca de modalidade'])

@section('content')
    <div class="list-div p-4">
        <div class="form-group">
            <label for="message">Mensagem</label>
            <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <input type="submit" value="Enviar Mensagem" class="btn btn-primary btn-lg px-5">
    </div>
@endsection
