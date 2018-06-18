<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Uuid;

class Credential extends Model
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

    /**
     * public_data field is a json encoded data, and
     * this method decodes it automatically
     *
     * @param null $items
     * @return null
     */
    public static function decode($items = null)
    {
        if (!empty($items[0])) {
            for ($i = 0; $i < count($items); $i++) { // multiple items found
                $items[$i]->public_data = json_decode($items[$i]->public_data);
            }
        } elseif (!empty($items->public_data)) { // single item found
            $items->public_data = json_decode($items->public_data);
        }
        return $items;
    }

    /**
     * Make individual credentials as used u
     *
     * @param null $id
     * @param null $accountId
     * @return bool
     */
    public static function autoStatus($id = null, $accountId = null)
    {
        if (!empty($id) && !empty($accountId)) {
            $count = 0;
            $credential = self::decode(self::where('id', '=', $id)->first());
            for ($i = 0; $i < count($credential->public_data->metadata->accounts); $i++) {
                if (!empty($credential->public_data->metadata->accounts[$i]->_status)) {
                    $count++;
                }
                if ($credential->public_data->metadata->accounts[$i]->id === $accountId) {
                    $credential->public_data->metadata->accounts[$i]->_status = 'used';
                }
            }

            if ($count > 0 && $count === $i) {
                $credential->status = 'used';
            } else {
                $credential->status = 'partial';
            }
            $credential->public_data = json_encode($credential->public_data);
            $credential->save();
        }
    }

}
