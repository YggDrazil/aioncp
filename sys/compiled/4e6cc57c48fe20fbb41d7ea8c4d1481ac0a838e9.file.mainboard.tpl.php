<?php /* Smarty version Smarty3-b8, created on 2010-07-11 05:11:04
         compiled from "themes/menu/mainboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1063526344c391a28055022-64214880%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e6cc57c48fe20fbb41d7ea8c4d1481ac0a838e9' => 
    array (
      0 => 'themes/menu/mainboard.tpl',
      1 => 1278528373,
    ),
  ),
  'nocache_hash' => '1063526344c391a28055022-64214880',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="dashboard mainboard">
				<ul>
					<li>
						<a href="?action=droplist">
							<img src="<?php echo @TPL_URL;?>
i/droplist.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['droplist'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/quest.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['quests'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/banchat.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['banchat'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/legions.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['legions'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/blockip.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['banip'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/mail.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['mail'];?>

						</a>
					</li>
					<li>
						<a href="#">
							<img src="<?php echo @TPL_URL;?>
i/vars.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['variables'];?>

						</a>
					</li>
					<li>
						<a href="?action=anonce">
							<img src="<?php echo @TPL_URL;?>
i/anonces.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['anonce'];?>

						</a>
					</li>					

				</ul>
			</div>