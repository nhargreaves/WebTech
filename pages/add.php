<?php
/**
 * A class that contains code to handle any requests for  /add/
 */
     namespace Pages;

     use \Support\Context as Context;
	 use \R as R;
/**
 * Support /add/
 */
    class Add extends \Framework\Siteaction
    {
/**
 * Handle add operations
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
 
 //need to do form handling with locks when that database is set up
        public function handle(Context $context)
        {
			$rest = $context->rest();
			switch ($rest[0])
			{
				case 'add':
					$tpl = '@content/add.twig';
					break;
				default:
				$tpl = '@content/add.twig';
				
				$fd = $context->formdata();
				if ($fd->haspost('keyType'))
				{
					$checkType = $fd->mustpost('keyType');
					$checkLock = $fd->mustpost('keyLock');
					if ($checkType=='master' || $checkType=='submaster' || $checkType=='single') //if type is acceptable
					{
						$keys = R::dispense('keys');
						$locks = R::dispense('locks');
						$bnl = R::load('locks',$checkLock);
						if ($checkLock == NULL && $checkType == 'single') //if no lock for a single key
						{
							$context->local()->message(\Framework\Local::MESSAGE, 'Please include the associated lock ID for keys marked as single.');
						} elseif ($bnl->id || $checkType != 'single') 
						{
							if ($checkType == 'master' || $checkType == 'submaster') //just in case a lock value was given for a master or submaster
							{
								$checkLock = 0;
							}
							$keys->lock_id = $checkLock;
							$keys->type = $checkType;
							$keys->status = 'available';
							$keys->holder = 'FREE';
							$id = R::store($keys);
							$context->local()->message(\Framework\Local::MESSAGE, 'Key successfully added.');
						} else
						{
							$context->local()->message(\Framework\Local::MESSAGE, 'There is no lock with that ID.');						
						}	
					} else {
						$context->local()->message(\Framework\Local::MESSAGE, 'Key must be master, submaster or single.');
					}	
				}
			}
			return '@content/add.twig';
		}
	}
?>