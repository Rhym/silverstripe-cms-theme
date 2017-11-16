<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

/**
 * Class LeftAndMainExtension
 * @package RyanPotter\SilverStripeCMSTheme\Extensions
 */
class LeftAndMainExtension extends DataExtension
{
  private static $cms_background = '#0747A6';
  private static $cms_border_color = '#173778';
  private static $cms_color = '#fff';
  private static $cms_hover_background = '#093684';
  private static $cms_active_background = '#173778';
  private static $cms_active_color = '#fff';
  private static $cms_drawer_background = '#0e418e';

  public function init()
  {
    Requirements::css('ryanpotter/silverstripe-cms-theme:dist/main.css');
    Requirements::css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    $config = $this->owner->config();

    $cms_background = $config->get('cms_background');
    $cms_border_color = $config->get('cms_border_color');
    $cms_color = $config->get('cms_color');
    $cms_hover_background = $config->get('cms_hover_background');
    $cms_active_background = $config->get('cms_active_background');
    $cms_active_color = $config->get('cms_active_color');
    $cms_drawer_background = $config->get('cms_drawer_background');

    // CMS Menu Header
    Requirements::customCSS(
      '.cms-menu__header {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.cms-sitename {border-color: ' . $cms_border_color . ' !important;}' .
      '.cms-sitename:hover, .cms-sitename:focus {background-color: ' . $cms_hover_background . ' !important}' .
      '.cms-login-status .cms-login-status__profile-link:focus, .cms-login-status .cms-login-status__profile-link:hover {background-color: ' . $cms_hover_background . ' !important;}' .
      '.cms-login-status .cms-login-status__logout-link:focus, .cms-login-status .cms-login-status__logout-link:hover {background-color: ' . $cms_hover_background . ' !important;}'
    );

    // Menu List
    Requirements::customCSS(
      '.cms-menu {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.cms-menu__list li a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-menu__list li a:hover, .cms-menu__list li a:focus {background: ' . $cms_hover_background . ' !important;}' .
      '.cms-menu__list li.current a {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}' .
      '.cms-menu__list li a .text::after {color: ' . $cms_color . ' !important;}' .
      '.cms-menu .cms-panel-content {-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important; box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-mobile-menu-toggle.cms-mobile-menu-toggle--open {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}'
    );

    // Branded Menu
    Requirements::customCSS(
      '.branded-menu__list-item--children.opened a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu__list-item--children.opened a:hover, .branded-menu__list-item--children.opened a:focus {background: ' . $cms_hover_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.current a {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a {background: ' . $cms_drawer_background . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened {background: ' . $cms_drawer_background . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a:hover, .branded-menu .branded-menu__list-item--children.opened a:focus {background: ' . $cms_border_color . ' !important;color: ' . $cms_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children .branded-menu__list-item.current a {background: ' . $cms_active_background . ' !important;color: ' . $cms_active_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a:first-child:hover, .branded-menu .branded-menu__list-item--children a:first-child:hover {background: ' . $cms_border_color . ' !important;color: ' . $cms_color . ' !important;}'
    );

    // CMS Menu Footer
    Requirements::customCSS(
      '.cms-menu .cms-panel-toggle {background: ' . $cms_background . ' !important;color: ' . $cms_color . ' !important; border-color: ' . $cms_border_color . ' !important;-webkit-box-shadow: inset ' . $cms_border_color . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $cms_border_color . ' !important;}' .
      '.cms-panel .cms-panel-toggle .toggle-collapse span, .cms-panel .cms-panel-toggle .toggle-expand span {color: ' . $cms_color . ' !important}' .
      '.cms-menu .sticky-status-indicator {color: ' . $cms_color . ' !important}'
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

    if ($this->owner->has_extension('RyanPotter\SilverStripeCMSTheme\Extensions\GroupedCmsMenu')) {
      $mainMenu = $this->owner->GroupedMainMenu($cached);
    }

    return $mainMenu;
  }
}
