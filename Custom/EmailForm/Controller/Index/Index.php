<?php
/**
 * @category   Custom
 * @package    Custom_EmailForm
 * @copyright  Copyright (c) 2017 NU Technology Inc.
 */

namespace Custom\EmailForm\Controller\Index;

/**
 * Class Index
 * @package Custom\EmailForm\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
	/**
	 * @var \Magento\Framework\View\Result\PageFactory
	 */
	protected $resultPageFactory;

	/**
	 * @var \Magento\Customer\Model\Session
	 */
	private $customerSession;

	/**
	 * Index constructor.
	 * @param \Magento\Framework\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Magento\Customer\Model\Session $customerSession
	 */
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Customer\Model\Session $customerSession
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->customerSession = $customerSession;
		$this->messageManager = $context->getMessageManager();
		parent::__construct($context);
	}

	/**
	 * @return \Magento\Framework\View\Result\Page|void
	 */
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->set(__('Custom EmailForm'));
		return $resultPage;
	}
}
