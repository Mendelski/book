<?php

namespace App\Jobs;

use App\Models\Index;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class ProcessXML implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $book;
    private $xml;

    /**
     * Create a new job instance.
     */
    public function __construct($book, $xml)
    {
        $this->book = $book;
        $this->xml = $xml;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            $xml = new SimpleXMLElement($this->xml);

            foreach ($xml->item as $item) {
                $title = (string) $item['titulo'];
                $page = (int) $item['pagina'];

                Index::create([
                    'book_id' => $this->book->id,
                    'title' => $title,
                    'page' => $page,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
