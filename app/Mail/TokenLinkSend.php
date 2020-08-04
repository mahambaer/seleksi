<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TokenLinkSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('notifications::email')
                    ->subject('(do-not reply) Notifikasi Link Seleksi Online BBPLK Bekasi')
                    ->with([
                        'greeting' => $this->data['greeting'],
                        'level' => $this->data['level'],
                        'introLines' => $this->data['introLines'],
                        'actionText' => $this->data['actionText'],
                        'actionUrl' => $this->data['actionUrl'],
                        'displayableActionUrl' => $this->data['displayableActionUrl'],
                        'outroLines' => $this->data['outroLines'],
                        'salutation' => $this->data['salutation'],
                    ]);
    }
}
