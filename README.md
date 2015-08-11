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

![demo-image](https://cloud.githubusercontent.com/assets/1136811/9187063/631bfa4e-4020-11e5-954b-8e787d229b1e.jpg)

## Grouping CMS Menus

CMS Branding will work with [Grouped CMS Menu](https://github.com/silverstripe-australia/silverstripe-grouped-cms-menu)
out of the box

### Example
![demo-image-grouped](https://cloud.githubusercontent.com/assets/1136811/9187064/631d9a98-4020-11e5-9ca6-31b10c12fc2d.jpg)
