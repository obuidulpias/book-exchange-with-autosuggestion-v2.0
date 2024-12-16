<?php
namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Auth;
use DB;

class BookRepository extends BaseRepository
{
    protected $book;
    public function __construct(Book $book)
    {
        $this->book = new BaseRepository($book);
    }

    public function create($data)
    {
        //dd($customer->id);
        DB::beginTransaction();
        try {
            $customer = Auth::guard('customer-api')->user();
            $book_arr = [
                'customer_id' => $customer->id,
                'title' => $data['title'],
                'author' => $data['author'],
                'category_id' => $data['category_id'],
                'sub_category_id' => $data['sub_category_id'],
            ];
            $this->book->create($book_arr);
            DB::commit();
            return $this->response = apiResponse($book_arr);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }
}