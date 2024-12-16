<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\ExchangeRequest;
use App\Models\Exchange;
use App\Repositories\Book\ExchangeRepository;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    protected $exchange;
    /**
     * Create new Customer instance
     * 
     * @param \App\Models\Exchange
     */
    public function __construct(Exchange $exchange)
    {
        $this->exchange = new ExchangeRepository($exchange);
    }

    /**
     * Book Exchange Registration Here
     * 
     * @param \App\Http\Requests\Book\ExchangeRequest;
     */
    public function create(ExchangeRequest $request)
    {
        return $this->exchange->create($request);
    }
}
