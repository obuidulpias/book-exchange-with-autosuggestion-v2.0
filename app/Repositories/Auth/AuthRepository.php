<?php
namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use Auth;
use DB;
use Hash;

class AuthRepository extends BaseRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = new BaseRepository($user);
    }
    public function create($data)
    {
        //dd($data);
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            $token = $user->createToken($data['name'])->accessToken;
            DB::commit();
            $data_arr = [
                'data' => $user,
                'token' => $token
            ];
            return $this->response = apiResponse($data_arr);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
            //return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(),], 500);
        }
    }

    public function login($data)
    {
        try {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = Auth::user();
                $token = $user->createToken($user->name)->accessToken;
                $data_arr = [
                    'data' => $user,
                    'token' => $token
                ];
                return $this->response = apiResponse($data_arr, 'User loged in successfully');
            } else {
                return $this->response = apiResponse('', 'User info are not correct. Please try valid info.', '401');
            }

        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
            //return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(),], 500);
        }
    }

    public function logout()
    {
        $accessToken = Auth::guard('api')->user()->token();
        $accessToken->revoke();
        return $this->response = apiResponse('', 'User loged out successfully', 'Success');
    }

    public function users()
    {
        try {
            $user = User::all();
            return $this->response = apiResponse($user, 'Users data fetch successfully');
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }
}