<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Credential;
use Uuid;

class Account extends Model
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
        'title',
        'description',
        'type',
        'detail',
        'local_balance',
        'remote_balance',
        'credential_id',
        'plaid_id'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
            if (!empty($model->credential_id) && !empty($model->plaid_id)) {
                Credential::autoStatus($model->credential_id, $model->plaid_id);
            }
        });
    }

}
