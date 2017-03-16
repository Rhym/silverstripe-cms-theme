Silverstripe CMS Branding
=========================

[![Build Status](https://travis-ci.org/Rhym/silverstripe-cms-theme.svg?branch=master)](https://travis-ci.org/Rhym/silverstripe-cms-theme)

Just a nice little UI change for the cms.

The theme supports an UploadField in the *Settings > Settings Tab > CMS Tab* for a logo to be displayed in the left-hand menu of the CMS.

Installation
------------

```bash
composer require ryanpotter/silverstripe-cms-theme
```
Configuration
-------------

You can either choose to upload a CMS logo through the Site Settings section of the CMS, or you can define it through a YML configuration like the below:

```yml
SiteConfig:
  cms_logo: 'mysite/images/cms_logo.png'
```

You can set the theme colour of the left menu by defining it through a YML configuration like the below:

```yml
LeftAndMain:
  cms_menu_color: '#fff'
  cms_menu_background: '#1b354c'
```

### Example

![demo-image](https://github.com/Rhym/silverstripe-cms-theme/blob/master/screenshot.jpg?raw=true)

Grouping CMS Menus
------------------

CMS Branding will work with [Grouped CMS Menu](https://github.com/silverstripe-australia/silverstripe-grouped-cms-menu)
out of the box

### Overriding/Adding Icons

The icons in this cms theme use [Font-Awesome](http://fontawesome.io/), to override these icons simply add the class that represents the icon you wish to display in your ModelAdmin extension. e.g:

```php
private static $menu_icon_class = 'fa fa-pencil';
```

Alternatively you can set this using a YML config. e.g

```yml
CMSPagesController:
  menu_icon_class: 'fa fa-sitemap'
```
