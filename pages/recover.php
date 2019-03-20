<?php
/**
 * A class that contains code to handle any requests for  /recover/
 */
     namespace Pages;

     use \Support\Context as Context;
/**
 * Support /recover/
 */
    class Recover extends \Framework\Siteaction
    {
/**
 * Handle recover operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
            return '@content/recover.twig';
        }
    }
?>