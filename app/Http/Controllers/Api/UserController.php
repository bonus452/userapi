<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class UserController extends Controller
{

    public function index(): JsonResponse
    {
        $users = User::paginate(100);
        UserResource::collection($users);
        return response()->json($users);
    }

    public function show(int $user_id): JsonResponse
    {
        $user = User::find($user_id);
        if($user instanceof User){
            return response()->json(new UserResource($user));
        }else{
            return response()
                ->json(['errors' => [ __('api.user_not_found', compact('user_id')) ]])
                ->setStatusCode(404);
        }

    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        try {
            $user = User::create($request->validated());
            return response()->json(new UserResource($user));
        }catch (Exception $exception){
            Log::error($exception);
            return response()
                ->json(['errors' => [ __('api.user_not_created') ]])
                ->setStatusCode(500);
        }

    }

    public function update(int $user_id, UserUpdateRequest $request): JsonResponse
    {
        $user = User::find($user_id);
        if($user instanceof User){
            if($user->update($request->validated())){
                return response()->json(new UserResource($user));
            }else{
                return response()
                    ->json(['errors' => [ __('api.user_not_updated', compact('user_id')) ]])
                    ->setStatusCode(400);
            }
        }else{
            return response()
                ->json(['errors' => [ __('api.user_not_found', compact('user_id')) ]])
                ->setStatusCode(404);
        }
    }

    public function destroy(int $user_id): JsonResponse
    {
        $user = User::find($user_id);
        if($user instanceof User){
            if($user->delete()){
                return response()->json(['result' => __('api.user_deleted_successful', compact('user_id'))]);
            }else{
                return response()
                    ->json(['errors' => [ __('api.user_not_deleted', compact('user_id')) ]])
                    ->setStatusCode(400);
            }
        }else{
            return response()
                ->json(['errors' => [ __('api.user_not_found', compact('user_id')) ]])
                ->setStatusCode(404);
        }
    }

}
