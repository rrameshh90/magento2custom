<?php
 
namespace Custom\Core\Setup;
 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
 
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
 
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		 
		$eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'catalog_url', [
                'type' => 'varchar',
                'label' => 'Catalog Slider URL',
                'input' => 'text',
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Display Settings',
                'required' => false,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'catalog_year', [
                'type' => 'varchar',
                'label' => 'Catalog Slider Year',
                'input' => 'text',
                'sort_order' => 51,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Display Settings',
                'required' => false,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'catalog_name', [
                'type' => 'varchar',
                'label' => 'Catalog  Name',
                'input' => 'text',
                'sort_order' => 52,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Display Settings',
                'required' => false,
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'is_catalog', [
                'type' => 'int',
                'label' => 'Is Catalog',
                'input' => 'select',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'default' => '0',
                'sort_order' => 10,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'Display Settings',
                'required' => false,
            ]
        );
 
        $setup->endSetup();
    }
}
