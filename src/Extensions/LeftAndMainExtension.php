<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

/**
 * Class LeftAndMainExtension
 * @package RyanPotter\SilverStripeCMSTheme\Extensions
 * @property \SilverStripe\Admin\LeftAndMain $owner
 */
class LeftAndMainExtension extends Extension
{
  public function init()
  {
    $config = LeftAndMain::config();
    $cms_background = !$config->cms_background ? '#1d48a0' : $config->cms_background;
    $cms_border_color = !$config->cms_border_color ? '#173778' : $config->cms_border_color;
    $cms_color = !$config->cms_color ? '#fff' : $config->cms_color;
    $cms_hover_background = !$config->cms_hover_background ? 'inherit' : $config->cms_hover_background;
    $cms_hover_color = !$config->cms_hover_color ? 'currentColor' : $config->cms_hover_color;
    $cms_active_background = !$config->cms_active_background ? '#173778' : $config->cms_active_background;
    $cms_active_color = !$config->cms_active_color ? 'currentColor' : $config->cms_active_color;
    $cms_drawer_background = !$config->cms_drawer_background ? '#1a3e88' : $config->cms_drawer_background;
    $cms_drawer_color = !$config->cms_drawer_color ? 'currentColor' : $config->cms_drawer_color;
    $cms_icon_color = !$config->cms_icon_color ? 'currentColor' : $config->cms_icon_color;

    Requirements::insertHeadTags('<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">');
    Requirements::css('ryanpotter/silverstripe-cms-theme:dist/main.css');

    Requirements::customCSS(
      '.cms-mobile-menu-toggle {background: ' . $cms_background . ' !important; color: ' . $cms_color . ' !important;}' .
      '.cms-mobile-menu-toggle.cms-mobile-menu-toggle--open {background: ' . $cms_active_background . ' !important; color: ' . $cms_active_color . ' !important;}'
    );

    // CMS Menu Header
    Requirements::customCSS(
      '.cms-menu__header {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.cms-menu__header span, .cms-login-status .cms-login-status__profile-link, .cms-login-status .cms-login-status__logout-link, .cms-sitename .cms-sitename__title {color: ' . $cms_color . ' !important;}' .
      '.cms-sitename {border-color: ' . $cms_border_color . ' !important;}' .
      '.cms-sitename:hover, .cms-sitename:focus {background-color: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}' .
      '.cms-login-status .cms-login-status__profile-link:focus, .cms-login-status .cms-login-status__profile-link:hover, .cms-login-status .cms-login-status__profile-link:focus span, .cms-login-status .cms-login-status__profile-link:hover span {background-color: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}' .
      '.cms-login-status .cms-login-status__logout-link:focus, .cms-login-status .cms-login-status__logout-link:hover {background-color: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}'
    );

    // Menu List
    Requirements::customCSS(
      '.cms-menu {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.cms-menu__list li a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-menu__list li a:hover, .cms-menu__list li a:focus {background: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}' .
      '.cms-menu__list li.current a {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}' .
      '.cms-menu__list li a .text::after {color: ' . $cms_color . ' !important;}' .
      '.cms-menu .cms-panel-content {-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important; box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-mobile-menu-toggle.cms-mobile-menu-toggle--open {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}'
    );

    // Branded Menu
    Requirements::customCSS(
      '.branded-menu__list-item--children.opened a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu__list-item--children.opened a:hover, .branded-menu__list-item--children.opened a:focus, .cms .branded-menu .branded-menu__list-item--children.opened>a:focus, .cms .branded-menu .branded-menu__list-item--children>a:focus {background: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.current a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a {background: ' . $cms_drawer_background . ' !important;color: ' . $cms_drawer_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened {background: ' . $cms_drawer_background . ' !important;color: ' . $cms_drawer_color . ' !important;}' .
      '.branded-menu__list-item--children .branded-menu__list-item {background: ' . $cms_drawer_background . ' !important;color: ' . $cms_drawer_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a:hover, .branded-menu .branded-menu__list-item--children.opened a:focus {background: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children .branded-menu__list-item.current a {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}' .
      '.cms .branded-menu .branded-menu__list-item--children > a:hover, .cms .branded-menu .branded-menu__list-item--children.opened > a:hover {background: ' . $cms_hover_background . ' !important;color: ' . $cms_hover_color . ' !important;}'
    );

    // CMS Menu Footer
    Requirements::customCSS(
      '.cms-menu .cms-panel-toggle {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important; border-color: ' . $cms_border_color . ' !important;-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-panel .cms-panel-toggle .toggle-collapse span, .cms-panel .cms-panel-toggle .toggle-expand span {color: ' . $cms_color . ' !important}' .
      '.cms-menu .sticky-status-indicator {color: ' . $cms_color . ' !important}'
    );

    // Icons
    Requirements::customCSS(
      '.cms .menu__icon, .cms-login-status__profile-link i, .cms-login-status .cms-login-status__logout-link {color: ' . $cms_icon_color . ' !important;}' .
      '.cms-menu__list > li.current:not(.branded-menu__list-item--children) > a > .menu__icon {color: currentColor !important;}' .
      '.branded-menu.branded-menu--child > li.current > a > .menu__icon {color: currentColor !important;}'
    );
  }

  /**
   * @param null $controller
   * @return mixed|string
   */
  public function BrandedMenuClass($controller = null)
  {
    $class = 'icon-' . strtolower($controller);
    if ($alternative = Config::inst()->get($controller, 'menu_icon_class')) {
      $class = $alternative;
    }

    return $class;
  }

  /**
   * @param bool $cached
   * @return mixed
   */
  public function BrandedMainMenu($cached = true)
  {
    $mainMenu = $this->owner->MainMenu($cached);
    if ($this->owner->has_extension(GroupedCmsMenu::class)) {
      $mainMenu = $this->owner->GroupedMainMenu($cached);
    }

    return $mainMenu;
  }
}
