<?php

/**
 *  IMPLEMENTAÇÃO FUTURA
 *  PROJETO REAL LUCAS
 *  ISSO NÃO FAZ PARTE DO PJI
 * 
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    // Passar propriedade (property) da StripeController (p/ entender, basta ir à controller StripeController...)
    public $data;

    /**
     * Create a new message instance.
     * Primeiro constrói-se a função para depois montar 
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     * Definir o template que será passado p/ o cliente via e-mail
     * @return $this
     */
    public function build()
    {   
        $order = $this->data;
        
        return $this->from('suporte@newmodern.com.br')->view('mail.mail_order', 
        compact('order'))->subject('Newmodern | Minha Compra ');
    }
}
