<?php

/**
 * Class CMSBrandingSiteConfigExtension
 *
 * @method Image CMSLogo
 */
class CMSBrandingSiteConfigExtension extends DataExtension
{

    /**
     * @var bool
     */
    private static $cms_logo = false;

    /**
     * @var array
     */
    private static $has_one = array(
        'CMSLogo' => 'Image'
    );

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        /** =========================================
         * @var UploadField $cmsLogo
        ===========================================*/

        /** -----------------------------------------
         * CMS
         * ----------------------------------------*/

        if (Permission::check('ADMIN') && !Config::inst()->get('SiteConfig', 'cms_logo')) {
            if (!$fields->fieldByName('Root.Settings')) {
                $fields->addFieldToTab('Root', TabSet::create('Settings'));
            }

            $fields->findOrMakeTab('Root.Settings.CMS', 'CMS');
            $fields->addFieldsToTab('Root.Settings.CMS',
                array(
                    HeaderField::create('Images'),
                    $cmsLogo = UploadField::create('CMSLogo', 'Logo (optional)')
                )
            );
            $cmsLogo->setFolderName('Uploads/CMS');
            $cmsLogo->setRightTitle('Logo displayed in the top left-hand side of the CMS menu.');
        }
    }

    /**
     * @return string|DataObject
     */
    public function getCustomCMSLogo()
    {
        return Config::inst()->get('SiteConfig', 'cms_logo') ?: Image::get()->byID($this->owner->CMSLogoID);
    }
}
