<h2>AionCP 1.0 - Installer</h2>
<h3>Choose your language</h3>
<h2>
{foreach key=key item=l from=$lang_list}
  <a href='?l={$key}'><img src="{$smarty.const.TPL_URL}{$l.icon}" title="{$l.lang}"></a> &nbsp;
{/foreach}
</h2>