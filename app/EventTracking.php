<?php

namespace App;

use App\Subscriber;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\EventTracking.
 *
 * @property int $id
 * @property int $user_id
 * @property string $sent_date
 * @property int $event_count
 * @property string $action
 * @property string $open_date
 * @property string $click_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $is_clicked
 * @property mixed $is_opened
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereClickDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereEventCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereOpenDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereSentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTracking whereUserId($value)
 * @mixin \Eloquent
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Model\EventTrackingItem[] $items
 * @property \App\User $user
 */
class EventTracking extends Model
{
    protected $table = 'event_tracking';

    protected $casts = [
        'event_count' => 'integer',
        'user_id' => 'integer',
    ];

    protected $appends = [
        'is_opened',
        'is_clicked',
    ];

    public function user()
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function items()
    {
        return $this->hasMany(EventTrackingItem::class);
    }

    public function getIsClickedAttribute()
    {
        return $this->click_date ? true : false;
    }

    public function getIsOpenedAttribute()
    {
        return $this->open_date ? true : false;
    }
}
