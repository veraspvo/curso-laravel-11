@extends('admin.layouts.app')
@section('title', 'Usuários')
@section('content')
    <h1>Usuários</h1>

    <a href="{{route('users.create')}}">Novo</a>

<!-- Caso não use o component alert.blade.php    
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
-->
    <!-- <x-alert/> Substitui as linhas acima -->
    @include ('components.alert') <!-- substitui as linhas acima -->
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Melhor usar o forelse
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>-</td>
                </tr>
            @endforeach
             -->
            <!-- Usando o forelse -->
            @forelse ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>-</td>
                </tr>
            @empty 
                <tr>
                    <td colspan="3">Nenhum registro encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
@endsection