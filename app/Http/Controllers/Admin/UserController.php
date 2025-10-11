<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserService $service) {}

    public function index()
    {
        $users = User::orderBy('name')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.users.index')->with('success','Usuário criado.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->service->update($user, $request->validated());
        return redirect()->route('admin.users.index')->with('success','Usuário atualizado.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->service->delete($user);
        return redirect()->route('admin.users.index')->with('success','Usuário removido.');
    }
}

