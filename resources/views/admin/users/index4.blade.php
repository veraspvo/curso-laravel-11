@extends('admin.layouts.app')
@section('title', 'Usuários')
@section('content')

    <h1>Usuários</h1>

    <a href="{{route('users.create')}}">Novo</a>
    <a href="{{route('dashboard')}}">Voltar</a>

<!-- Caso não use o component alert.blade.php    
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
-->
    <!-- <x-alert/> Substitui as linhas acima -->
    @include ('components.alert') <!-- substitui as linhas acima -->
    <div class="flex items-center gap-4 bg-gray-100">
    <table class="w-full divide-y divide-gray-200 grid-cols-3">
        <thead>
            <tr class="text-left ">
                <th class="bg-red-500">Nome</th>
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
                    <td>
                        <a href="{{route('users.edit', $user->id)}}">Editar</a>
                        <a href="{{route('users.show', $user->id)}}">Detalhes</a>
                    </td>
                </tr>
            @empty 
                <tr>
                    <td colspan="3">Nenhum registro encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $users->links() }}
@endsection