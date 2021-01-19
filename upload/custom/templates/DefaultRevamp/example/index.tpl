{include file='header.tpl'}
{include file='navbar.tpl'}


<div class="ui stackable grid">
  <div class="ui centered row">
      <div class="ui {if count($WIDGETS)}ten wide tablet twelve wide computer{else}sixteen wide{/if} column">
          {$EXAMPLE_CONTENTXD}
      </div>
    {if count($WIDGETS)}
      <div class="ui six wide tablet four wide computer column">
        {foreach from=$WIDGETS item=widget}
          {$widget}
        {/foreach}
      </div>
    {/if}
  </div>
</div>

{include file='footer.tpl'}