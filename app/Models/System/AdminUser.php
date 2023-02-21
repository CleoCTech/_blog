<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    public static function options($column)
    {
        if($column == 'role'){
            $options = [
                ['id' => 1,'caption' => 'Super Admin', 'color' => 'bg-green-500'],
                ['id' => 2,'caption' => 'Read Only Admin', 'color' => 'bg-red-500'],
            ];
        }
        elseif($column == 'status'){
            $options = [
                ['id' => 1,'caption' => 'Active', 'color' => 'bg-green-500'],
                ['id' => 2,'caption' => 'Suspended', 'color' => 'bg-red-500'],
            ];
        }
        if(isset($options)){
            return $options;
        }else{
            return null;
        }
    }
}
