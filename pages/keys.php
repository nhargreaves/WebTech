<?php
/**
 * A class that contains code to handle any requests for  /keys/
 */
     namespace Pages;

     use \Support\Context as Context;
/**
 * Support /keys/
 */
    class Keys extends \Framework\Siteaction
    {
/**
 * Handle keys operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
            return '@content/keys.twig';
        }
    }
?>