<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class SubscriptionNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $customerName;
    public $contactPerson;
    public $product;
    public $terms;
    public $activationDate;
    public $expirationDate;
    public $pmName;
    public $tcdName;
    public $ao;
    public $csdName;
    
    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($ao, $customerName, $contactPerson, $product, $terms, $activationDate, $expirationDate, $pmName, $tcdName, $csdName)
    {
        $this->ao = $ao;
        $this->customerName = $customerName;
        $this->contactPerson = $contactPerson;
        $this->product = $product;
        $this->terms = $terms;
        $this->activationDate = $activationDate;
        $this->expirationDate = $expirationDate;
        $this->pmName = $pmName;
        $this->tcdName = $tcdName;
        $this->csdName = $csdName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->subject('Subscription Portal: Expiration Notification')
                ->view('emails.subscription_email');
    }
}
