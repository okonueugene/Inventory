<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Check if all required columns are present in the row
        $requiredColumns = ['name', 'email', 'department', 'designation', 'location'];

        foreach ($requiredColumns as $column) {
            if (!array_key_exists($column, $row)) {
                throw ValidationException::withMessages([
                    'message' => 'All columns are required',
                ]);
            }
        }

        // Check if the email is valid or not if not null
        if (!empty($row['email']) && !filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email address',
            ]);
        }

        //validation rules
        $rules = [
            'name' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'location' => 'required',
        ];

        //validate the row
        $validator = \Validator::make($row, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        //add notification to all users
        $employee = new Employee();
        $employee->name = $row['name'];
        $employee->email = $row['email'];
        $employee->department = $row['department'];
        $employee->designation = $row['designation'];
        $employee->location = $row['location'];
        $employee->save();
        $employee->addNotification();



    }
}
