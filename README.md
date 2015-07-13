# Silverstripe CMS Theme

Just a nice little UI change for the cms.

The theme supports an UploadField in the *Settings > Settings Tab > CMS Tab* for a logo to be displayed in the left-hand menu of the CMS.

### Changing the theme colour

In your _config.yml

```
LeftAndMain:
  extensions:
    - CMSBrandingLeftAndMainExtension
  cms_menu_background: '#8996a1'
```

### Example

![demo-image](https://cloud.githubusercontent.com/assets/1136811/7264694/a272d25c-e8e2-11e4-8981-4216ad31f09e.png)
