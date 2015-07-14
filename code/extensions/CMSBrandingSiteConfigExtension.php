<?php

/**
 * Class CMSBrandingSiteConfigExtension
 *
 * @method Image CMSLogo
 */
class CMSBrandingSiteConfigExtension extends DataExtension {

    private static $has_one = array(
        'CMSLogo' => 'Image'
    );

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields) {
        /** =========================================
         * @var UploadField $cmsLogo
        ===========================================*/

        /** -----------------------------------------
         * Settings
        -------------------------------------------*/

        if (!$fields->fieldByName('Root.Settings')){
            $fields->addFieldToTab('Root', TabSet::create('Settings'));
        }

        /** -----------------------------------------
         * CMS
        -------------------------------------------*/

        if (Permission::check('ADMIN')) {
            $fields->findOrMakeTab('Root.Settings.CMS', 'CMS');
            $fields->addFieldsToTab('Root.Settings.CMS',
                array(
                    HeaderField::create('Images'),
                    $cmsLogo = UploadField::create('CMSLogo', 'Logo (optional)')
                )
            );
            $cmsLogo->setFolderName('Uploads/CMS');
            $cmsLogo->setRightTitle('Logo displayed in the top left-hand side of the CMS menu. Rescaled to a height of 50px.');
        }

    }

}