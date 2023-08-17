<?php

namespace App\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ViewExporterBarang implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $barang;

    function __construct($barang) {
            $this->barang = $barang;
    }
    
    public function view(): View
    {
        return view('barang.export',[
            'data' => $this->barang,
        ]);
    }
}
