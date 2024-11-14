<?php

namespace App\Exports;


use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'department',
    //     'designation',
    //     'location',
    // ];

    public function collection()
    {
        return Employee::all();
    }

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

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->email,
            $employee->department,
            $employee->designation,
            $employee->location,
        ];
    }

}


