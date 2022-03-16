<?php

namespace App\Imports;

use App\Models\Cake;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CakeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;
    
    public function model(array $row)
    {
        return new Cake([
            'number' => $row['number'],
            'maker'  => $row['maker'],
            'name'   => $row['name'],
        ]);
    }
}
