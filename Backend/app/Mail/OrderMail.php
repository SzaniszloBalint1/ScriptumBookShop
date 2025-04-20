<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public Order $order, public $orderItems,public PaymentMethod $payment_method,public $shipping,public Book $book)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Köszönjük a rendelésed!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build(){
        $itemsHtml = '';
        if ($this->orderItems && count($this->orderItems) > 0) {
            foreach ($this->orderItems as $item) {
                $book = $item->book ?? $this->book;
                $itemsHtml .= '
                <li>Könyv címe: '.($book->title ?? 'N/A').'</li>
                <li>Könyv ára: '.($item->UnitPrice ?? 'N/A').' Ft</li>
                <li>Mennyiség: '.($item->Quantity ?? '1').'</li>
                <hr>';
            }
        } else {
            $itemsHtml = '
            <li>Könyv címe: '.$this->book->title.'</li>
            <li>Könyv ára: '.$this->book->Price.' Ft</li>
            <li>Mennyiség: 1</li>';
        }

        return $this->from(env('MAIL_FROM_ADDRESS', 'noreply@example.com'),env('MAIL_FROM_NAME', 'Webshop'))
        ->html('
        <h1>Kedves '.$this->user->FullName.'</h1>
        <br>
        <h2>Örömmel értesítünk, hogy rendelésed sikeresen beérkezett, és hamarosan feldolgozzuk!</h2>
        <h3>📦 Rendelési adatok:</h3>
        <li>Rendelés azonosító: '.($this->order->reference_id ?? 'N/A').'</li>
        <li>Rendelés dátuma: '.($this->order->OrderDate ?? 'N/A').'</li>
        <li>Szállítás módja: '.($this->shipping->method ?? 'N/A').'</li>
        <li>Fizetési mód: '.($this->payment_method->MethodName ?? 'N/A').'</li>
        <br>
        <h3>🛒 Rendelésed tartalma:</h3>
        '.$itemsHtml.'
        <li>Összesen: '.($this->order->TotalAmount ?? 0).' Ft</li>
        <br>
        <h3>🚚 Szállítási információk:</h3>
        <p>Amint rendelésed útnak indul, e-mailben és/vagy SMS-ben értesítünk a szállítás részleteiről.</p>
        <br>
        <h3>📍 Személyes átvétel esetén:</h3>
        <p>Az átvétel helye: 1117 Budapest, Budafoki út 59-61.</p>
        <p>Az átvétel időpontja: hétfőtől péntekig 10:00-18:00 között.</p>
        <br>
        <h3>📧 Kapcsolat:</h3>
        <p>Ha kérdésed van, ügyfélszolgálatunk készséggel segít:</p>
        <p>📧:Scriptum.Shop@gmail.com</p>
        <p>📞:+36 20 502 9699</p>
        <br>
        <h3>📌 Fontos tudnivalók:</h3>
        <p>Amennyiben a rendeléseddel kapcsolatban bármilyen probléma adódna, kérjük, jelezd felénk minél előbb!</p>
        <hr>
        <p>Köszönjük, hogy minket választottál!</p>
        <p>Üdvözlettel</p>
        <p>📖 Scriptum csapata</p>
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
