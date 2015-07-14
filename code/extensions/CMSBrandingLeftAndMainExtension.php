<?php

/**
 * Class CMSBrandingLeftAndMainExtension
 */
class CMSBrandingLeftAndMainExtension extends LeftAndMainExtension {

    private static $cms_menu_background = '#1b354c';

    public function init(){
        /** Set the background colour of the cms sidebar menu. */
        Requirements::customCSS(
            '.cms-menu {background: '.$this->owner->stat('cms_menu_background').';}'
        );
    }

}