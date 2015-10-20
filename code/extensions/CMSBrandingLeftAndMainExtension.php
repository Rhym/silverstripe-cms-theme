<?php

/**
 * Class CMSBrandingLeftAndMainExtension
 */
class CMSBrandingLeftAndMainExtension extends LeftAndMainExtension
{
    /**
     * @var string
     */
    private static $cms_menu_background = '#1b354c';
    /**
     * @var string
     */
    private static $cms_menu_color = '#fff';
    /**
     * @var string
     */
    private static $cms_highlight_color = '#ce0058';
    /**
     * @var string
     */
    private static $cms_highlight_background_color = '#ce0058';

    public function init()
    {
        Requirements::css(SILVERSTRIPE_BRANDING_MODULE . '/css/font-awesome.min.css');
        /** Set the background colour of the cms sidebar menu. */
        Requirements::customCSS(
            '.cms-menu .cms-logo span, .cms-menu .cms-login-status .logout-link {color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu .cms-menu-list li a, .cms-menu .cms-menu-list li.children li a {color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu .cms-menu-list li > a .icon.icon-16::before, .cms-menu .cms-menu-list li.children .grouped-cms-menu::after {color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu {background: ' . $this->owner->config()->cms_menu_background . ';}'
            . '.cms-menu .cms-menu-list li ul.collapsed-flyout {background: ' . $this->owner->config()->cms_menu_background . ';}'
            . '.cms-menu .cms-menu-list li .child-flyout-indicator  {border-right-color: ' . $this->owner->config()->cms_menu_color . ';border-bottom-color: ' . $this->owner->config()->cms_menu_color . ';}'
            . '.cms-menu .cms-menu-list li.current a, .cms-menu .cms-menu-list li.children ul li.current a {background: ' . $this->owner->config()->cms_menu_active_background_color . '; color: ' . $this->owner->config()->cms_menu_active_text_color . '}'
            . '.cms-menu .cms-menu-list li.current.children > a {color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu .cms-menu-list li.current.children > a .grouped-cms-menu::after {color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu .cms-menu-list li.current > a .icon::before, .cms-menu .cms-menu-list li.current > a .grouped-cms-menu::after {color: ' . $this->owner->config()->cms_menu_active_text_color . '}'
            . '.cms-menu .cms-menu-list li.current a:hover {background: ' . $this->owner->config()->cms_menu_active_background_color . ';}'
            . '.cms-menu .cms-menu-list li.current.children > a:hover {background: rgba(0, 0, 0, 0.25);}'
            . '.cms-menu .ss-ui-button.sticky-toggle::before{color: ' . $this->owner->config()->cms_menu_color . '}'
            . '.cms-menu .cms-panel-toggle.south .toggle-expand span,.cms-menu .cms-panel-toggle.south .toggle-collapse span{color: ' . $this->owner->config()->cms_menu_color . '}'
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
