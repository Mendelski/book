<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\CompleteResource;
use App\Jobs\ProcessXML;
use App\Models\Book;
use App\Models\Index;
use App\Services\BookService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $bookTitle = $request->get('titulo');
        $indexTitle = $request->get('titulo_do_indice');

        $index = BookService::getBooks($bookTitle, $indexTitle);

        return CompleteResource::collection($index);
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

        ProcessXML::dispatch($xmlData, $book);

        return response()->json(['message' => 'Enviado para a fila!']);

    }
}
