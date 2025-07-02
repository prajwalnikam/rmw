<?php

namespace App\Imports;

use App\Models\Resource;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ResourceImport implements ToModel, WithHeadingRow

{
    public function model(array $row)
    {
        $role = ($row['role'] === 'Other') ? $row['custom_role'] : $row['role'];

        $status = strtolower(trim($row['status'])) === 'active' ? 1 : 0;

        return new Resource([
            'title'           => $row['title'],
            'description'     => $row['description'],
            'status'          => $status,
            'role'            => $role,
            'specification'   => $row['specification'],
            'experience'      => $row['experience'],
            'monthly_salary'  => $row['monthly_salary'],
            'hourly_salary'   => $row['hourly_salary'],
            'user_id'         => Auth::id(),  // Logged in user ID
        ]);
    }
}
