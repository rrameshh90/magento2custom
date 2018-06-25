<?php

namespace Custom\EmailForm\Controller\Adminhtml\Post;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Custom_EmailForm::custom_emailform_grid');
        $resultPage->addBreadcrumb(__('Custom'), __('Custom'));
        $resultPage->addBreadcrumb(__('EmailForm'), __('EmailForm'));
        $resultPage->getConfig()->getTitle()->prepend(__('Email Form Post Details'));
        return $resultPage;
	}


}
