<?php

namespace App\Exports;


use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements  WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */


    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Department',
            'Designation',
            'Location',
        ];
    }


}


