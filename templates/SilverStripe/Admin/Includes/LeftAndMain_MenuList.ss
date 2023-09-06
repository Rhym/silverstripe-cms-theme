<ul class="cms-menu__list branded-menu">
  <% if $BrandedMainMenu %>
    <% loop $BrandedMainMenu %>
      <li
        class="branded-menu__list-item {$LinkingMode} {$FirstLast}<% if $Children %> branded-menu__list-item--children children <% end_if %><% if $LinkingMode == 'link' %><% else %>opened<% end_if %>"
        id="Menu-{$Code}" title="{$Title.ATT}"
      >
        <a href="{$Link}" {$AttributesHTML}>
          <% if $Children %>
            <span class="menu__icon {$Icon}"></span>
            <span class="text">{$Title}</span>
            <span class="menu__icon menu__icon--chevron font-icon-"></span>
          <% else %>
            <% if $IconClass %>
              <span class="menu__icon {$IconClass}"></span>
            <% else %>
              <span class="menu__icon menu__icon--image icon icon-16 icon-{$Icon}">&nbsp;</span>
            <% end_if %>
            <span class="text">{$Title}</span>
          <% end_if %>
        </a>
        <% if $Children %>
          <ul class="branded-menu branded-menu--child">
            <% loop $Children %>
              <li class="branded-menu__list-item $LinkingMode $FirstLast" id="Menu-{$Code}">
                <a href="{$Link}" {$AttributesHTML}>
                  <% if $IconClass %>
                    <span class="menu__icon {$IconClass}"></span>
                  <% else %>
                    <span class="menu__icon menu__icon--image icon icon-16 icon-{$Icon}">&nbsp;</span>
                  <% end_if %>
                  <span class="text">{$Title}</span>
                </a>
              </li>
            <% end_loop %>
          </ul>
        <% end_if %>
      </li>
    <% end_loop %>
  <% end_if %>
</ul>
