<?php /* Smarty version Smarty3-b8, created on 2010-08-06 15:20:22
         compiled from "themes/droplist_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:510571324c5beff6a99a05-54438336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eece5d78d86eae4d8934c813e7f35b119bfe7b40' => 
    array (
      0 => 'themes/droplist_edit.tpl',
      1 => 1276087920,
    ),
  ),
  'nocache_hash' => '510571324c5beff6a99a05-54438336',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="fields">

<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('row')->value['Id'];?>
" id="id">
<p>
	<label class="small">Предмет</label>
	<input type="text" name='itemId' id="itemId" value="<?php echo $_smarty_tpl->getVariable('row')->value['itemId'];?>
" class="sText"/>
</p>
<p>
	<label class="small">Мин</label>
	<input type="text" name='min' id="min" value="<?php echo $_smarty_tpl->getVariable('row')->value['min'];?>
" class="sText"/>
</p>
<p>
	<label class="small">Макс</label>
	<input type="text" name='max'  id="max" value="<?php echo $_smarty_tpl->getVariable('row')->value['max'];?>
" class="sText"/>

</p>
<p>
	<label class="small">Id моба</label>
	<input type="text" name='mobId' id="mobId" value="<?php echo $_smarty_tpl->getVariable('row')->value['mobId'];?>
" class="sText"/>

</p>
<p class='switch'>
	<label class="small">Шанс</label>
	<input type="text" name='chance' id="chance" value="<?php echo $_smarty_tpl->getVariable('row')->value['chance'];?>
" class="sText"/>

</p>
</div><!-- fields -->