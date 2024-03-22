<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController
{
    public function index()
    {
        $query = User::query();
        $users = $query->paginate(15);

        $nextPage = $users->nextPageUrl();
        $previusPage = $users->previousPageUrl();
        $message = session('success.message');

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
        ->with("success.message", "Usuário '{$request['name']}' adicionado com sucesso!"); 
    }


    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->input('users_id'));
        $name = $user['name'];

        $user->delete();
        return redirect('/users')
            ->with("success.message", "Usuário '{$name}' excluído com sucesso!");
    }
}
