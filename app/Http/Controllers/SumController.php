<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Total;

class SumController extends Controller
{
    /**
     * Display totals by county and line.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return Total::all();
    }

    /**
     * Display totals by county.
     *
     * @return \Illuminate\Http\Response
     */
    public function sumOfCounty()
    {
        return DB::table('insurance_sample')->select(DB::raw('county,sum(amount)'))
        ->groupBy('county')
        ->get();
    }

    /**
     * Display totals by line.
     *
     * @return \Illuminate\Http\Response
     */
    public function sumOfLine()
    {
        return DB::table('insurance_sample')->select(DB::raw('line,sum(amount)'))
        ->groupBy('line')
        ->get();
    }

     /**
     * Display all totals.
     *
     * @return \Illuminate\Http\Response
     */
    public function sumOfAll()
    {
        $sumOfAll = DB::select("Select county, line, sum(round(amount)) as tiv_2012
                                  from insurance_sample
                                  group by county, line");

        return $sumOfAll;
    }

    /**
     * Create Output file for totals.
     *
     * @return \Illuminate\Http\Response
     */
    public function outputFile()
    {
        $allTotals = $this->sumOfAll();
        $myfile = fopen("output.json", "w") or die("Unable to open file!");
        fwrite($myfile, json_encode($allTotals));
        fclose($myfile);
    }
}
