<?php
namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use Auth;
use DB;
use Hash;

class CustomerRepository extends BaseRepository
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = new BaseRepository($customer);
    }

    public function create($data)
    {
        //dd($data);
        DB::beginTransaction();
        try {
            $customer = new Customer();
            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->password = Hash::make($data['password']);
            $customer->save();

            $token = $customer->createToken($data['name'])->accessToken;
            DB::commit();
            $data_arr = [
                'data' => $customer,
                'token' => $token
            ];
            return $this->response = apiResponse($data_arr);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }

    public function login($data)
    {
        try {
            // $customer = Auth::guard('customer-api')->user();
            // dd($customer);
            if (Auth::guard('customer')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $customer = Auth::guard('customer')->user();
                $token = $customer->createToken($customer->name)->accessToken;
                $data_arr = [
                    'data' => $customer,
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
        $accessToken = Auth::guard('customer-api')->user()->token();
        $accessToken->revoke();
        return $this->response = apiResponse('', 'User loged out successfully', 'Success');
    }

    public function customer()
    {
        try {
            // $customer = Auth::guard('customer-api')->user();
            // dd($customer);
            $customer = Auth::guard('customer-api')->user();
            return $this->response = apiResponse($customer, 'Customer data Found.');

        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
            //return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(),], 500);
        }
    }
}