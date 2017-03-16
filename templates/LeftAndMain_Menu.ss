<div class="cms-menu cms-panel cms-panel-layout west" id="cms-menu" data-layout-type="border">
  <div class="cms-logo-header north">
    <div class="cms-logo">
      <a href="$ApplicationLink" target="_blank" title="$ApplicationName (Version - $CMSVersion)">
        $ApplicationName <% if $CMSVersion %><abbr class="version">$CMSVersion</abbr><% end_if %>
      </a>
      <% if $SiteConfig.CustomCMSLogo %>
        <% if $SiteConfig.CustomCMSLogo.is_a('DataObject') %>
          <div class="logo">
            <a class="front-end-link" href="{$BaseHref}" target="_blank">{$SiteConfig.CustomCMSLogo}</a>
          </div>
        <% else %>
          <div class="logo">
            <a class="front-end-link" href="{$BaseHref}" target="_blank">
              <img src="{$SiteConfig.CustomCMSLogo}" alt="$SiteConfig.Title CMS Logo">
            </a>
          </div>
        <% end_if %>
      <% else %>
        <span><% if $SiteConfig %>$SiteConfig.Title<% else %>$ApplicationName<% end_if %></span>
      <% end_if %>
    </div>
    <div class="cms-login-status">
      <a href="Security/logout" class="logout-link"
         title="<% _t('LeftAndMain_Menu_ss.LOGOUT','Log out') %>"><% _t('LeftAndMain_Menu_ss.LOGOUT','Log out') %></a>
      <% with $CurrentMember %>
        <span>
					<% _t('LeftAndMain_Menu_ss.Hello','Hi') %>
          <a href="{$AbsoluteBaseURL}admin/myprofile" class="profile-link">
            <% if $FirstName && $Surname %>$FirstName $Surname<% else_if $FirstName %>$FirstName<% else %>$Email<% end_if %>
          </a>
				</span>
      <% end_with %>
    </div>
  </div>
  <div class="cms-panel-content center">
    <ul class="cms-menu-list">
      <% if $BrandedMainMenu %>
        <% loop $BrandedMainMenu %>
          <li
            class="$LinkingMode $FirstLast<% if $Children %> children <% end_if %><% if $LinkingMode == 'link' %><% else %>opened<% end_if %>"
            id="Menu-$Code" title="$Title.ATT">
            <a href="$Link" $AttributesHTML>
              <% if $Children %>
                <span class="grouped-cms-menu text">$Title</span>
              <% else %>
                <span class="icon icon-16 {$Top.BrandedMenuClass($MenuItem.controller)}">&nbsp;</span>
                <span class="text">$Title</span>
              <% end_if %>
            </a>
            <% if $Children %>
              <ul>
                <% loop $Children %>
                  <li class="$LinkingMode $FirstLast" id="Menu-$Code">
                    <a href="$Link" $AttributesHTML>
                      <span class="icon icon-16 {$Top.BrandedMenuClass($MenuItem.controller)}">&nbsp;</span>
                      <span class="text">$Title</span>
                    </a>
                  </li>
                <% end_loop %>
              </ul>
            <% end_if %>
          </li>
        <% end_loop %>
      <% end_if %>
    </ul>
  </div>
  <div class="cms-panel-toggle south">
    <button class="sticky-toggle" type="button" title="Sticky nav">Sticky nav</button>
    <span class="sticky-status-indicator">auto</span>
    <a class="toggle-expand" href="#"><span>&raquo;</span></a>
    <a class="toggle-collapse" href="#"><span>&laquo;</span></a>
  </div>
</div>
