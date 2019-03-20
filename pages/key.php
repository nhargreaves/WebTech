<?php
/**
 * A class that contains code to handle any requests for  /key/
 */
    namespace Pages;

    use \Framework\Web\Web as Web;
    use \Support\Context as Context;
/**
 * Support /key/
 */
    class Key extends \Framework\Siteaction
    {
		const EDITABLE = ['form', 'fwconfig', 'page', 'user'];
        const VIEWABLE = ['form'];
/**
 * Handle key operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
            $rest = $context->rest();
            switch ($rest[0])
            {
            case 'add':
                $tpl = '@content/add.twig';
				break;

            case 'delete':
                $tpl = '@content/delete.twig';
                break;

            case 'issue':
                $tpl = '@content/issue.twig';
                break;

            case 'returned':
                $tpl = '@content/returned.twig';
                break;
				
			default :
                $tpl = '@content/key.twig';
                break;
			}
		    return $tpl;
		}
    }
?>