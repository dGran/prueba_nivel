<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Custom\ImportProductData;

use Illuminate\Support\Facades\Storage;

class UpdateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product list';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->importData();
        $text = "[" . date("Y-m-d H:i:s") . "]: Chequeo de datos de fuentes externas";
        Storage::append("import_log.txt", $text);
    }

    public function importData()
    {
        $import = new ImportProductData;
        $import->importData();
    }
}
