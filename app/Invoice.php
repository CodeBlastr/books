<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class Invoice extends Model
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
        'item',
        'description',
        'quantity',
        'rate',
        'memo',
        'invoiced_at',
        'due_at'
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
