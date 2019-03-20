<?php
/**
 * A class that contains code to handle any requests for  /broken/
 */
     namespace Pages;

     use \Support\Context as Context;
/**
 * Support /broken/
 */
    class Broken extends \Framework\Siteaction
    {
/**
 * Handle broken operations
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
				if ($pps->id) 
				{
					if ($pps->holder=='FREE') 
					{
						$context->local()->message(\Framework\Local::MESSAGE, 'Key is already marked as free. Please ensure that issued keys are properly marked in the database.');
					} else 
					{
						//need to get staff id from prev funct
					$assigned = R::dispense('assigned');
					$assigned->keyID = $pid;
					$assigned->staffID = $pps->holder;
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
            return '@content/broken.twig';
        }
    }
?>