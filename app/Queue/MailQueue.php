<?php 

namespace Solital\Queue;

use Solital\Core\Mail\Mailer;
use Solital\Core\Queue\Queue;

class MailQueue extends Queue
{
	/** For codes that take a considerable amount of time to execute, change the $sleep variable */
	protected float $sleep = 10.0;

	/**
	 * Send queue email
	 */
	public function dispatch()
	{
		(new Mailer)->sendQueue();
	}
}
