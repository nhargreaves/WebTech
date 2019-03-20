<?php
/**
 * A class that contains code to handle any requests for  /lost/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /lost/
 */
    class Lost extends \Framework\Siteaction
    {
/**
 * Handle lost operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
			$fd = $context->formdata();
			if ($fd->haspost('keyID')) //if something is present
			{
				$keys = R::dispense('keys');
				$pid = $fd->mustpost('keyID');
				$pps = R::load('keys', $pid);
				if ($pps->id) //if there is a key with this id
				{
					if ($pps->status=='LOST') //if already lost
					{
						$context->local()->message(\Framework\Local::MESSAGE, 'Key is already marked as lost.');
					} else 
					{
						
					$pps->holder = 'LOST';
					$pps->status = 'LOST';
					R::store($pps);
					$context->local()->message(\Framework\Local::MESSAGE, 'Key successfully marked as lost.');
					}
				} else 
				{
					$context->local()->message(\Framework\Local::MESSAGE, 'There is no key matching this ID');
				}

			}	
            return '@content/lost.twig';
        }
    }
?>