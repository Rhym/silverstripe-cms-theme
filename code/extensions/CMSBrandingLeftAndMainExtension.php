<?php

/**
 * Class CMSBrandingLeftAndMainExtension
 */
class CMSBrandingLeftAndMainExtension extends LeftAndMainExtension
{
  /**
   * @var string
   */
  private static $cms_menu_background = '#1976D2';
  /**
   * @var string
   */
  private static $cms_menu_color = '#fff';

  public function init()
  {
    Requirements::customCSS(
      '.cms-menu .cms-logo-header {background: ' . $this->owner->config()->cms_menu_background . ' !important;color: ' . $this->owner->config()->cms_menu_color . ' !important;}'
      . '.ss-loading-screen .loading-logo::after, .cms-content-loading-spinner::after {border-top-color: ' . $this->owner->config()->cms_menu_background . ' !important;}'
    );
  }

  /**
   * @param null $controller
   * @return string
   */
  public function BrandedMenuClass($controller = null)
  {
    $class = 'icon-' . strtolower($controller);

    if ($alternative = Config::inst()->get($controller, 'menu_icon_class', Config::FIRST_SET)) {
      $class = $alternative;
    }

    return $class;
  }

  /**
   * @param bool $cached
   * @return ArrayList
   */
  public function BrandedMainMenu($cached = true)
  {
    $mainMenu = $this->owner->MainMenu($cached);

    if ($this->owner->has_extension('GroupedCmsMenu')) {
      $mainMenu = $this->owner->GroupedMainMenu($cached);
    }

    return $mainMenu;
  }
}
