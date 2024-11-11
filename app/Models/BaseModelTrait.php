<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

trait BaseModelTrait
{
    use SoftDeletes;

    public function getPrimaryKeyColumn(): string
    {
        return 'id';
    }

    public function getFillableFields(): array
    {
        return ['created_by', 'updated_by', 'version'];
    }

    public function getDeletedAtColumn(): string
    {
        return 'deleted_at';
    }

    protected static function bootBaseModelTrait()
    {
        static::creating(function ($model) {
            $currentTime = now();
            if (!$model->created_at) {
                $model->created_at = $currentTime;
            }
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }
}
