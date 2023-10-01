<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         $key = request()->export_key;
        $users = User::where('name', 'LIKE', '%' . $key . '%')
        ->orWhere('email', 'LIKE', '%' . $key . '%')
        ->orWhereRelation('roles', 'name', 'LIKE', '%' . $key . '%')
        ->get();

        $users_arr = [];

        $count = 0;
        foreach($users as $user){
            $roles_arr = [];
            foreach($user->roles as $role){
                array_push($roles_arr, $role->name);
            }
            array_push($users_arr, [
                'No'    =>  ++$count,
                'name'  =>  $user->name,
                'email' =>  $user->email,
                'roles' =>  implode(',', $roles_arr),
            ]);
        }
        return collect($users_arr);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [" ", "Name", "Email", 'Roles'];
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(40);
            },
        ];
    }
}
