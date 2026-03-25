<?php

namespace App\Exports;

use App\Models\Customer;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Collection;

class OpportunityFLTRExport implements FromCollection , WithHeadings, WithMapping
{
    
    protected $data;

 function __construct($data) {
        $this->data = $data;
 }

    public function collection()
    {
        return $this->data;
    }
    public function headings():array
    {
        return ['Requirement Id','Name', 'Phone', 'Description', 'Subcategory', 'Posted By', 'Forwarded to', 'Status'];
    } 
    public function map($row): array
    {
        $uid = $row->uid;
        $name = $row->name;
        $phone = $row->phone;
        $descp = $row->descp;
       
        $subcategory = '';
        if($row->subcateid)
        {
            $memdet = DB::table('pwa_subcategory')->where('id', $row->subcateid)->first();
            if($memdet){
            $subcategory = $memdet->name;
            } 
        }
        
        $postedby = '';
        if($row->cust_id){
            $memdet = DB::table('customers')->where('id', $row->cust_id)->first();
            if($memdet){
            $postedby = $memdet->username;
            
            } 
        }
        $forwarded = '';
        if($row->member)
        {
            $memdet = DB::table('customers')->where('id', $row->member)->first();
            if($memdet){
            $forwarded = "Member - " .$memdet->username;
            } 
        }
        else if($row->category){
            $catdet = DB::table('pwa_category')->where('id', $row->category)->first();
            if($catdet){
            $forwarded = "Category - " .$catdet->name;
            }
        }
        else if($row->chapter){
            $chapdet = DB::table('pwa_chapter')->where('id', $row->chapter)->first();
            if($chapdet){
            $forwarded = "Vahini - " .$chapdet->name;
            }
        }
        else{
             $forwarded = "Not Forwaded";
        }
        $status = '';
        if($row->status == 1){
             $status = "Forwarded";
        }
        else if($row->status == 2){
            $status = "Pending";
        }
        else{
            $status = "Rejected";
        }
        
        

        return [
            $uid,
            $name,
            $phone,
            $descp,
            $subcategory,
            $postedby, 
            $forwarded,
            $status
        ];
    }
    
    
    


}
