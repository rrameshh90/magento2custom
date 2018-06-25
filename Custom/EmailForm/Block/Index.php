<?php
/**
 * @category   Custom
 * @package    Custom_EmailForm
 * @copyright  Copyright (c) 2017 NU Technology Inc.
 */

namespace Custom\EmailForm\Block;

/**
 * Class Index
 * @package Custom\EmailForm\Block\Index
 */
class Index extends \Magento\Framework\View\Element\Template
{
	/**
	 * @var \Magento\Customer\Model\Session
	 */
	private $customerSession;

	/**
	 * @var \Custom\EmailForm\Model\EmailForm
	 */
	protected $emailformModel;

	/**
	 * @var \Custom\EmailForm\Model\ResourceModel\EmailForm
	 */
	protected $emailformResourceModel;
	/**
	 * @var \Magento\Framework\App\Request\Http
	 */
	protected $_requestParam;

	/**
	 * @var DateTime
	 */
	protected $date;

	/**
	 * Index constructor.
	 * @param \Magento\Catalog\Block\Product\Context $context
	 * @param \Magento\Customer\Model\Session $customerSession
	 * @param \Magento\Framework\App\Request\Http $request
	 * @param array $data
	 */
	public function __construct(
		\Magento\Catalog\Block\Product\Context $context,
		\Magento\Customer\Model\Session $customerSession,
		\Custom\EmailForm\Model\EmailForm $emailformModel,
		\Custom\EmailForm\Model\ResourceModel\EmailForm $emailformResourceModel,
		\Magento\Framework\App\Request\Http $request,
		array $data = []
	)
	{

		$this->customerSession = $customerSession;
		$this->emailformModel = $emailformModel;
		$this->emailformResourceModel = $emailformResourceModel;
		$this->_requestParam = $request;
		parent::__construct($context, $data);
	}

	/**
	 * @return \Magento\Customer\Model\Customer
	 */
	public function getCustomer()
	{
		return $customer = $this->customerSession->getCustomer();
	}


	/**
	 * @return string
	 */
	public function getModuleBaseUrl()
	{
		return parent::getBaseUrl().'emailform/';
	}

	/**
	 * @return string
	 */
	public function getFormAction()
	{
		return parent::getBaseUrl().'emailform/index/save';
	}
	
	
}
