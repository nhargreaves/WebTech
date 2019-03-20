<?php
/**
 * A class that contains code to handle any requests for  /issue/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /issue/
 */
    class Issue extends \Framework\Siteaction
    {
/**
 * Handle issue operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
 
 
 //set to lock id, must then check if a key associated with that id is free
        public function handle(Context $context)
        {
			$fd = $context->formdata();
			if ($fd->haspost('keyID')) //if there is a post
			{
				$keys = R::dispense('keys');
				$pid = $fd->mustpost('keyID');
				
				$pps = R::load('keys', $pid);
				if ($pps->id) { //if id matches a key
					$staff = R::dispense('staff');
					$staffID = $fd->mustpost('staffID');
					$ppst = R::load('staff',$staffID);
					if ($pps->holder!='FREE') { //if holder of key is not already free
						$context->local()->message(\Framework\Local::MESSAGE, 'Key is already assigned. To continue, please ensure the key has been returned.');
					} elseif ($ppst->id) //if staff id matches a staff member
					{
						$pps->holder = $staffID;
						$pps->status = 'taken';
						R::store($pps);
						
						$assigned = R::dispense('assigned'); //set up an entry in the assignment history for the issue
						$assigned->keyID = $pid;
						$assigned->staffID = $staffID;
						$assigned->tDate = R::isodatetime();
						$assigned->status = 'issued';
						$id = R::store($assigned);
						
						$context->local()->message(\Framework\Local::MESSAGE, 'Key successfully assigned.');
					} else 
					{
						$context->local()->message(\Framework\Local::MESSAGE, 'No staff member exists with this ID. Please ensure the staff member is entered into the system via add staff.');
					}
				} else 
				{
					$context->local()->message(\Framework\Local::MESSAGE, 'There is no key matching this ID.');
				}
			}	
            return '@content/issue.twig';
        }
    }
?>