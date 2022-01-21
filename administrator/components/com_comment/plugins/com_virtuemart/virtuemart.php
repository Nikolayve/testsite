<?php
/**
 * @package    Com_Comment
 * @author     Daniel Dimitrov <daniel@ompojoom.com>
 * @date       29.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class CcommentComponentVirtuemartPlugin
 *
 * @since  4.0
 */
class CcommentComponentVirtuemartPlugin extends ccommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_virtuemart');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$categories = $config->get('basic.categories', array());
		$include = $config->get('basic.include_categories', 0);

		if (in_array((($row->virtuemart_product_id == 0) ? -1 : $row->virtuemart_product_id), $contentIds))
		{
			return false;
		}

		/* category included or excluded ? */
		$result = in_array((($row->virtuemart_category_id == 0) ? -1 : $row->virtuemart_category_id), $categories);

		if (($include && !$result) || (!$include && $result))
		{
			return false;
		}

		return true;
	}

	/**
	 * This function decides whether to show the comments
	 * in an article/item or to show the readmore link
	 *
	 * If it returns true - the comments are shown
	 * If it returns false - the setShowReadon function will be called
	 *
	 * @return boolean
	 */
	public function isSingleView()
	{
		$input = JFactory::getApplication()->input;
		$option = $input->getCmd('option', '');
		$view = $input->getCmd('view', '');

		return ($option == 'com_virtuemart'
			&& $view == 'productdetails'
		);
	}

	/**
	 * Get the page id
	 *
	 * @return mixed
	 */
	public function getPageId()
	{
		return $this->row->virtuemart_product_id;
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_virtuemart');

		return $config->get('layout.show_readon');
	}

	/**
	 * Get a link to the VM page
	 *
	 * @param   int        $contentId  - the vm product id
	 * @param   int        $commentId  - the comment id
	 * @param   bool|true  $xhtml      - whether we should generate a xhtml link
	 *
	 * @return string
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		if ($this->row)
		{
			$category = $this->row->virtuemart_category_id;
		}
		else
		{
			$category = $this->getCategoryId($contentId);
		}

		$url = JRoute::_(
			'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $contentId .
			'&virtuemart_category_id=' . $category	. $add, $xhtml
		);

		return $url;
	}

	/**
	 * Get the category id
	 *
	 * @param   int  $id  - the product id
	 *
	 * @return mixed
	 */
	private function getCategoryId($id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('virtuemart_category_id')->from('#__virtuemart_product_categories')
			->where('virtuemart_product_id=' . $db->q($id));
		$db->setQuery($query);

		return $db->loadObject()->virtuemart_category_id;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param   int  $contentId  - the product id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__virtuemart_products')
			->where('id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();

		if ($author)
		{
			return $author->created_by;
		}

		return false;
	}

	/**
	 * Get the product titles
	 *
	 * @param   array  $ids  - the product ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		if (!class_exists('VmConfig'))
		{
			require JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php';
		}

		$config = VmConfig::loadConfig();

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('virtuemart_product_id AS id, product_name AS title')->from('#__virtuemart_products_' . $config::$vmlang)
			->where('virtuemart_product_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
