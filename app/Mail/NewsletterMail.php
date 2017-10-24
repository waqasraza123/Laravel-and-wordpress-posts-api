<?php

namespace App\Mail;

use App\EventTracking;
use App\Subscriber;
use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Collection
     */
    private $events;
    /**
     * @var User
     */
    private $user;
    /**
     * @var
     */
    private $action;
    /**
     * @var string
     */
    private $pixelUrl;



    /**
     * Create a new message instance.
     *
     * @param array         $events
     * @param User          $user
     * @param EventTracking $eventTracking
     */
    public function __construct(array $events, Subscriber $user, EventTracking $eventTracking)
    {
        $newsletterType = $eventTracking->action;
        $this->events = $events;
        $this->pixelUrl = route('events.pixel', [
            'hash' => encrypt($eventTracking->id),
        ]);
        foreach ($this->events as $k => $events) {
            if ($events) {
                $events->map(function ($event) use ($user, $eventTracking) {
                    $hashed = encrypt($eventTracking->id.'_'.$event->id);
                    //$hashed = \Hash::make($user->id.'-'.$event->id);
                    //$hashed = null;
                    $event->ctrUrl = route('events.go', [
                        'hash' => $hashed,
                    ]);
                });
            }

            $this->events[$k] = $events;
        }


//        $this->body = Message::where('id',1)->get();

        $this->user = $user;
        $this->newsletterType = $newsletterType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//
//        $weeklyBody = Message::where('name', 'Weekly')->
//        where('expiry', '>=', Carbon::today()->toDateString())->first()->body;
//
//        $fortnightlyBody = Message::where('name', 'Fortnightly')->
//        where('expiry', '>=', Carbon::today()->toDateString())->first()->body;
//
//        $monthlyBody = Message::where('name', 'Monthly')->
//        where('expiry', '>=', Carbon::today()->toDateString())->first()->body;
//

        return $this
            ->subject('Latest news from TRY')
            ->from('info@try.org.au')
            ->bcc('aaron@learnerlibrary.com')
            ->view('newsletter.newsletter', [
                'newsletterType' => $this->newsletterType,
                'user' => $this->user,
                'events' => $this->events,
                'pixelUrl' => $this->pixelUrl,
//                'weeklyBody' => $weeklyBody,
//                'fortnightlyBody' => $fortnightlyBody,
//                'monthlyBody' => $monthlyBody,
                ''
            ]);


    }
}
