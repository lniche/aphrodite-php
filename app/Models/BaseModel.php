<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $fillable = ['created_by', 'updated_by', 'deleted_at', 'version'];

    protected static function booted(): void {}
}
