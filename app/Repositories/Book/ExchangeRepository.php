<?php
namespace App\Repositories\Book;

use App\Models\Exchange;
use App\Repositories\BaseRepository;
use Auth;
use DB;

class ExchangeRepository extends BaseRepository
{
    protected $exchange;
    public function __construct(Exchange $exchange)
    {
        $this->exchange = new BaseRepository($exchange);
    }

    public function create($data)
    {
        //dd($customer->id);
        DB::beginTransaction();
        try {
            //$customer = Auth::guard('customer-api')->user();
            $exchange_arr = [
                'book_id' => $data['book_id'],
                'ex_book_title' => $data['ex_book_title'],
                'ex_book_author' => $data['ex_book_author'],
                'ex_book_publisher' => $data['ex_book_publisher'],
                'ex_book_publication_year' => $data['ex_book_publication_year'],
                'ex_book_category_id' => $data['ex_book_category_id'],
                'ex_book_sub_category_id' => $data['ex_book_sub_category_id'],
            ];
            $this->exchange->create($exchange_arr);
            DB::commit();
            return $this->response = apiResponse($exchange_arr);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }
}