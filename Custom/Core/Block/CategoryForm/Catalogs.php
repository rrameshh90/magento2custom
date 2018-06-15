<?php
namespace Custom\Core\Block\CategoryForm;
use Magento\Framework\View\Element\Template;

class Catalogs extends Template
{
	/**
     * @var \Magento\Catalog\Helper\Category
     */
    protected $_categoryHelper;
    
     /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollection;
	
	 /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig; 
    
     /**
     * Catalogs constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Helper\Category $categoryHelper
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollection ,
        \Magento\Framework\Registry $registry
    )
	{  
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryCollection = $categoryCollection;
        $this->_registry = $registry;
        $this->_scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }
    public function getCatalogs()
    {
		$limit = $this->_scopeConfig->getValue('promotions/custom_catalogs/catalogs_limit');
        if(!$limit){
            $limit =5;
        }
		 $home = $this->_categoryCollection->create()
            ->addAttributeToFilter('name', array('eq' => 'Catalogs'))
            ->addAttributeToFilter('is_active',1)
            ->getFirstItem();

        $collection = $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active',1)
            ->addAttributeToFilter('is_catalog',1)
            ->addIdFilter($home->getChildren())
            ->setOrder('position',\Magento\Framework\DB\Select::SQL_ASC)
            ->setPageSize($limit)
            ->load();
        
        return $collection;

    }
    public function isEnabled(){
		
		return  $this->_scopeConfig->getValue('promotions/custom_catalogs/enable');
	}
}
