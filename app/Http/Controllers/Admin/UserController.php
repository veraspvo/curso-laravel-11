<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
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
    public function import(Request $request){
        // Validar arquivo
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:1024',

        ],[
            'file.required' => 'Selecione o arquivo CSV',
            'file.mimes' => 'O arquivo deve ser um arquivo CSV',
            'file.max' => 'O arquivo deve ter no máximo :max Kb',]);
        
        // Criar a array com as colunas do banco de dados
        $headers = ['name', 'email', 'email_verified_at','password'];
    
        // ######################################################## 
        // PRIMEIRA MANEIRA DE FAZER A LEITURA DO ARQUIVO
        // Ler o arquivo CSV
        $file = fopen($request->file('file'), 'r');
        // Ler o arquivo linha por linha;
        $users = [];
        while (($row = fgetcsv($file)) !== false) {
            // Converter a linha em array
            $users[] = array_combine($headers, $row);
        }
        fclose($file);
        // Inseririr no BD
        User::insert($users);
        // FIM DA PRIMEIRA MANEIRA DE FAZER A LEITURA DO ARQUIVO
        // ########################################################
        

    /*
        // SEGUNDA MANEIRA DE FAZER A LEITURA DO ARQUIVO CASO A SEPARAÇÃO NÃO FOR O PADRAO CSV
        // receber o arquivo CSV, ler os dados e converter em array
        $dataFile = $request->file('file'); // recebe o arquivo CSV
        //faz a leitura do arquivo CSV
        $dataFile = file($dataFile);
        // Converter os dados lidos do arquivo CSV em array
        $dataFile = array_map('str_getcsv', $dataFile);
        // percorre o array e insere os dados no BD
        foreach ($dataFile as $keyData => $row) {
            // CONVERTER A LINHA EM ARRAY
            $values = explode(';', $row[0]);
            // PERCORRER AS COLUNAS DO CABEÇALHO
            foreach ($headers as $key => $header) {
                // PERCORRER AS COLUNAS DO ARRAY DE VALORES
                $arrayValues[$keyData][$header] = $values[$key];
            }
        }
        // inserir registros no BD
        // User::insert($arrayValues);
        // ########################################################
        // FIM DA SEGUNDA MANEIRA DE FAZER A LEITURA DO ARQUIVO
    */
    }
    public function index5() 
    {
        $users = User::all();
        //dd($users);
        return view ('users/index5', compact('users'));
    
    }
    public function create() 
    {
        return view('admin/users/create');
    }
    public function store(StoreUserRequest $request)
    {
        //dd($request->all());
        //return "Cadastrando o usuário ...";
        User::create($request->validated());
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
    public function update(UpdateUserRequest $request, string $id)
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
        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()
            ->route('users.index4')
            ->with('success', 'Usuário editado com sucesso!');    
    }
    public function show(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()
            ->route('users.index4')
            ->with('message', 'Usuário não encontrado!');
        }
        //$ver = in_array($user->email, config('custom.admins'));
        //dd($user);
        return view('admin.users.show', compact('user'));
    }
    public function destroy(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()
            ->route('users.index4')
            ->with('message', 'Usuário não encontrado!');
        }
        if (Auth::user()->id === $user->id) {
            return back()
            ->with('message', 'Você não pode deletar o usuário que esta logado!');
        }
        $user->delete();
        return redirect()
             ->route('users.index4')
             ->with('success', 'Usuário deletado com sucesso!');
    }
}
