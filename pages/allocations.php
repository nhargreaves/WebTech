<?php
/**
 * A class that contains code to handle any requests for  /allocations/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /allocations/
 */
    class allocations extends \Framework\Siteaction
    {
/**
 * Handle allocations operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context) //view data is nonfunctional for this, but the database which is created is available in the sql dump as 'assigned'
        {
			$fd = $context->formdata();
			$users = R::batch('assigned', array(1, 2, 3));
			if ($fd->haspost('password')) 
			{
				$context->local()->message(\Framework\local::MESSAGE, var_dump($users));
			}
            return '@content/allocations.twig';
        }
    }
?>