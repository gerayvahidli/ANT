<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FromUserToTis extends Mailable
{
	use Queueable, SerializesModels;
	protected $data;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct ( $data )
	{
		$this->data = $data;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build ()
	{
		if (isset($this->data[ 'file' ])) {
			return $this->from( 'noreply@socar.az' )
				->replyTo($this->data[ 'email' ], $this->data[ 'full_name' ])
				->subject( 'XTP Müraciət' )
                ->cc(['elshan.sharifov@socar.az','garay.vahidli@socar.az'])
                ->markdown( 'emails.user.toTis' )
				->attach( asset($this-> data['file'] ) )
				->with( [ 'data' => $this->data ] );
		}else{
		return $this->from( 'noreply@socar.az' )
			->replyTo($this->data[ 'email' ], $this->data[ 'full_name' ])
			->subject( 'XTP Müraciət' )
            ->cc(['elshan.sharifov@socar.az','garay.vahidli@socar.az'])
            ->markdown( 'emails.user.toTis' )
			->with( [ 'data' => $this->data ] );
		}
	}
}
