<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
   
    protected $connection = "emp";
    protected $table = "users";

   //protected $table = "dts_users";

}
