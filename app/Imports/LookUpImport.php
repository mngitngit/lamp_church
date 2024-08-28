<?php

namespace App\Imports;

use App\Models\LookUp;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class LookUpImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new LookUp([
            'lamp_id' => $row[0],
            'email' => $row[1],
            'firstname' => $row[2],
            'lastname' => $row[3],
            'fullname' => $row[2] . ' ' . $row[3],
            'facebook_name' => $row[4],
            'registration_type' => $row[5],
            'category' => $row[6],
            'local_church' => $row[7],
            'country' => $row[8]
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'unique:look_ups,lamp_id'
        ];
    }
}
