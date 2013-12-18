[{*debug*}]
[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box=" "}]

<script type="text/javascript">
  if(top)
  {
    top.sMenuItem    = "[{ oxmultilang ident="mxservice" }]";
    top.sMenuSubItem = "[{ oxmultilang ident="pwsql_menu" }]";
    top.sWorkArea    = "[{$_act}]";
    top.setTitle();
  }

[{*}]
  
function editThis( sID )
{
    [{assign var="shMen" value=1}]

    [{foreach from=$menustructure item=menuholder }]
      [{if $shMen && $menuholder->nodeType == XML_ELEMENT_NODE && $menuholder->childNodes->length }]

        [{assign var="shMen" value=0}]
        [{assign var="mn" value=1}]

        [{foreach from=$menuholder->childNodes item=menuitem }]
          [{if $menuitem->nodeType == XML_ELEMENT_NODE && $menuitem->childNodes->length }]
            [{ if $menuitem->getAttribute('id') == 'mxorders' }]

              [{foreach from=$menuitem->childNodes item=submenuitem }]
                [{if $submenuitem->nodeType == XML_ELEMENT_NODE && $submenuitem->getAttribute('cl') == 'admin_order' }]

                    if ( top && top.navigation && top.navigation.adminnav ) {
                        var _sbli = top.navigation.adminnav.document.getElementById( 'nav-1-[{$mn}]-1' );
                        var _sba = _sbli.getElementsByTagName( 'a' );
                        top.navigation.adminnav._navAct( _sba[0] );
                    }

                [{/if}]
              [{/foreach}]

            [{ /if }]
            [{assign var="mn" value=$mn+1}]

          [{/if}]
        [{/foreach}]
      [{/if}]
    [{/foreach}]

    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='article';
    oTransfer.submit();
} [{*}]
</script>

<div class="center">
    <h1>[{ oxmultilang ident="PWSQL_TITLE" }]</h1>
    <p>
        <form name="pwsql" id="pwsql_srcval" action="[{ $oViewConf->selflink }]" method="post">
        [{ $oViewConf->hiddensid }]
        <input type="hidden" name="cl" value="pwsql">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <table width="95%"><tr>
        <td align="left" width=90%>
            <label>[{ oxmultilang ident="PWSQL_LABEL" }]</label> 
			<textarea name="pwsql_srcval" cols="200" rows="6">[{ $pwsql_srcval }]</textarea> 
        </td>
        <td align="right" width=10%>
            <input type="submit" value=" [{ oxmultilang ident="PWSQL_SUBMITBUTTON" }] " /><br>
		[{ if !empty($aColumnNames)}]
			<a href="[{$oView->getDownloadUrl()}]" target="_blank">[{ oxmultilang ident="PWSQL_DOWNLOAD" }]</a>
		[{ /if }]
        </td>
        </tr></table>
		</form>
		<b>[{ oxmultilang ident="PWSQL_PERFORMANCE_RISK" }]

    </p>
    <p>
        <h3>[{ oxmultilang ident="PWSQL_NUMBER_ROWS" }]: [{$aSql|@count}]</h3>
        <table width="100%">
        <thead><tr bgcolor="#dddddd">
		
		[{foreach name=collum  item=columnname from=$aColumnNames }]
		    <th align="left">[{$columnname}]</th>
	    [{/foreach}]
         </tr></thead>

        <tbody>
        [{foreach name=outer item=SQLITEM from=$aSql}]
            <tr bgcolor="[{cycle values="#ffffff,#f0f0f0"}]">
			[{foreach name=inner item=rowitem from=$SQLITEM}]
                 <td> [{$rowitem}] </td>
		     [{/foreach}]
  
  </tr>
        [{/foreach}]
        </tbody>

        </table>
    </p>
    <hr>
</div>
