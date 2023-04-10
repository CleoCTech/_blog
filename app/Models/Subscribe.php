<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\SearchTrait;
use App\Traits\Admin\ColumnsTrait;
use App\Traits\Admin\UuidTrait;

class Subscribe extends Model
{
    use HasFactory;
    use UuidTrait;
    use SearchTrait;
    use ColumnsTrait;

    protected $guarded = [];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
