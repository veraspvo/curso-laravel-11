@extends('admin.layouts.app')
@section('title', 'Novo Usuário')
@section('content')
    <h1>Novo Usuário</h1>


 <!-- Caso não use o component alert.blade.php
   @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
-->
     <x-alert/> <!--Substitui as linhas acima -->


    <form action="{{ route('users.store') }}" method="post">
        <!--<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        @csrf()
        <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}">
        <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
        <input type="password" name="password" placeholder="Senha">
        <button type="submit">Enviar</button>
    </form>
@endSection