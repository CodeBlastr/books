<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class Transaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref',
        'type',
        'payee',
        'memo',
        'payment',
        'credit',
        'status',
        'source',
        'data'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }

}
