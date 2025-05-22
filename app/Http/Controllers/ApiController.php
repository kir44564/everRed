<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            Log::warning('User not found', ['id' => $id]);
            return response()->json(['error' => 'User not found'], 404);
        }
        
        return response()->json($user);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);
            
            $validated['password'] = bcrypt($validated['password']);
            $user = User::create($validated);
            
            return response()->json($user, 201);
        } catch (ValidationException $e) {
            Log::info('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('User creation failed', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            Log::warning('User not found for update', ['id' => $id]);
            return response()->json(['error' => 'User not found'], 404);
        }
        
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $id,
                'password' => 'sometimes|required|string|min:6',
            ]);
            
            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }
            
            $user->update($validated);
            
            return response()->json($user);
        } catch (ValidationException $e) {
            Log::info('Validation failed on update', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('User update failed', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            Log::warning('User not found for deletion', ['id' => $id]);
            return response()->json(['error' => 'User not found'], 404);
        }
        
        try {
            $user->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('User deletion failed', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}