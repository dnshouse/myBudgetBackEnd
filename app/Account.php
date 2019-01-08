<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 * @package App
 * @property integer user_id
 * @property integer opening_balance
 * @property string name
 * @property string icon
 * @property string colour
 */
class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'opening_balance',
        'name',
        'icon',
        'colour',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
