<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateProductDataMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Informe de actualización de producto";

    public $product;
    public $changes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, $changes)
    {
        $this->product = $product;
        $this->changes = $changes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.update-product')
                    ->with([
                        'productID' => $this->product->id,
                        'productSource' => $this->product->source,
                        'changes' => $this->changes,
                    ]);
    }
}
