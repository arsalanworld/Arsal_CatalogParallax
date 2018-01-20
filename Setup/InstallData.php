<?php

namespace Arsal\CatalogParallax\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // TODO: Implement install() method.
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Category::ENTITY,
            'ritzy_parallax_image',
            [
                'type'      => 'varchar',
                'label'     => 'Ritzy Parallax Image',
                'input'     => 'text',
                'required'  => false,
                'backend'   => 'Arsal\CatalogParallax\Model\Category\Attribute\Backend\ArsalParallaxImage',
                'global'    => ScopedAttributeInterface::SCOPE_STORE,
                'group'     => 'Content',
                'note'      => 'Selected image will appear as parallax on top of the current category'
            ]
        );
        $eavSetup->addAttribute(
            Category::ENTITY,
            'ritzy_parallax_position',
            [
                'type'      => 'varchar',
                'label'     => 'Ritzy Parallax Image Position',
                'input'     => 'text',
                'required'  => false,
                'global'    => ScopedAttributeInterface::SCOPE_STORE,
                'group'     => 'Content',
                'note'      => 'Provide position of parallax image e.g right -10px. If empty Default Value is "center center"'
            ]
        );
        $eavSetup->addAttribute(
            Category::ENTITY,
            'ritzy_parallax_heading_color',
            [
                'type'      => 'varchar',
                'label'     => 'Choose Heading Parallax Color',
                'input'     => 'text',
                'required'  => false,
                'global'    => ScopedAttributeInterface::SCOPE_STORE,
                'group'     => 'Content',
                'note'      => 'Pick Suitable Color for catalog heading over parallax. Default is "#ffffff(white)"'
            ]
        );
    }
}