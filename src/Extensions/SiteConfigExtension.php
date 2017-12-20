<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileHandleField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TabSet;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

/**
 * Class SiteConfigExtension
 * @package RyanPotter\SilverStripeCMSTheme\Extensions
 */
class SiteConfigExtension extends DataExtension
{
  /**
   * @config $has_one
   * @var array
   */
  private static $has_one = [
    'CMSLogo' => Image::class,
  ];

  /**
   * @param FieldList $fields
   */
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
            ->setFolderName('Uploads/cms-branding')
            ->setRightTitle('Logo displayed in the top left-hand side of the CMS menu.'),
        ]
      );
    }
  }

  /**
   * @desc Get the CMS Logo for use in the admin template.
   * @return string
   */
  public function getCustomCMSLogo()
  {
    $imageUrl = Config::inst()->get('SilverStripe\SiteConfig\SiteConfig', 'cms_logo');

    // If there's a logo in the config, return a <img>
    if ($imageUrl) {
      $imageAbsoluteUrl = Director::absoluteBaseURL() . $imageUrl;

      return sprintf(
        '<img src="%s" alt="%s" />',
        $imageAbsoluteUrl,
        'CMS Logo'
      );
    }

    return Image::get()->byID($this->owner->CMSLogoID);
  }

  /**
   * @desc Publish our dependent objects
   */
  public function onAfterWrite()
  {
    $hasOnes = $this->owner->stat('has_one');
    foreach ($hasOnes as $relation => $class) {
      if ($class == Image::class || $class == File::class) {
        $this->publishRelatedObject($this->owner->$relation());
      }
    }

    parent::onAfterWrite();
  }

  /**
   * @param $object
   */
  protected function publishRelatedObject($object)
  {
    if ($object && $object->owner->exists()) {
      $object->owner->publishSingle();
    }
  }
}
