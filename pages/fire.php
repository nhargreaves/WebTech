<?php
/**
 * A class that contains code to handle any requests for  /fire/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /fire/
 */
    class Fire extends \Framework\Siteaction
    {
/**
 * Handle fire operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle(Context $context)
        {
			$fd = $context->formdata();
			if ($fd->haspost('staffID'))
			{
				$staff = R::dispense('staff');
				$pid = $fd->mustpost('staffID');
				$pps = R::load('staff', $pid);
				if ($pps->id) //if a staff member has this id
				{
					$keys = R::dispense('keys');
					foreach (R::findAll('keys', 'order by id') as $pr) //return any assigned keys
					{
						if ($pr->holder == $pps->id)
						{
							$pr->holder = 'FREE';
							$pr->status = 'available';
							R::store($pr);
						}
					}
					R::trash($pps);
					$context->local()->message(\Framework\Local::MESSAGE, 'Staff member successfully removed.');
				} else 
				{
					$context->local()->message(\Framework\Local::MESSAGE, 'There is no staff member matching this ID.');
				}
			}
            return '@content/fire.twig';
        }
    }
?>