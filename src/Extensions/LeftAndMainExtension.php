<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

class LeftAndMainExtension extends DataExtension
{
  private static $cms_header_background = '#23282d';
  private static $cms_header_color = '#fff';

  private static $cms_menu_background = '#23282d';
  private static $cms_menu_color = '#fff';
  private static $cms_menu_active_background = '#ce0058';
  private static $cms_menu_active_color = '#fff';

  private static $cms_footer_background = '#23282d';
  private static $cms_footer_color = '#fff';

  public function init()
  {
    // CMS MenuHeader
    $header_background = $this->owner->config()->cms_header_background;
    $header_background_dark = $this->darken($header_background, 10);
    $header_color = $this->owner->config()->cms_header_color;

    Requirements::customCSS(
      '.cms-menu__header {background: ' . $header_background . ' !important;color: ' . $header_color . ' !important;}' .
      '.cms-sitename {border-color: ' . $header_background_dark . ' !important;}'
    );

    // CMS Menu
    $menu_background = $this->owner->config()->cms_menu_background;
    $menu_active_background = $this->owner->config()->cms_menu_active_background;
    $menu_background_dark = $this->darken($menu_background, 10);
    $menu_background_darker = $this->darken($menu_background, 20);
    $menu_background_darkest = $this->darken($menu_background, 30);
    $menu_color = $this->owner->config()->cms_menu_color;
    $menu_active_color = $this->owner->config()->cms_menu_active_color;

    Requirements::customCSS(
      '.cms-menu {background: ' . $menu_background . ' !important;color: ' . $menu_color . ' !important;}' .
      '.cms-menu__list li a {background: ' . $menu_background . ' !important;color: ' . $menu_color . ' !important;-webkit-box-shadow: inset ' . $menu_background_dark . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $menu_background_dark . ' !important;}' .
      '.cms-menu__list li a:hover {background: ' . $menu_background_dark . ' !important;}' .
      '.cms-menu__list li.current a {background: ' . $menu_active_background . ' !important;color: ' . $menu_active_color . ' !important;}' .
      '.cms-menu__list .menu__icon {color: ' . $menu_color . ' !important;}' .
      '.cms-menu__list li a .text::after {color: ' . $menu_color . ' !important;}' .
      '.cms-menu .cms-panel-content {-webkit-box-shadow: inset ' . $menu_background_dark . ' -1px 0 0 !important; box-shadow: inset -1px 0 0 ' . $menu_background_dark . ' !important;}' .
      '.cms-mobile-menu-toggle.cms-mobile-menu-toggle--open {background: ' . $menu_active_background . ' !important;color: ' . $menu_active_color . ' !important;}'
    );

    // Branded Menu
    Requirements::customCSS(
      '.branded-menu__list-item--children.opened a {background: ' . $menu_background_dark . ' !important;color: ' . $menu_color . ' !important;}' .
      '.branded-menu__list-item--children.opened a:hover {background: ' . $menu_background_darker . ' !important;color: ' . $menu_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.current a {background: ' . $menu_background_dark . ' !important;color: ' . $menu_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children.opened a:hover {background: ' . $menu_background_darkest . ' !important;color: ' . $menu_color . ' !important;}' .
      '.branded-menu .branded-menu__list-item--children .branded-menu__list-item.current a {background: ' . $menu_active_background . ' !important;color: ' . $menu_active_color . ' !important;}'
    );

    // CMS Menu Footer
    $footer_background = $this->owner->config()->cms_footer_background;
    $footer_background_dark = $this->darken($footer_background, 10);
    $footer_color = $this->owner->config()->cms_footer_color;

    Requirements::customCSS(
      '.cms-menu .cms-panel-toggle {background: ' . $footer_background . ' !important;color: ' . $footer_color . ' !important; border-color: ' . $footer_background_dark . ' !important;-webkit-box-shadow: inset ' . $footer_background_dark . ' -1px 0 0 !important;box-shadow: inset -1px 0 0 ' . $footer_background_dark . ' !important;}' .
      '.cms-panel .cms-panel-toggle .toggle-collapse span, .cms-panel .cms-panel-toggle .toggle-expand span {color: ' . $footer_color . ' !important}' .
      '.cms-menu .sticky-status-indicator {color: ' . $footer_color . ' !important}'
    );
  }

  /**
   * Darken a colour by a percentage.
   * @param $hex
   * @param $percent
   * @return string
   */
  private function darken($hex, $percent)
  {
    preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
    str_replace('%', '', $percent);
    $color = "#";
    for ($i = 1; $i <= 3; $i++) {
      $primary_colors[$i] = hexdec($primary_colors[$i]);
      $primary_colors[$i] = round($primary_colors[$i] * (100 - ($percent * 2)) / 100);
      $color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
    }
    return $color;
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
