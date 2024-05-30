<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Actions
    public function index() 
    {
        return 'UserController@index';
    }
    public function index2() 
    {
        $user = User::first();
        //return $user->name;
        return "Olá {$user->name}! ({$user->email})";
    }
    public function index3() 
    {
        $user = User::first();
        //return "Olá {$user->name}! ({$user->email})";
        return view('admin/users/index', compact('user'));
    }
    public function index4() 
    {
        //$users = User::all(); // Retorna todos os registros. Semelhante ao get()
        //dd($users); // Usado para debug
        $users = User::paginate(10);
        return view('admin/users/index4', compact('users'));
    }
    public function create() 
    {
        return view('admin/users/create');
    }
    public function store(StoreUserRequest $request)
    {
        //dd($request->all());
        //return "Cadastrando o usuário ...";
        User::create($request->all());
        return redirect()
        ->route('users.index4')
        ->with('success', 'Usuário criado com sucesso!');
    }
    public function edit(string $id)
    {
        //dd($id);
        //return view('admin/users/edit', compact('user'));
//        $user::where('id', '=', $id)->first();
//        $user::where('id', $id)->first(); // ->firstOrFail()
//        $user = User::find($id); // Retorna um registro ou um valor de nulo 
        if (!$user = User::find($id)) {
            return redirect()
            ->route('users.index4')
            ->with('message', 'Usuário não encontrado!');
        }

        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // dd($id);
        //$user = User::find($id);
        //$user->update($request->all());
        //return redirect()
        //->route('users.index4')
        //->with('success', 'Usuário atualizado com sucesso!');

        if (!$user = User::find($id)) {
             return back()->with('message', 'Usuário não encontrado!');
        }
        $user->update($request->only('name', 'email'));
        return redirect()
        ->route('users.index4')
        ->with('success', 'Usuário editado com sucesso!');    
    }
}
