<?php

namespace App\Exports;

use App\Models\Customer;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Facades\DB;

class MemberExport implements FromCollection , WithHeadings , WithMapping
{

    public function collection()
    {
         
          $lists =  DB::table('customers')
        //   ->select('customers.reg_id', 'customers.username',  'customers.email', 'customers.phone', 'customers.address', 'customers.pincode', 'customers.chapter', 'customers.category', 'customers.subcategory', 'customers.dob', 'customers.martial_date')
        //   ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
        //   ->leftJoin('pwa_subcategory', 'customers.subcategory', '=', 'pwa_subcategory.id')
        //   ->leftJoin('pwa_category', 'customers.category', '=', 'pwa_category.id')
          ->get();
        //   DB::table('customers') ->select('jm_blr_rs_vasathi.id as id','jm_blr_rs_vasathi.name as respname',DB::raw('COUNT(customers.area) as respcount'))
            
        //     ->whereNotNull('customers.area')->groupBy('customers.area')->orderBy('id')->get();
          
            //  dd($lists);
        return $lists;
    }
     public function map($row): array
    {
        // dd($row);
         $vahini = '';
        if($row->chapter)
        {
            $memdet = DB::table('pwa_chapter')->where('id', $row->chapter)->first();
            if($memdet){
            $vahini = $memdet->name;
            } 
        }
        $category = '';
        if($row->category)
        {
            $memdet = DB::table('pwa_category')->where('id', $row->category)->first();
            if($memdet){
            $category = $memdet->name;
            } 
        }
        $subcategory = '';
        if($row->subcategory)
        {
            $memdet = DB::table('pwa_subcategory')->where('id', $row->subcategory)->first();
            if($memdet){
            $subcategory = $memdet->name;
            } 
        }
        $dob = $row->dob;
        $doa = $row->martial_date;
        
        if($row->roles == 1){
            $roles = 'Guest';
            
        }
        else if($row->roles == 2){
            $roles = "member";
        }
        else{
            $roles = "";
        }
        return [
            $row->reg_id,
            $row->username,
            $roles,
            $row->email,
            $row->phone,
            $row->address,
            $row->pincode,
            $vahini,
            $category,
            $subcategory,
            $dob,
            $doa
        ];
    }
    public function headings():array
    {
        return [
            'Reg.No','Name','Roles', 'Email', 'Phone', 'Address', 'Pincode', 'Vahini', 'Category', 'Sub Category', 'Date of Birth', 'Anniversary Date'];
        } 
    }
