<?php /* Smarty version 2.6.26, created on 2010-08-18 20:12:49
         compiled from menu/dashboard.tpl */ ?>
<div class="dashboard">
				<ul>
					<li>
						<a href="?action=accounts">
							<img src="<?php echo @TPL_URL; ?>
i/kontact_contacts.png" alt="<?php echo $this->_tpl_vars['lang']['menu_acclist']; ?>
" />
							<?php echo $this->_tpl_vars['lang']['menu_acclist']; ?>

						</a>
					</li>
					<li>
						<a href="backup/">
							<img src="<?php echo @TPL_URL; ?>
i/backup.png" />
							<?php echo $this->_tpl_vars['lang']['backup']; ?>

						</a>
					</li>
					<li>
						<a href="?action=construct">
							<img src="<?php echo @TPL_URL; ?>
i/constructor.png" alt='<?php echo $this->_tpl_vars['lang']['construct']; ?>
'/>
							<?php echo $this->_tpl_vars['lang']['construct']; ?>

						</a>
					</li>
					<li>
						<a href="?action=search">
							<img src="<?php echo @TPL_URL; ?>
i/edit_find.png" alt="<?php echo $this->_tpl_vars['lang']['menu_search']; ?>
" />
							<?php echo $this->_tpl_vars['lang']['menu_search']; ?>

						</a>
					</li>
					<li>
						<a href="?action=statistic">
							<img src="<?php echo @TPL_URL; ?>
i/help_about.png" alt="<?php echo $this->_tpl_vars['lang']['menu_stat']; ?>
" />
							<?php echo $this->_tpl_vars['lang']['menu_stat']; ?>

						</a>
					</li>

					<li>
						<a href="index.php?action=favarites">
							<img src="<?php echo @TPL_URL; ?>
i/dashbookm.png" alt="My Bookmarks!" />
							<?php echo $this->_tpl_vars['lang']['bookmarks']; ?>

						</a>
					</li>

				</ul>
			</div>