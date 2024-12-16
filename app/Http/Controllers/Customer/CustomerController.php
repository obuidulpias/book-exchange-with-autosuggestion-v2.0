<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Customer\SignupRequest;
use App\Models\Customer;
use App\Repositories\Customer\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{
    protected $customer;
    /**
     * Create new Customer instance
     * 
     * @param \App\Models\Customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = new CustomerRepository($customer);
    }
    public function list()
    {
        Cache::put('cachekey', 'This is a key for testing.....', 20);
        Cache::put('cachekey2', 'This is a key for testing2.....', 1000);
        //Cache::forget('cachekey2');
        $value = Cache::store('file')->get('foo');
        //Cache::flush();//delete all with folder and file
        //$data = Cache::get('bar');
        //Redis::set('name', 'Taylor');
        //Redis::set('key', 'test Key');
        //Redis::set('1245', 'test Keyyyyy');
        $data = Redis::get('key');
        //$values = Redis::lrange('names', 5, 10);
        dd($data);
    }

    /**
     * Signup Here
     * 
     * @param \App\Http\Requests\Customer\SignupRequest;
     */
    public function signup(SignupRequest $request)
    {
        return $this->customer->create($request);
    }

    /**
     * Summary of login
     * 
     * @param \App\Http\Requests\Auth\LoginRequest;
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->customer->login($request);
    }

    /**
     * Summary of logout
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->customer->logout();
    }

    /**
     * Summary of cCustomer Details
     * 
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function customer()
    {
        return $this->customer->customer();
    }
}
