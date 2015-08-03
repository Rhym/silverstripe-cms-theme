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
    private static $cms_highlight_color = '#ce0058';
    /**
     * @var string
     */
    private static $cms_highlight_background_color = '#ce0058';

    public function init()
    {
        /** Set the background colour of the cms sidebar menu. */
        Requirements::customCSS(
            '.cms-menu {background: ' . $this->owner->config()->cms_menu_background . ';}'
            . '.cms-menu .cms-menu-list li.current a, .cms-menu .cms-menu-list li.children.current > a {background: ' . $this->owner->config()->cms_menu_active_background_color . '; color: ' . $this->owner->config()->cms_menu_active_text_color . '}'
            . '.cms-menu .cms-menu-list li.current a:hover  {background: ' . $this->owner->config()->cms_menu_active_background_color . ';}'
        );
    }

}
