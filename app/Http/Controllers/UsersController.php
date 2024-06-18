<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController
{
    public function index()
    {
        $users = DB::table('users')
            ->selectRaw('id, Name as "Nome",
        email,
        permission as Permissão, 
        position as Cargo
        ')
            ->orderByDesc('id');
        $users = $users->paginate(15);

        $message = session('success.message');
        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $users->nextPageUrl() ? $users->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $users->previousPageUrl() ? $users->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        return view('users.index')
            ->with('users', $users)
            ->with('successMessage', $message)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('/users')
            ->with("success.message", "Usuário '{$request['name']}' adicionado com sucesso!")
            ->with("teste", "teste");
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('Users.edit', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->except(['_token', '_method']);
        $data['password'] = Hash::make($data['password']);

        $user->update($data);

        return redirect('/users')
            ->with("success.message", "Usuário '$request->name' atualizado com sucesso!");
    }


    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->input('delete_id'));
        $name = $user['name'];

        $user->delete();
        return redirect('/users')
            ->with("success.message", "Usuário '{$name}' excluído com sucesso!");
    }
}
