<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\CsvRead;
use File;

class DashboardController extends Controller
{
    public function index()
    {

        // read the CSV file
        $fileD = fopen(storage_path('app/public/sample_data.csv'),"r");
        $column=fgetcsv($fileD);
        $isValid = 1;
        while(!feof($fileD)){
            $rowData=fgetcsv($fileD);
            if(strlen($rowData[0]) > 6){
                return redirect()->back()->with('error', 'Please check the Month and year format.');   
            }else{
                $csvData[] = $rowData;
            }
        }
      

        //add the file log in database
        $csvRead = new CsvRead;
        $csvRead->file_name = 'sample_data.csv';
        if($csvRead->save()){

        //if file has been successfully red,move to the read folder
        File::move(storage_path('app/public/sample_data.csv'), storage_path('app/public/read/sample_data.csv'));
            
        // sorting the data with month and year wise
            usort(
                $csvData, 
                function ($a, $b) {
                return 
                    DateTime::createFromFormat('d-M-Y', "01-".$a["0"]) <=>
                    DateTime::createFromFormat('d-M-Y', "01-".$b["0"]);
                }
            );

        //profit/loss script logic
            $sellArray = array();
            $buyArray = array();
            $finalArray = array();
            $month = "";
            foreach($csvData as $rowDataRow){
                if(!empty($rowDataRow)){
                    if($month!=""){
                        $month = $rowDataRow[0];
                    }
                    if($month == $rowDataRow[0]){
                        $finalArray[$month][] = $rowDataRow;
                    }else{
                        $finalArray[$rowDataRow[0]][] = $rowDataRow;
                    }
                }
            }
        return view('welcome',compact('finalArray'));
        }
    }
    
    public function showProfitLossScript()
    {
        return view('start_script');
    }

}
