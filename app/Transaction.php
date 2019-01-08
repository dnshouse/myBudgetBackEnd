<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App
 * @property integer account_id
 * @property integer category_id
 * @property integer amount
 * @property string type
 * @property string note
 * @property string recurring
 */
class Transaction extends Model
{
    use SoftDeletes;

    const TYPE_INCOME = 'income';
    const TYPE_EXPENSE = 'expense';

    public static function types()
    {
        return [
            self::TYPE_INCOME => 'Income',
            self::TYPE_EXPENSE => 'Expense',
        ];
    }

    protected $fillable = [
        'account_id',
        'category_id',
        'amount',
        'type',
        'note',
        'recurring',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
