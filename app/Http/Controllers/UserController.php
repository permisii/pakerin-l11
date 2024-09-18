<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use App\Models\Unit;
use App\Models\User;
use App\Support\Enums\IntentEnum;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index(Request $request) {

        $intent = $request->get('intent');

        switch ($intent) {
            case IntentEnum::USER_GET_DATATABLE_DATA:
                $query = User::with('unit');

                if ($request->has('unit_id') && $request->unit_id != '') {
                    $query->where('unit_id', $request->unit_id);
                }

                return datatables()->eloquent($query)
                    ->addColumn('options', function ($user) {
                        return view('users.partials.options', compact('user'))->render();
                    })
                    ->editColumn('unit', function ($user) {
                        return $user->unit->name;
                    })
                    ->editColumn('active', function ($user) {
                        return $user->active ? '<span class="badge badge-success">YES</span>' : '<span class="badge badge-danger">NO</span>';
                    })
                    ->rawColumns(['options', 'active'])
                    ->make(true);
        }

        if ($request->ajax()) {
        }

        $query = User::with('unit');

        if ($request->has('unit_id') && $request->unit_id != '') {
            $query->where('unit_id', $request->unit_id);
        }

        $users = UserResource::collection($query->paginate(5));
        $units = UnitResource::collection(Unit::all());

        return view('users.index', compact('users', 'units'));
    }

    public function create() {
        $units = UnitResource::collection(Unit::all());

        return view('users.create', compact('units'));
    }

    public function store(StoreUserRequest $request) {
        User::create($request->validated());

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function show(User $user) {
        $user = new UserResource($user->load('unit', 'updatedBy', 'createdBy'));

        return view('users.show', compact('user'));
    }

    public function edit(User $user) {
        $units = UnitResource::collection(Unit::all());
        $user = new UserResource($user->load('unit', 'updatedBy', 'createdBy'));

        return view('users.edit', compact('user', 'units'));
    }

    public function update(UpdateUserRequest $request, User $user) {
        $data = $request->only(['name', 'email', 'nip', 'unit_id', 'active']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
