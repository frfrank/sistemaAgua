<?php

namespace app\Exports;

use App\Cargo;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CargosExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Descripcion',
        ];
    }
    
    public function collection()
    {
         $cargos = DB::table('cargos')->select('id','nombre', 'descripcion')->get();
         return $cargos;
        
    }
}