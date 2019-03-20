<?php
/**
 * A class that contains code to handle any requests for  /keylogs/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /keylogs/
 */
    class Keylogs extends \Framework\Siteaction
    {
/**
 * Handle keylogs operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
		{
            return '@content/keylogs.twig';
        }
    }
	///////////////////notes
	//    $listOfTables = R::inspect(); get all tables
	//           $fields = R::inspect( 'book' ); get all of one table
	//       R::getAll( 'SELECT * FROM page WHERE title = :title', get all of query
    // can also use getrow getcolumn getcell etc for more specific results


?>
