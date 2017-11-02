<?php


namespace RyanPotter\SilverstripeCMSTheme\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\GroupedList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class GroupedCmsMenu extends DataExtension
{
  private static $menu_groups = [];

  /**
   *  When you have larger menus, and/or multiple modules combining to the same menu,
   * this may require something more consistent.
   */
  private static $menu_groups_alphabetical_sorting = false;

  /**
   * Require in CSS which we need for the menu
   */
  public function init()
  {
//    Requirements::css('grouped-cms-menu/css/GroupedCmsMenu.css');
  }

  private function dd($echo)
  {
    echo '<pre>';
    echo print_r($echo);
    echo '</pre>';
    exit();
  }

  /**
   * @return ArrayList
   */
  public function GroupedMainMenu()
  {
    $items = $this->owner->MainMenu();
    $result = ArrayList::create();
    $config = Config::inst();
    $groupSettings = $config->get('SilverStripe\Admin\LeftAndMain', 'menu_groups');
    $itemsToGroup = [];
    $groupSort = 0;
    $itemSort = 0;

    /**
     * Add all menu items to their group arrays.
     */
    foreach ($groupSettings as $groupName => $menuItems) {
      // If there are any menu items in the group
      if (count($menuItems)) {
        foreach ($menuItems as $key => $menuItem) {
          if (is_numeric($key))
            $itemsToGroup[$menuItem] = [
              'Group'     => $groupName,
              'Priority'  => (array_key_exists('priority', $groupSettings[$groupName])) ? $groupSettings[$groupName]['priority'] : $groupSort,
              'SortOrder' => $itemSort,
            ];
          $itemSort++;
        }
        $groupSort--;
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

    foreach (GroupedList::create($items->sort(['Priority' => 'DESC']))->groupBy('Group') as $group => $children) {
      if (count($children) > 1) {
        $active = false;
        foreach ($children as $child) {
          if ($child->LinkingMode == 'current') $active = true;
        }
        $icon = array_key_exists('icon', $groupSettings[$group]) ? $groupSettings[$group]['icon'] : false;
        $code = str_replace(' ', '_', $group);
        $result->push(ArrayData::create([
          'Title'       => _t('GroupedCmsMenuLabel.' . $code, $group),
          'Code'        => DBField::create_field('Text', $code),
          'Link'        => $children->First()->Link,
          'Icon'        => $icon,
          'LinkingMode' => $active ? 'current' : '',
          'Children'    => $config->get('LeftAndMain', 'menu_groups_alphabetical_sorting') ? $children->sort('Title') : $children->sort('SortOrder'),
        ]));
      } else {
        $result->push($children->First());
      }
    }
    return $result;
  }
}
