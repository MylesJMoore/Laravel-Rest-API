<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Total extends Model
{
    use HasFactory;
    protected $table = 'insurance_sample';

    public static function sumOfAll(){

    return DB::table('insurance_sample')->select(DB::raw('county, line, sum(round(amount)) as tiv_2012'))
        ->groupBy('county, line')
        ->get();
    }

}
