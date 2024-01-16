<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $rows = $row->map(function ($row) {
            return array_slice($row->toArray(), 1);
        });

        return new User([
            'id' => $row[0],
            'name'     => $row[1],
            'email'    => $row[2], 
            'password' => Hash::make($row[3]),
            'created_at' => Carbon::now('UTC'),
            'updated_at' => Carbon::now('UTC'),
            'is_admin' =>$row[6]
        ]);
    }
}
