<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Service\EventTrackingService;
use App\EventTracking;


class PagesController extends Controller
{

    public function stats(EventTrackingService $eventTrackingService)
    {
        $eventTrackings = $eventTrackingService->getCounts();

        return view('stats', compact('eventTrackings'));
    }


    public function details(EventTrackingService $eventTrackingService, Request $request)
    {
        $eventTrackings = $eventTrackingService->getDetails(
            null, $request->get('sent_date'), $request->get('action')
        );

        $openedEvents = $eventTrackings->where('is_opened', true)
            ->where('is_clicked', false);
        $clickedEvents = $eventTrackings->where('is_clicked', true);

        return view('stats_details', compact('eventTrackings', 'openedEvents', 'clickedEvents'));
    }



    public function pixelAction(Request $request)
    {
        $eventTrackingId = decrypt($request->get('hash'));

        $eventTracking = EventTracking::findOrFail($eventTrackingId);

        if (!$eventTracking->is_opened) {
            $eventTracking->open_date = new \DateTime();
        }
        $eventTracking->save();

        $pixe = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');

        return response($pixe, 200, [
            'Content-Type' => 'image/png',
        ]);
    }



    // Track Event Clicks
    public function goEventAction(Request $request)
    {
        $hash = explode('_', decrypt($request->get('hash')));

        list($eventTrackingId, $eventId) = $hash;

        $event = Post::findOrFail($eventId);
        $eventTracking = EventTracking::findOrFail($eventTrackingId);

        if (!$eventTracking->is_clicked) {
            $eventTracking->click_date = new \DateTime();
            if (!$eventTracking->is_opened) {
                $eventTracking->open_date = new \DateTime();
            }
            $eventTracking->save();
        }
        $item = EventTrackingItem::where('event_tracking_id', $eventTrackingId)
            ->where('event_id', $eventId)
            ->first();
        if ($item && !$item->is_clicked) {
            $item->click_date = new \DateTime();
            $item->save();
        }

        $today = \Carbon\Carbon::today()->toDateString();

        return redirect()->route('events.detail', [
            'id' => $eventId,
            'today' => $today,
        ]);
    }

    private function increaseViewCount(Event $event)
    {
        $event->view_count = $event->view_count + 1;
        $event->save();
    }

}
