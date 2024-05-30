@extends('admin.layouts.app')
@section('title', 'Edição de Usuário')
@section('content')
    <h1>Edição do Usuário {{ $user->name }}</h1>

    <form action="{{ route('users.update', $user->id) }}" method="post">
        <!--<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        @method('put')
        @include('admin.users.partials.form')
    </form>
@endSection