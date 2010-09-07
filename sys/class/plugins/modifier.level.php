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
function smarty_modifier_level($string)
{
    return helper::get_level($string);
}