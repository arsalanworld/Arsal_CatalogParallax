<?php
namespace Arsal\CatalogParallax\Helper;

/**
 * Class Data
 * @package Arsal\CatalogParallax\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @string PARALLAX_POSITION_DEFAULT
     * @details Parallax position default value
     */
    const PARALLAX_POSITION_DEFAULT = 'center center';

    /**
     * @string PARALLAX_HEADING_DEFAULT_COLOR
     * @details Parallax Heading Default Color
     */
    const PARALLAX_HEADING_DEFAULT_COLOR = '#ffffff';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface
    )
    {
        $this->_storeManager = $storeManagerInterface;
        $this->_scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }

    /**
     * @param \Magento\Catalog\Model\Category $category
     * @return bool|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getParallaxImageUrl($category)
    {
        $url   = false;
        $image = $category->getRitzyParallaxImage();
        if ($image)
        {
            if (is_string($image))
            {
                $url = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    ) . 'catalog/category/' . $image;
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }

        return $url;
    }

    /**
     * @param \Magento\Catalog\Model\Category $category
     * @return string
     */
    public function getParallaxImagePosition($category)
    {
        $position = self::PARALLAX_POSITION_DEFAULT;
        $pos = $category->getRitzyParallaxPosition();
        if($pos && !empty($pos) && is_string($pos))
        {
            $position = $pos;
        }
        return $position;
    }

    /**
     * @param \Magento\Catalog\Model\Category $category
     * @return string
     */
    public function getParallaxHeadingColor($category)
    {
        return $category->getRitzyParallaxHeadingColor();
    }
}