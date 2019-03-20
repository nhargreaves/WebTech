<?php
 /**
  * Class for handling home pages
  *
  * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
  * @copyright 2012-2018 Newcastle University
  */
    namespace Pages;
    
    use \Support\Context as Context;
/**
 * A class that contains code to implement a home page
 */
    class Home extends \Framework\Siteaction
    {
/**
 * Handle various contact operations /
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
            return '@content/index.twig';
        }
    }
?>
