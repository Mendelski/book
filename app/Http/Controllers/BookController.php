<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Index;
use App\Services\BookService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $bookTitle = $request->get('titulo');
        $indexTitle = $request->get('titulo_do_indice');

        $book = BookService::getBooks($bookTitle, $indexTitle);

        return BookResource::collection($book);
    }

    public function store(Request $request)
    {
        $titulo = $request->get('titulo');
        $parentIndex = $request->get('subindices');

        DB::beginTransaction();
        try {
            $book = Book::create([
                'title' => $titulo,
                'user_id' => auth()->guard('api')->client()->user_id,
            ]);

            foreach ($parentIndex as $index) {
                Index::create([
                    'book_id' => $book->id,
                    'title' => $index['titulo'],
                    'page' => $index['pagina'],
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Livro criado com sucesso!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Livro não criado. Veririque os dados.', 'error' => $e->getMessage()]);
        }
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
