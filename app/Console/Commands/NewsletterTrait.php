<?php

namespace App\Console\Commands;

use App\Mail\NewsletterMail;
use App\Model\Event;
use App\EventTracking;
use App\EventTrackingItem;
use App\Model\Role;
use App\Subscriber;
use App\Post;


// 1. Get Active subscribers
// 2. Get Subscribers topic ID's
// 3. Get Events where
//    ->status is published,
//    ->publish date is greater than previous newsletter date
//    ->matching topic ID's of subscriber
// 4. Send email


trait NewsletterTrait
{
    private function getUsers($action)
    {

        // Newsletter frequency by subscriber preference
        switch ($action) {
            case 'weekly':
                $frequencyId = 1;
                break;
            case 'fortnightly':
                $frequencyId = 2;
                break;
            case 'monthly':
                $frequencyId = 3;
                break;
        }

        // Get list of subscribers by status with topics
        return Subscriber::where('status', 'Active')
            ->with([
                'topics',
            ])
            ->get();
        }


    // Get Posts
    private function getPosts($userTopicIds, $dateStart, $dateEnd, $userLocationIds, $userInterestIds, $userTypeIds)
    {
        $posts = Post::where('status', 'publish')

//            ->where('start_date', '>=', $dateStart)
//
//            ->where(function ($e) use ($dateEnd) {
//                $e->where(function ($j) use ($dateEnd) {
//                    $j->whereNull('end_date')
//                        ->where('start_date', '<=', $dateEnd);
//                })->orWhere('end_date', '<=', $dateEnd);
//            })
//

        ->orderBy('name', 'ASC');


        if ($userTopicIds) {

            $posts->whereHas('topics', function ($query) use ($userTopicIds) {
                $query->whereIn('topic_id', $userTopicIds);
            });
        }

//        if ($userTypeIds) {
//            $events->whereHas('types', function ($query) use ($userTypeIds) {
//                $query->whereIn('types_id', $userTypeIds);
//            });
//        }


        return $posts->get();

    }



    private function addEventToEventTracking(Post $event, EventTracking $eventTracking)
    {
        $r = new EventTrackingItem();
        $r->event_id = $event->id;

        $r->event_tracking_id = $eventTracking->id;
        $r->save();
    }

    private function createEventTracking(Subscriber $user, $action, $today, $eventCount)
    {
        $r = new EventTracking();
        $r->user_id = $user->id;
        $r->action = $action;
        $r->sent_date = $today;
        $r->event_count = $eventCount;
        $r->save();

        return $r;
    }

    private function handleNewsletter($today, $defaultAction)
    {
        $actions = [];
        if (!$defaultAction) {
            $secondSunday = (new \DateTime())->modify('first day of this month')->modify('+2 Sundays');
            if ($today->format('d') === 1) {
                $actions[] = 'monthly';
            } elseif ($today->format('Y-m-d') === $secondSunday->format('Y-m-d')) {
                $actions[] = 'fortnightly';
            }
            if ((int) $today->format('N') === 6) {
                $actions[] = 'weekly';
            }
        } else {
            $actions[] = $defaultAction;
        }

        if (!$today instanceof \DateTime) {
            $today = new \DateTime($today);
        }
        $todayString = $today->format('Y-m-d');

        $this->info('Sending date: '.$todayString);
        if (!$actions) {
            $this->error('Sending date is not sending email day');

            return;
        }
        foreach ($actions as $action) {
            $this->info('Action: '.$action);
        }

        foreach ($actions as $action) {
            $users = $this->getUsers($action);

            $this->info($users->count().' user found for '.$action.' frequency');

            if ($users->count() > 0) {
                $this->info("Getting events for $action");

//                if ($action === 'fortnightly') {
//                    $this->info('thisforthnight: '.$todayString.' - '.(new \DateTime($todayString.' +14 days'))->format('Y-m-d'));
//                    $this->info('nextforthnight: '.(new \DateTime($todayString.' +14 days'))->format('Y-m-d').' - '.(new \DateTime($todayString.'+14 days'))->format('Y-m-d'));
//                    $this->info('nextmonth: '.(new \DateTime($todayString.'+30 days'))->format('Y-m-d').' - '.(new \DateTime($todayString.'+60 days'))->format('Y-m-d'));
//                }

                foreach ($users as $user) {
//                    $userInterestIds = $user->interests->pluck('id')->toArray();
//                    if (in_array(1, $userInterestIds, false)) {
//                        $userInterestIds = [];
//                    }
//                    $userLocationIds = $user->locations->pluck('id')->toArray();
//                    if (in_array(1, $userLocationIds, false)) {
//                        $userLocationIds = [];
//                    }
                    $userTopicIds = $user->topics->pluck('id')->toArray();

                    if (in_array(1, $userTopicIds, false)) {
                        $userTopicIds = [];
                    }


                    $eventCount = 0;
                    if ($action === 'weekly') {
                        $endDate = new \DateTime($todayString.' +7 days');
                        $events['thisweek'] = $this->getPosts($todayString, $endDate, $userLocationIds, $userInterestIds, $userTypeIds);
                        $events['nextweek'] = $this->getPosts($endDate, new \DateTime($todayString.'+14 days'), $userLocationIds, $userInterestIds, $userTypeIds);
                        $events['followingforthnight'] = $this->getPosts(new \DateTime($todayString.'+15 days'), new \DateTime($todayString.'+30 days'), $userLocationIds, $userInterestIds, $userTypeIds);

                    }

                    elseif ($action === 'fortnightly') {
                        $endDate = new \DateTime($todayString.' +14 days');
                        $events['thisforthnight'] = $this->getPosts($todayString, $endDate, $userLocationIds, $userInterestIds, $userTypeIds);
                        $events['nextforthnight'] = $this->getPosts($endDate, new \DateTime($todayString.'+14 days'), $userLocationIds, $userInterestIds, $userTypeIds);
                        $events['nextmonth'] = $this->getPosts(new \DateTime($todayString.'+30 days'), new \DateTime($todayString.'+60 days'), $userLocationIds, $userInterestIds, $userTypeIds);
                    }

                    elseif ($action === 'monthly') {
                        $endDate = new \DateTime($todayString.' +30 days');
                        $events['thismonth'] = $this->getPosts($userTopicIds, $todayString, $endDate, $userLocationIds, $userInterestIds, $userTypeIds);
//                        $events['nextmonth'] = $this->getPosts($endDate, new \DateTime($todayString.' +61 days'), $userLocationIds, $userInterestIds, $userTypeIds);
//                        $events['national'] = $this->getNatEvents(new \DateTime($todayString.'+62 days'), new \DateTime($todayString.'+120 days'), $userInterestIds, $userTypeIds);

                    }

                    foreach ($events as $eventList) {
                        $eventCount += $eventList->count();
                    }

                    $this->info('User: '.$user->id.' - EventCount:'.$eventCount);

                    if ($eventCount > 0) {
                        $eventTracking = $this->createEventTracking(
                            $user,
                            $action,
                            $today,
                            $eventCount
                        );

                        //send email with tracking


                        \Mail::to($user)->send(new NewsletterMail($events, $user, $eventTracking));

                        //send email without tracking
//                        \Mail::to($user)->send(new NewsletterMail($events, $user));

//                        \DB::beginTransaction();
//                        foreach ($events as $eventList) {
//                            foreach ($eventList as $event) {
//                                $this->addEventToEventTracking(
//                                    $event,
//                                    $eventTracking
//                                );
//                            }
//                        }
                        \DB::commit();
                    }
                }
            }
        }
        
    }
}
