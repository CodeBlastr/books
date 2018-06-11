<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Uuid;

class Credential extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'public_data',
        'private_data'
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

    public static function decode($items = null)
    {

        for ($i = 0; $i < count($items); $i++) {
            $items[$i]->public_data = json_decode($items[$i]->public_data);
        }
        return $items;
    }

}
