# Silverstripe CMS Branding

Just a nice little UI change for the cms.

The theme supports an UploadField in the *Settings > Settings Tab > CMS Tab* for a logo to be displayed in the left-hand menu of the CMS.

## Configuration

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
  cms_menu_active_text_color: '#fff'
  cms_menu_active_background_color: '#0d1a25'
```

### Example

![demo-image](https://cloud.githubusercontent.com/assets/1136811/9187098/c6951f74-4020-11e5-9367-9f7a9cb00ec2.jpg)

## Grouping CMS Menus

CMS Branding will work with [Grouped CMS Menu](https://github.com/silverstripe-australia/silverstripe-grouped-cms-menu)
out of the box

### Example
![demo-image-grouped](https://cloud.githubusercontent.com/assets/1136811/9187572/5b2ab504-4026-11e5-9d78-bb2f9fb04f74.jpg)

### Overriding/Adding Icons

The icons in this cms theme use [Font-Awesome](http://fortawesome.github.io/Font-Awesome/), to override these icons simply extend the LeftAndMain class, and specify with CSS what icon to use. e.g:

```php
Requirements::customCSS('#Menu-CMSSettingsController .icon::before {content: "\f25b"}');
```

The Font-Awesome font uses unicodes to determine what icon to display. To figure out what the unicode of the icon you want is, click on the corresponding icon on the [Font-Awesome](http://fortawesome.github.io/Font-Awesome/) website and it will display the unicode on the page. e.g:

![unicode](https://cloud.githubusercontent.com/assets/1136811/9187509/aab709de-4025-11e5-987e-aff1f6e67de2.jpg)
