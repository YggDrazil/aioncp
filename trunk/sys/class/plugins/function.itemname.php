<?php
/* ------------------------------------------------------------------------

 * Free Control Panel for Aoin
 *
 * @version 1.0
 * @author NetSoul (FDCore main Developer )
 * @link http://www.fdcore.ru
 *
 * http://code.google.com/p/aioncp/
 *
 * @license http://fdcore.ru/license.html

------------------------------------------------------------------------ */
function smarty_function_itemname($params, $smarty)
{
    if(isset($params['id'])){
         return aioncp::GetInstance()->get_item_name($params['id']);
    }

}