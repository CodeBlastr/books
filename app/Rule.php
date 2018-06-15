<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'money',
        'collation',
        'field',
        'operator',
        'type',
        'memo'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

}
