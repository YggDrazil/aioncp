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
function smarty_modifier_itemname($string)
{
    return aioncp::GetInstance()->get_item_name($string);
}