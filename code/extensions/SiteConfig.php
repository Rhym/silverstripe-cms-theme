<?php

/**
 * Class CMSBrandingSiteConfigExtension
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
         * Settings
        ===========================================*/

        if (!$fields->fieldByName('Root.Settings')){
            $fields->addFieldToTab('Root', new TabSet('Settings'));
        }

        /** -----------------------------------------
         * CMS
        -------------------------------------------*/

        $fields->findOrMakeTab('Root.Settings.CMS', 'CMS');
        $fields->addFieldsToTab('Root.Settings.CMS',
            array(
                new HeaderField('Images'),
                $cmsLogo = new UploadField('CMSLogo', 'Logo (optional)')
            )
        );
        $cmsLogo->setFolderName('Uploads/CMS');
        $cmsLogo->setRightTitle('Logo displayed in the top left-hand side of the CMS menu. Rescaled to a height of 50px.');

    }

}