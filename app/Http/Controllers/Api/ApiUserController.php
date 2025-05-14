<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
      public function index()
    {
        return response()->json(ApiUser::all());
    }

    // GET a single user by ID
    public function show($id)
    {
        return response()->json(ApiUser::findOrFail($id));
    }

    // POST - Create a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'user_type' => 'required|in:admin,user',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = ApiUser::create($validated);

        return response()->json($user, 201);
    }

    // PUT - Update a user
    public function update(Request $request, $id)
    {
        $user = ApiUser::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'age' => 'sometimes|integer',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'user_type' => 'sometimes|in:admin,user',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|string',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    // DELETE - Delete a user
    public function destroy($id)
    {
        $user = ApiUser::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = ApiUser::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
}
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out successfully']);
}

}
