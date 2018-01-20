<?php

namespace Arsal\CatalogParallax\Model\Category;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
    /**
     * @param \Magento\Catalog\Model\Category $category
     * @param array $categoryData
     * @return array
     */
    protected function addUseDefaultSettings($category, $categoryData)
    {
        $data = parent::addUseDefaultSettings($category, $categoryData);

        if (isset($data['ritzy_parallax_image'])) {
            unset($data['ritzy_parallax_image']);

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $helper           	= $objectManager->get('\Arsal\CatalogParallax\Helper\Data');

            $data['ritzy_parallax_image'][0]['name'] = $category->getData('ritzy_parallax_image');
            $data['ritzy_parallax_image'][0]['url']  	= $helper->getParallaxImageUrl($category);
        }

        return $data;
    }

    protected function getFieldsMap()
    {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'ritzy_parallax_image';

        return $fields;
    }
}