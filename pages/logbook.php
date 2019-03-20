<?php
/**
 * A class that contains code to handle any requests for  /logbook/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /logbook/
 */
	
    class Logbook extends \Framework\Siteaction
	{
		$keys = R::dispense('keys');
		$keys->status = $form->mustpost('status');
		$keys->type = $form->mustpost('type');
		$keys->holder = $form->mustpost('holder');
		$id = R::store($keys);
	{
/**
 * Handle logbook operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
			$fd = $content->formdata();
			if ($fd->haspost('password')) {
				$context->local()->message(\Framework\Local::MESSAGE, 'done');
			}
            return '@content/logbook.twig';
        }
    }
?>