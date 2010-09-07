<?php /* Smarty version Smarty3-b8, created on 2010-07-11 05:11:03
         compiled from "themes/menu/dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1258166304c391a27dd25d3-92831803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51de673d6294e3da880134838965978847b6f163' => 
    array (
      0 => 'themes/menu/dashboard.tpl',
      1 => 1276725360,
    ),
  ),
  'nocache_hash' => '1258166304c391a27dd25d3-92831803',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="dashboard">
				<ul>
					<li>
						<a href="?action=accounts">
							<img src="<?php echo @TPL_URL;?>
i/kontact_contacts.png" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_acclist'];?>
" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['menu_acclist'];?>

						</a>
					</li>
					<li>
						<a href="backup/">
							<img src="<?php echo @TPL_URL;?>
i/backup.png" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['backup'];?>

						</a>
					</li>
					<li>
						<a href="?action=construct">
							<img src="<?php echo @TPL_URL;?>
i/constructor.png" alt='<?php echo $_smarty_tpl->getVariable('lang')->value['construct'];?>
'/>
							<?php echo $_smarty_tpl->getVariable('lang')->value['construct'];?>

						</a>
					</li>
					<li>
						<a href="?action=search">
							<img src="<?php echo @TPL_URL;?>
i/edit_find.png" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_search'];?>
" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['menu_search'];?>

						</a>
					</li>
					<li>
						<a href="?action=statistic">
							<img src="<?php echo @TPL_URL;?>
i/help_about.png" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_stat'];?>
" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['menu_stat'];?>

						</a>
					</li>

					<li>
						<a href="index.php?action=favarites">
							<img src="<?php echo @TPL_URL;?>
i/dashbookm.png" alt="My Bookmarks!" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['bookmarks'];?>

						</a>
					</li>

				</ul>
			</div>