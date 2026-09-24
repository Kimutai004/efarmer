<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Payment $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;

        $this->subject(sprintf(
            'Efarmer receipt %s (KSh %s)',
            $payment->payment_reference,
            number_format((float) $payment->amount)
        ));
    }

    public function build()
    {
        return $this->view('emails.receipt');
    }
}
