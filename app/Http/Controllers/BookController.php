<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Index;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $book = Book::query()->with('index')->get();
        return BookResource::collection($book);
    }

    public function store(BookRequest $request)
    {
        return new BookResource(Book::create($request->validated()));
    }


    public function xmlImport(Book $book, Request $request): JsonResponse
    {
        $xmlData = $request->getContent();
        DB::beginTransaction();
        try {
            $xml = new SimpleXMLElement($xmlData);

            foreach ($xml->item as $item) {
                $title = (string) $item['titulo'];
                $page = (int) $item['pagina'];

                Index::create([
                    'book_id' => $book->id,
                    'title' => $title,
                    'page' => $page,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Dados importados com sucesso!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message'=> 'XML não processado, verifique o formato e tente novamente.', 'error' => $e->getMessage()]);
        }
    }
}
