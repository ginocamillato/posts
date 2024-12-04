<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Queries\UserQuery;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response()->json(new UserResource($user), 201);
    }

    public function update(User $user, UserRequest $request)
    {
        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        
        $user->update($data);

        return response()->json($user, 204);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    public function index()
    {
        $users = (new UserQuery)->paginate((int) request()->query('perPage', 10));

        return new UserResourceCollection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user->load(['posts']));
    }
}
