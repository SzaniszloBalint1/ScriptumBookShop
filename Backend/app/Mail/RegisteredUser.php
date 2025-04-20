<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sikeres regisztráció',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->html('
        <h1>Scriptum</h1>
        <hr>
        <h2>Kedves '.$this->user->FullName.'!</h2>
        <p>Sikeresen regisztráltál a Scriptum webáruházban!</p>
        <p>Köszönjük, hogy minket választottál!</p>
        ');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
