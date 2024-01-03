<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\StoreUserRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Resources\V1\User\UserCollection;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return  new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'success' => true,
            "message" => "User created successfully",
            // "data" => $user,
            // 'token' => $user->createToken(config('app.key'))->plainTextToken,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        return response()->json([
            'success' => true,
            "message" => "User created successfully",
            "data" => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return response()->json([
            'success' => true,
            "message" => "User deleted successfully",
            "data" => $user->delete(),
        ]);
    }


    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'success' => true,
            "message" => "User registered successfully",
            // "data" => $user,
            // 'token' => $user->createToken($request->validated('email'))->plainTextToken,
        ]);
    }

    // public function login(LoginRequest $request)
    // {
    //     $user = User::where('email', $request->validated('email'))->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'success' => false,
    //             "errors" => "The provided credentials are incorrect."
    //         ], 401);
    //     };

    //     // return $user->createToken($request->validated('email'))->plainTextToken;

    //     return response()->json([
    //         'success' => true,
    //         "message" => "You have logged in successfully",
    //         "user" => $user,
    //         'token' => $user->createToken($request->validated('email'))->plainTextToken,
    //     ]);
    // }

    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->validated('email'))->firstOrFail();
            // Use firstOrFail to throw an exception if user not found

            if (!Hash::check($request->password, $user->password)) {
                throw new AuthenticationException('Invalid credentials.');
            }

            $token = $user->createToken($request->validated('email'))->plainTextToken;

            return response()->json([
                'success' => true,
                "message" => "You have logged in successfully",
                "user" => $user->makeHidden('password'), // Exclude password for security
                'token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                "errors" => $e->getMessage(), // Return a generic error message for security
                "message" => $e->getMessage()
            ], 401);
        }
    }


    public function userByUuid(User $user)
    {
        return response()->json($user);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}
