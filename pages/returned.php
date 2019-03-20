<?php
/**
 * A class that contains code to handle any requests for  /returned/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /returned/
 */
    class Returned extends \Framework\Siteaction
    {
/**
 * Handle returned operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
			$fd = $context->formdata();
			if ($fd->haspost('keyID'))
			{
				$keys = R::dispense('keys');
				$pid = $fd->mustpost('keyID');
				$pps = R::load('keys', $pid);
				if ($pps->id)  //if id matches a key
				{
					if ($pps->holder=='FREE') //if key not already free
					{
						$context->local()->message(\Framework\Local::MESSAGE, 'Key is already marked as free. Please ensure that issued keys are properly marked in the database.');
					} else 
					{
						$keyholder = $pps->holder; //set up entry for key return in the assignment history table
						$assigned = R::dispense('assigned');
						$assigned->keyID = $pid;
						$assigned->staffID = $keyholder;
						$assigned->tDate = R::isodatetime();
						$assigned->status = 'returned';
						$id = R::store($assigned);
						
						$pps->holder = 'FREE';
						$pps->status = 'available';
						R::store($pps);
						$context->local()->message(\Framework\Local::MESSAGE, 'Key successfully returned.');
					}
				} else 
				{
					$context->local()->message(\Framework\Local::MESSAGE, 'There is no key matching this ID');
				}

			}	
            return '@content/returned.twig';
        }
    }
?>