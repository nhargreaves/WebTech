<?php
/**
 * A class that contains code to handle any requests for  /delete/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /delete/
 */
    class Delete extends \Framework\Siteaction
    {
/**
 * Handle delete operations
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
				$keyID = $fd->mustpost('keyID');
				$pps = R::load('keys',$keyID);
				if ($pps->id)  //if id matches a key
				{
					R::trash($pps); //delete key
					$context->local()->message(\Framework\Local::MESSAGE, 'Key successfully removed.');
				} else {
					$context->local()->message(\Framework\Local::MESSAGE, 'There is no key matching this ID.');
				}
			}
			return '@content/delete.twig';
        }
    }
?>