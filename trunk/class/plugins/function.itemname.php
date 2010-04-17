<?php
function quicky_function_itemname($params,$quicky)
{
    if(isset($params['id'])){
        // include('./../controller.php');
         $cp		=	new cpanel;
         return $cp->get_item_name($params['id']);
    }


}