<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\RegistrationRequest;
use App\Models\Book;
use App\Repositories\Book\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $book;
    /**
     * Create new Customer instance
     * 
     * @param \App\Models\Book
     */
    public function __construct(Book $book)
    {
        $this->book = new BookRepository($book);
    }

    /**
     * Book Registration Here
     * 
     * @param \App\Http\Requests\Book\RegistrationRequest;
     */
    public function create(RegistrationRequest $request)
    {
        return $this->book->create($request);
    }
}
