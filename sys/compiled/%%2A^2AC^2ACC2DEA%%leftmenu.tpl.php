<?php /* Smarty version 2.6.26, created on 2010-08-18 20:12:49
         compiled from menu/leftmenu.tpl */ ?>
<div id="menu">
				<ul>
                  <li>
                        <a href="index.php">
                            <img src="<?php echo @TPL_URL; ?>
img/icons/home.png" class="icon" alt="Main" />
                            <?php echo $this->_tpl_vars['lang']['menu_main']; ?>

                        </a>
                    </li>
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="<?php echo @TPL_URL; ?>
img/icons/list.png" class="icon" alt="Lists"/>
							<?php echo $this->_tpl_vars['lang']['lists']; ?>

							<span></span>
						</a>
						
						 <!-- Sub items --> 
						<ol class="clearfix">
  
							<li>
								<a href="?action=accounts">
									<img src="<?php echo @TPL_URL; ?>
img/icons/users.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['menu_acclist']; ?>
" />
									<?php echo $this->_tpl_vars['lang']['menu_acclist']; ?>

								</a>
							</li>
							
							<li>
								<a href="?action=charlist">
									<img src="<?php echo @TPL_URL; ?>
img/icons/chars.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['menu_char_list']; ?>
" />
									<?php echo $this->_tpl_vars['lang']['menu_char_list']; ?>

								</a>
							</li>
							
							<li>
								<a href="?action=itemlist">
									<img src="<?php echo @TPL_URL; ?>
img/icons/mail-small.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['itemlist']; ?>
" />
									<?php echo $this->_tpl_vars['lang']['itemlist']; ?>

									<span class="pin"><img src="<?php echo @TPL_URL; ?>
img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
				
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="<?php echo @TPL_URL; ?>
img/icons/add.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['adds']; ?>
"/>
							<?php echo $this->_tpl_vars['lang']['adds']; ?>

							<span></span>
						</a>
							
						<ol class="clearfix">
							<li>
								<a href="?action=additem">
									<img src="<?php echo @TPL_URL; ?>
img/icons/plus-small.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['additemtitle']; ?>
" />
									<?php echo $this->_tpl_vars['lang']['additemtitle']; ?>

									<span class="pin"><img src="<?php echo @TPL_URL; ?>
img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
					
					<li>
						<a href="./backup/">
							<img src="<?php echo @TPL_URL; ?>
img/icons/database.png" class="icon" alt="Backup" />
							<?php echo $this->_tpl_vars['lang']['backup']; ?>

						</a>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL; ?>
img/icons/statistics.png" class="icon" alt="<?php echo $this->_tpl_vars['lang']['menu_stat']; ?>
" />
							<?php echo $this->_tpl_vars['lang']['menu_stat']; ?>

							<span></span>
						</a>
						
						<ol class="clearfix">
							<li><a href="index.php?action=statistic&type=total"><?php echo $this->_tpl_vars['lang']['statdata']; ?>
</a></li>
							<li><a href="index.php?action=statistic&type=graph"><?php echo $this->_tpl_vars['lang']['graph']; ?>
</a></li>
							<li><a href="index.php?action=statistic&type=online"><?php echo $this->_tpl_vars['lang']['online']; ?>
</a></li>
						</ol>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL; ?>
img/icons/tool2.png" class="icon" alt="" />
							<?php echo $this->_tpl_vars['lang']['tools']; ?>

							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=create_account"><?php echo $this->_tpl_vars['lang']['create_acc']; ?>
</a></li>
							<li><a href="index.php?action=items"><?php echo $this->_tpl_vars['lang']['itemwork']; ?>
</a></li>
                            <?php if (isset ( $this->_tpl_vars['const_list'] )): ?><?php echo $this->_tpl_vars['const_list']; ?>
<?php endif; ?>
						</ol>
					</li>
					<li>
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL; ?>
img/icons/servers.png" class="icon" alt="" />
							Сервер
							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=droplist"><?php echo $this->_tpl_vars['lang']['droplist']; ?>
</a></li>
							<li><a href="index.php?action=anonce"><?php echo $this->_tpl_vars['lang']['anonce']; ?>
</a></li>
							<li><a href="index.php?action=variable"><?php echo $this->_tpl_vars['lang']['variables']; ?>
</a></li>
							<li><a href="index.php?action=servers"><?php echo $this->_tpl_vars['lang']['servers']; ?>
</a></li>
						
						</ol>
					</li>
				<?php if (isset ( $this->_tpl_vars['debug'] ) && $this->_tpl_vars['debug'] == TRUE): ?>
					<li class="tasks widget">
						<a href="javascript:void(0)">
							<img src="<?php echo @TPL_URL; ?>
img/icons/calendar-task.png" class="icon" alt="Tasks" />
							Debug
							<span></span>
						</a>
						<div class="content">
						<?php if ($this->_tpl_vars['debug'] !== ''): ?><?php echo $this->_tpl_vars['debug']; ?>
<?php else: ?>no data<?php endif; ?>
						</div>
					</li>
				<?php endif; ?>						
				</ul>
			</div>