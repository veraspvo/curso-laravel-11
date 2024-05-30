@extends('admin.layouts.app')
@section('title', 'Edição de Usuário')
@section('content')
    <h1>Edição do Usuário {{ $user->name }}</h1>


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


    <form action="{{ route('users.update', $user->id) }}" method="post">
        <!--<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        @csrf()
        @method('put')
        <input type="text" name="name" placeholder="Nome" value="{{ $user->name }}">
        <input type="email" name="email" placeholder="E-mail" value="{{ $user->email }}">
        <!-- <input type="password" name="password" placeholder="Senha"> -->
        <button type="submit">Enviar</button>
    </form>
@endSection