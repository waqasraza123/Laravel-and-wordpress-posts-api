<?php

namespace App\Service;

use App\EventTracking;

class EventTrackingService
{
    public function getCounts($eventId = null)
    {
        $query = EventTracking::query();

        if ($eventId) {
            $query->whereHas('items', function ($w) use ($eventId) {
                $w->where('event_id', '=', $eventId);
            });
        }

        return $query->select(\DB::raw('COUNT(event_tracking.id) as mailing_count'), 'action', 'sent_date')
            ->addSelect(\DB::raw('sum(case when open_date is null then 1 else 0 end) not_opened_count'))
            ->addSelect(\DB::raw('sum(case when click_date is null then 1 else 0 end) not_clicked_count'))
            ->groupBy('event_tracking.action', 'event_tracking.sent_date')
            ->orderBy('sent_date', 'DESC')
            ->get();
    }

    public function getDetails($eventId = null, $sentDate, $action)
    {
        $query = EventTracking::with('user', 'items');

        if ($eventId) {
            $query->whereHas('items', function ($w) use ($eventId) {
                $w->where('event_id', '=', $eventId);
            });
        }

        $query->where('sent_date', $sentDate)
            ->where('action', $action);

        return
            $query->orderBy('sent_date', 'DESC')
            ->get();
    }
}
