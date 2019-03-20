<?php
/**
 * A class that contains code to handle any requests for  /return/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /return/
 */
    class Return extends \Framework\Siteaction
    {
/**
 * Handle return operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
            return '@content/return.twig';
        }
    }
?>