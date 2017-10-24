<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\EventTrackingItem.
 *
 * @property int $id
 * @property int $event_tracking_id
 * @property int $event_id
 * @property string $click_date
 * @property mixed $is_clicked
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTrackingItem whereClickDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTrackingItem whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTrackingItem whereEventTrackingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\EventTrackingItem whereId($value)
 * @mixin \Eloquent
 */
class EventTrackingItem extends Model
{
    public $timestamps = false;
    protected $casts = [
        'event_tracking_id' => 'integer',
        'event_id' => 'integer',
    ];

    protected $appends = [
        'is_clicked',
    ];

    public function getIsClickedAttribute()
    {
        return $this->click_date ? true : false;
    }
}
