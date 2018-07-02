<?php

namespace RyanPotter\SilverStripeCMSTheme\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FileHandleField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TabSet;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class SiteConfigExtension
 * @package RyanPotter\SilverStripeCMSTheme\Extensions
 * @property \SilverStripe\SiteConfig\SiteConfig $owner
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
    if (Permission::check('ADMIN') && !SiteConfig::config()->get('cms_logo')) {
      if (!$fields->fieldByName('Root.Settings')) {
        $fields->addFieldToTab(
          'Root',
          TabSet::create(
            'CMSBrandingTab',
            _t(__CLASS__ . '.CMSBRANDINGTAB', 'CMS Branding')
          )
        );
      }

      $fields->findOrMakeTab('Root.CMSBrandingTab.CMS', 'CMS');
      $fields->addFieldsToTab('Root.CMSBrandingTab.CMS',
        [
          HeaderField::create('', _t(__CLASS__ . '.IMAGES', 'Images')),
          Injector::inst()->create(
            FileHandleField::class,
            'CMSLogo',
            _t(__CLASS__ . '.LOGOLABEL', 'Logo')
          )
          ->setAllowedFileCategories('image/supported')
          ->setFolderName('Uploads/cms-branding')
          ->setRightTitle(_t(__CLASS__ . '.LOGODESCRIPTIOM', 'Logo displayed in the top left-hand side of the CMS menu.')),
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
    $owner = $this->owner;
    $config = SiteConfig::config();
    $imageUrl = $config->get('cms_logo');
    $imageWidth = $config->get('cms_logo_width');
    $imageWidthMax = 187;

    /**
     * If there's no config for a max width, or it's larger
     * than supported set the maximum width.
     */
    if (!(int)$imageWidth || (int)$imageWidth >= $imageWidthMax) {
      $imageWidth = $imageWidthMax;
    }

    // If there's a logo in the config, return a <img>
    if ($imageUrl) {
      $imageAbsoluteUrl = Director::absoluteBaseURL() . $imageUrl;

      return sprintf(
        '<img src="%s" alt="%s" style="max-width: ' . $imageWidth . 'px !important;" />',
        $imageAbsoluteUrl,
        'CMS Logo'
      );
    }

    if ($owner->CMSLogoID && $owner->CMSLogo()->exists()) {
      return $owner->CMSLogo()->ScaleMaxWidth($imageWidth);
    }
  }

  /**
   * @desc Publish our dependent objects
   */
  public function onAfterWrite()
  {
    $this->publishRelatedObject($this->owner->CMSLogo());
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
