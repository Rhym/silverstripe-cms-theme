<?php

namespace RyanPotter\SilverstripeCMSTheme\Extensions;

use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\GroupedList;
use SilverStripe\View\ArrayData;

/**
 * Class GroupedCmsMenu
 *
 * @package RyanPotter\SilverstripeCMSTheme\Extensions
 * @property \SilverStripe\Admin\LeftAndMain $owner
 */
class GroupedCmsMenu extends DataExtension
{
  use ExtensionDefinesDefaultConfig;

  /**
   * @var array
   */
  const CONFIG_SETTINGS_WITH_DEFAULTS = [
    'menu_groups',
    'menu_groups_alphabetical_sorting',
  ];

  /**
   * @var array
   */
  private static $menu_groups = [];

  /**
   *  When you have larger menus, and/or multiple modules combining to the same menu,
   * this may require something more consistent.
   */
  private static $menu_groups_alphabetical_sorting = false;

  /**
   * @return ArrayList
   */
  public function GroupedMainMenu()
  {
    $items = $this->owner->MainMenu();
    $result = ArrayList::create();
    $config = LeftAndMain::config();
    $menus = $config->get('menu_groups');
    $itemsToGroup = [];
    $menuSort = 0;
    $itemSort = 0;

    // Add all menu items to their group arrays.
    foreach ($menus as $title => $settings) {
      $children = array_key_exists('items', $settings) ? $settings['items'] : [];
      $priority = array_key_exists('priority', $settings) ? $settings['priority'] : null;

      // If there are any menu items in the group
      if (count($items)) {
        foreach ($children as $key => $item) {
          if (is_numeric($key))
            $itemsToGroup[$item] = [
              'Group'     => $title,
              'Priority'  => $priority ? $priority : $menuSort,
              'SortOrder' => $itemSort,
            ];
          $itemSort++;
        }
        $menuSort--;
      }
    }

    /**
     * Loop through all menu items, and if they are in the items to group array
     * add them to a group otherwise add them to their own group.
     */
    foreach ($items as $item) {
      $code = Convert::raw2xml($item->Code);

      if (array_key_exists($code, $itemsToGroup)) {
        $item->Group = $itemsToGroup[$code]['Group'];
        $item->Priority = $itemsToGroup[$code]['Priority'];
        $item->SortOrder = $itemsToGroup[$code]['SortOrder'];
      } else {
        $item->Group = $code;
        $item->Priority = is_numeric($item->MenuItem->priority) ? $item->MenuItem->priority : -1;
        $item->SortOrder = 0;
      }
    }

    /**
     * Loop through all the current menu items
     */
    foreach (GroupedList::create($items->sort(['Priority' => 'DESC']))->groupBy('Group') as $group => $children) {
      if (count($children) > 1) {
        // If any of the groups children are the current page, add the active flag.
        $active = false;
        foreach ($children as $child) {
          if ($child->LinkingMode == 'current') $active = true;
        }

        // Check if the menu group has an associated icon class.
        $icon = array_key_exists('icon_class', $menus[$group]) ? $menus[$group]['icon_class'] : 'far fa-folder-open';

        // Replace any white text with underscores for use as IDs in the template.
        $code = str_replace(' ', '_', $group);

        // Push all the menu data to an array for looping in the template.
        $result->push(ArrayData::create([
          'Title'       => _t('GroupedCmsMenuLabel.' . $code, $group),
          'Code'        => DBField::create_field('Text', $code),
          'Link'        => $children->First()->Link,
          'Icon'        => $icon,
          'LinkingMode' => $active ? 'current' : '',
          'Children'    => $config->get('menu_groups_alphabetical_sorting') ? $children->sort('Title') : $children->sort('SortOrder'),
        ]));
      } else {
        // If there's only one child, return the first child as a model admin.
        $result->push($children->First());
      }
    }

    return $result;
  }
}
