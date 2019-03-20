<?php
/**
 * A class that contains code to handle any requests for  /hire/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /hire/
 */
    class Hire extends \Framework\Siteaction
    {
/**
 * Handle hire operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
			$fd = $context->formdata();
			if ($fd->haspost('name')) //if something is posted from the name box
			{
				$staff = R::dispense('staff');
				$staff->name = $fd->mustpost('name');
				$staffID = R::store($staff);
				$context->local()->message(\Framework\Local::MESSAGE, 'Staff member successfully added.');
			}
            return '@content/hire.twig';
        }
    }
?>