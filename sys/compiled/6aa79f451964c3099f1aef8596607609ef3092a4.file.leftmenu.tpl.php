<?php /* Smarty version Smarty3-b8, created on 2010-07-11 05:11:04
         compiled from "themes/menu/leftmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1705074374c391a28276717-85030517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aa79f451964c3099f1aef8596607609ef3092a4' => 
    array (
      0 => 'themes/menu/leftmenu.tpl',
      1 => 1278528361,
    ),
  ),
  'nocache_hash' => '1705074374c391a28276717-85030517',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="menu">
				<ul>
                  <li>
                        <a href="index.php">
                            <img src="<?php echo @TPL_URL;?>
img/icons/home.png" class="icon" alt="Main" />
                            <?php echo $_smarty_tpl->getVariable('lang')->value['menu_main'];?>

                        </a>
                    </li>
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="<?php echo @TPL_URL;?>
img/icons/list.png" class="icon" alt="Lists"/>
							<?php echo $_smarty_tpl->getVariable('lang')->value['lists'];?>

							<span></span>
						</a>
						
						 <!-- Sub items --> 
						<ol class="clearfix">
  
							<li>
								<a href="?action=accounts">
									<img src="<?php echo @TPL_URL;?>
img/icons/users.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_acclist'];?>
" />
									<?php echo $_smarty_tpl->getVariable('lang')->value['menu_acclist'];?>

								</a>
							</li>
							
							<li>
								<a href="?action=charlist">
									<img src="<?php echo @TPL_URL;?>
img/icons/chars.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_char_list'];?>
" />
									<?php echo $_smarty_tpl->getVariable('lang')->value['menu_char_list'];?>

								</a>
							</li>
							
							<li>
								<a href="?action=itemlist">
									<img src="<?php echo @TPL_URL;?>
img/icons/mail-small.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['itemlist'];?>
" />
									<?php echo $_smarty_tpl->getVariable('lang')->value['itemlist'];?>

									<span class="pin"><img src="<?php echo @TPL_URL;?>
img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
				
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="<?php echo @TPL_URL;?>
img/icons/add.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['adds'];?>
"/>
							<?php echo $_smarty_tpl->getVariable('lang')->value['adds'];?>

							<span></span>
						</a>
							
						<ol class="clearfix">
							<li>
								<a href="?action=additem">
									<img src="<?php echo @TPL_URL;?>
img/icons/plus-small.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['additemtitle'];?>
" />
									<?php echo $_smarty_tpl->getVariable('lang')->value['additemtitle'];?>

									<span class="pin"><img src="<?php echo @TPL_URL;?>
img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
					
					<li>
						<a href="./backup/">
							<img src="<?php echo @TPL_URL;?>
img/icons/database.png" class="icon" alt="Backup" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['backup'];?>

						</a>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL;?>
img/icons/statistics.png" class="icon" alt="<?php echo $_smarty_tpl->getVariable('lang')->value['menu_stat'];?>
" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['menu_stat'];?>

							<span></span>
						</a>
						
						<ol class="clearfix">
							<li><a href="index.php?action=statistic&type=total"><?php echo $_smarty_tpl->getVariable('lang')->value['statdata'];?>
</a></li>
							<li><a href="index.php?action=statistic&type=graph"><?php echo $_smarty_tpl->getVariable('lang')->value['graph'];?>
</a></li>
							<li><a href="index.php?action=statistic&type=online"><?php echo $_smarty_tpl->getVariable('lang')->value['online'];?>
</a></li>
						</ol>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL;?>
img/icons/tool2.png" class="icon" alt="" />
							<?php echo $_smarty_tpl->getVariable('lang')->value['tools'];?>

							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=create_account"><?php echo $_smarty_tpl->getVariable('lang')->value['create_acc'];?>
</a></li>
							<li><a href="index.php?action=items"><?php echo $_smarty_tpl->getVariable('lang')->value['itemwork'];?>
</a></li>
                            <?php if (isset($_smarty_tpl->getVariable('const_list')->value)){?><?php echo $_smarty_tpl->getVariable('const_list')->value;?>
<?php }?>
						</ol>
					</li>
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL;?>
img/icons/servers.png" class="icon" alt="" />
							Сервер
							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=droplist"><?php echo $_smarty_tpl->getVariable('lang')->value['droplist'];?>
</a></li>
							<li><a href="index.php?action=anonce"><?php echo $_smarty_tpl->getVariable('lang')->value['anonce'];?>
</a></li>
							<li><a href="index.php?action=variable"><?php echo $_smarty_tpl->getVariable('lang')->value['variables'];?>
</a></li>
							<li><a href="index.php?action=servers"><?php echo $_smarty_tpl->getVariable('lang')->value['servers'];?>
</a></li>
						
						</ol>
					</li>
				<?php if (isset($_smarty_tpl->getVariable('debug')->value)&&$_smarty_tpl->getVariable('debug')->value==TRUE){?>
					<li class="tasks widget">
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL;?>
img/icons/calendar-task.png" class="icon" alt="Tasks" />
							Debug
							<span></span>
						</a>
						<div class="content">
						<?php if ($_smarty_tpl->getVariable('debug')->value!==''){?><?php echo $_smarty_tpl->getVariable('debug')->value;?>
<?php }else{ ?>no data<?php }?>
						</div>
					</li>
				<?php }?>						
				</ul>
			</div>