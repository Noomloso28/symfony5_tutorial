<?php
namespace App\Services;

use Psr\Log\LoggerInterface;

class GiftsServices{

	public  $gifts = ['Books','flowers','Computer','Spoon' , 'Bit'];

	public function __construct( LoggerInterface $logger )
	{
		$logger->info('message from GiftServices.');
		shuffle($this->gifts );
	}

}