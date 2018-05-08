# Silverstripe CMS Branding

[![Build Status](https://travis-ci.org/Rhym/silverstripe-cms-theme.svg?branch=master)](https://travis-ci.org/Rhym/silverstripe-cms-theme)
[![Latest Stable Version](https://poser.pugx.org/ryanpotter/silverstripe-cms-theme/v/stable)](https://packagist.org/packages/ryanpotter/silverstripe-cms-theme)
[![Total Downloads](https://poser.pugx.org/ryanpotter/silverstripe-cms-theme/downloads)](https://packagist.org/packages/ryanpotter/silverstripe-cms-theme)
[![Monthly Downloads](https://poser.pugx.org/ryanpotter/silverstripe-cms-theme/d/monthly)](https://packagist.org/packages/ryanpotter/silverstripe-cms-theme)

Just a nice little UI change for the cms sidebar.

The theme supports an UploadField in the *Settings > Settings Tab > CMS Tab* for a logo to be displayed in the left-hand menu of the CMS.


Screenshot
----------

![Screenshot](https://github.com/Rhym/silverstripe-cms-theme/blob/master/screenshot.png)

## Thanks

Thanks to [https://github.com/symbiote/silverstripe-grouped-cms-menu](https://github.com/symbiote/silverstripe-grouped-cms-menu) for some of their code for grouped menu items.

## Installation

```bash
composer require ryanpotter/silverstripe-cms-theme
```
## Configuration

You can either choose to upload a CMS logo through the Site Settings section of the CMS, or you can define it through a YML configuration like the below:

```yml
SilverStripe\SiteConfig\SiteConfig:
  cms_logo: 'path/to/your/image.png'
  cms_logo_width: 100 # Optional width constraint
```

You can set the theme colour of the left menu by defining it through a YML configuration like the below:

```yml
SilverStripe\Admin\LeftAndMain:
  cms_background: '#0747A6'
  cms_border_color: '#173778'
  cms_color: '#fff'
  cms_hover_background: '#093684'
  cms_active_background: '#173778'
  cms_active_color: '#fff'
  cms_drawer_background: '#0e418e'
```

## Grouping CMS Menus

You can add menu items to a list by using adding the menu code to the `menu_groups` config e.g:

```yml
SilverStripe\Admin\LeftAndMain:
  menu_groups:
    Misc:
      - SilverStripe-CampaignAdmin-CampaignAdmin
      - Help
      - SilverStripe-Reports-ReportAdmin
```

### Overriding/Adding Icons

The icons in this cms theme use [Font Awesome](https://fontawesome.com), to override these icons simply add the class that represents the icon you wish to display in your ModelAdmin extension. e.g:

```php
private static $menu_icon_class = 'fas fa-pencil-alt';
```

Alternatively you can set this using a YML config. e.g

```yml
SilverStripe\CMS\Controllers\CMSPagesController:
  menu_icon_class: 'fas fa-sitemap'
```
