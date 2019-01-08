<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Budget
 * @package App
 * @property integer id
 * @property integer user_id
 * @property integer category_id
 * @property integer amount
 * @property string time_frame
 */
class Budget extends Model
{
    use SoftDeletes;

    const TIME_FRAME_DAILY = 'daily';
    const TIME_FRAME_WEEKLY = 'weekly';
    const TIME_FRAME_MONTHLY = 'monthly';
    const TIME_FRAME_QUARTERLY = 'quarterly';
    const TIME_FRAME_YEARLY = 'yearly';

    public static function timeFrames()
    {
        return [
            self::TIME_FRAME_DAILY => 'Daily',
            self::TIME_FRAME_WEEKLY => 'Weekly',
            self::TIME_FRAME_MONTHLY => 'Monthly',
            self::TIME_FRAME_QUARTERLY => 'Quarterly',
            self::TIME_FRAME_YEARLY => 'Yearly',
        ];
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'time_frame'
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
