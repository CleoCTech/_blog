<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;

class SubCategoryPost extends Model
{
    use HasFactory;
    use SearchTrait;
    use ColumnsTrait;
    use UuidTrait;
    
    protected $guarded = [];
    protected $casts = [
        'created_at'  => 'date:d-M-Y',
        'updated_at'  => 'date:d-M-Y',
        'publish_time'  => 'datetime:d-M-Y h:m:s',
    ];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function options($column){
        if($column == 'status'){
            $options = [
                ['id' => 1,'caption' => 'Save Only', 'color' => 'bg-gray-400'],
                ['id' => 2,'caption' => 'Save & Publish', 'color' => 'bg-green-500'],
                ['id' => 3,'caption' => 'Save & Publish Later', 'color' => 'bg-yellow-500'],
            ];
        } 
        if($column == 'visibility'){
            $options = [
                ['id' => 1,'caption' => 'Public', 'color' => 'bg-gray-400'],
                ['id' => 2,'caption' => 'Private', 'color' => 'bg-green-500'],
            ];
        } 
        if(isset($options)){
            return $options;
        }else{
            return null;
        }
    }
}
