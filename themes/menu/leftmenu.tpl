<div id="menu">
				<ul>
                  <li>
                        <a href="index.php">
                            <img src="{$smarty.const.TPL_URL}img/icons/home.png" class="icon" alt="Main" />
                            {$lang.menu_main}
                        </a>
                    </li>
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="{$smarty.const.TPL_URL}img/icons/list.png" class="icon" alt="Lists"/>
							{$lang.lists}
							<span></span>
						</a>
						
						 <!-- Sub items --> 
						<ol class="clearfix">
  
							<li>
								<a href="?action=accounts">
									<img src="{$smarty.const.TPL_URL}img/icons/users.png" class="icon" alt="{$lang.menu_acclist}" />
									{$lang.menu_acclist}
								</a>
							</li>
							
							<li>
								<a href="?action=charlist">
									<img src="{$smarty.const.TPL_URL}img/icons/chars.png" class="icon" alt="{$lang.menu_char_list}" />
									{$lang.menu_char_list}
								</a>
							</li>
							
							<li>
								<a href="?action=itemlist">
									<img src="{$smarty.const.TPL_URL}img/icons/mail-small.png" class="icon" alt="{$lang.itemlist}" />
									{$lang.itemlist}
									<span class="pin"><img src="{$smarty.const.TPL_URL}img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
				
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="{$smarty.const.TPL_URL}img/icons/add.png" class="icon" alt="{$lang.adds}"/>
							{$lang.adds}
							<span></span>
						</a>
							
						<ol class="clearfix">
							<li>
								<a href="?action=additem">
									<img src="{$smarty.const.TPL_URL}img/icons/plus-small.png" class="icon" alt="{$lang.additemtitle}" />
									{$lang.additemtitle}
									<span class="pin"><img src="{$smarty.const.TPL_URL}img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
					
					<li>
						<a href="./backup/">
							<img src="{$smarty.const.TPL_URL}img/icons/database.png" class="icon" alt="Backup" />
							{$lang.backup}
						</a>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="{$smarty.const.TPL_URL}img/icons/statistics.png" class="icon" alt="{$lang.menu_stat}" />
							{$lang.menu_stat}
							<span></span>
						</a>
						
						<ol class="clearfix">
							<li><a href="index.php?action=statistic&type=total">{$lang.statdata}</a></li>
							<li><a href="index.php?action=statistic&type=graph">{$lang.graph}</a></li>
							<li><a href="index.php?action=statistic&type=online">{$lang.online}</a></li>
						</ol>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="{$smarty.const.TPL_URL}img/icons/tool2.png" class="icon" alt="" />
							{$lang.tools}
							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=create_account">{$lang.create_acc}</a></li>
							<li><a href="index.php?action=items">{$lang.itemwork}</a></li>
                            {if isset($const_list)}{$const_list}{/if}
						</ol>
					</li>
					<li>
						<a href="javascript:void(0)">
							<img src="{$smarty.const.TPL_URL}img/icons/servers.png" class="icon" alt="" />
							Сервер
							<span></span>
						</a>
						<ol class="clearfix">
							<li><a href="index.php?action=droplist">{$lang.droplist}</a></li>
							<li><a href="index.php?action=anonce">{$lang.anonce}</a></li>
							<li><a href="index.php?action=variable">{$lang.variables}</a></li>
							<li><a href="index.php?action=servers">{$lang.servers}</a></li>
						
						</ol>
					</li>
				{if isset($debug) && $debug==TRUE}
					<li class="tasks widget">
						<a href="javascript:void(0)">
							<img src="{$smarty.const.TPL_URL}img/icons/calendar-task.png" class="icon" alt="Tasks" />
							Debug
							<span></span>
						</a>
						<div class="content">
						{if $debug !==''}{$debug}{else}no data{/if}
						</div>
					</li>
				{/if}						
				</ul>
			</div>