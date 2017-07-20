<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileHandleField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TabSet;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

class SiteConfigExtension extends DataExtension
{
  private static $cms_logo = false;

  private static $has_one = [
    'CMSLogo' => 'SilverStripe\\Assets\\Image',
  ];

  public function updateCMSFields(FieldList $fields)
  {
    if (Permission::check('ADMIN') && !Config::inst()->get('SiteConfig', 'cms_logo')) {
      if (!$fields->fieldByName('Root.Settings')) {
        $fields->addFieldToTab('Root', TabSet::create('CMSBrandingTab', 'CMS Branding'));
      }

      $fields->findOrMakeTab('Root.CMSBrandingTab.CMS', 'CMS');
      $fields->addFieldsToTab('Root.CMSBrandingTab.CMS',
        [
          HeaderField::create('', 'Images'),
          Injector::inst()->create(FileHandleField::class, 'CMSLogo', 'Logo')
            ->setAllowedFileCategories('image/supported')
//            ->setFolderName('Uploads/cms')
            ->setRightTitle('Logo displayed in the top left-hand side of the CMS menu.'),
        ]
      );
    }
  }

  /**
   * Get the CMS Logo for use in the admin template.
   * @return \SilverStripe\ORM\DataObject
   */
  public function getCustomCMSLogo()
  {
    return Config::inst()->get('SiteConfig', 'cms_logo') ?: Image::get()->byID($this->owner->CMSLogoID);
  }
}
