<?php
/**
 * @category   Custom
 * @package    Custom_EmailForm
 * @copyright  Copyright (c) 2017 NU Technology Inc.
 */

namespace Custom\EmailForm\Controller\Index;

use Custom\EmailForm\Model\EmailFormFactory;
use Magento\Framework\Controller\ResultFactory; 
/**
 * Class Save
 * @package Priceshoes\Career\Controller\Index
 */
class Save extends \Magento\Framework\App\Action\Action
{
		/**
	* @var \Magento\Framework\Mail\Template\TransportBuilder
	*/
	protected $_transportBuilder;

	const XML_PATH_EMAIL_RECIPIENT = 'custom_emailform/user/email';

	/**
	* @var \Magento\Framework\Translate\Inline\StateInterface
	*/
	protected $inlineTranslation;

	protected $_emailFormFactory;

	/**
	* @var \Magento\Framework\App\Config\ScopeConfigInterface
	*/
	protected $scopeConfig;

	/**
	* @var \Magento\Store\Model\StoreManagerInterface
	*/
	protected $storeManager;
	/**
	* @var \Magento\Framework\Escaper
	*/
	protected $_escaper;
	/**
	* @param \Magento\Framework\App\Action\Context $context
	* @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
	* @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
	* @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
	* @param \Magento\Store\Model\StoreManagerInterface $storeManager
	*/
	public function __construct(
	\Magento\Framework\App\Action\Context $context,
	\Custom\EmailForm\Model\Mail\TransportBuilder $transportBuilder,
	\Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
	\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
	\Magento\Store\Model\StoreManagerInterface $storeManager,
	\Magento\Framework\Escaper $escaper,
	EmailFormFactory $emailFormFactory
		) {
		parent::__construct($context);
		$this->_transportBuilder = $transportBuilder;
		$this->inlineTranslation = $inlineTranslation;
		$this->scopeConfig = $scopeConfig;
		$this->storeManager = $storeManager;
		$this->_escaper = $escaper;
		$this->_emailFormFactory = $emailFormFactory;
		}

/**
* Post user question
*
* @return void
* @throws \Exception
*/
	public function execute()
	{
	$post = $this->getRequest()->getPostValue();
		if (!$post) {
			$this->_redirect('*/*/');
		return;
		}
	$templateUserId = $this->scopeConfig->getValue('custom_emailform/user/template');
	$identity_name = $this->scopeConfig->getValue('custom_emailform/user/username');
	$identity_email = $this->scopeConfig->getValue('custom_emailform/user/email');
	if(empty($identity_name)){
		$identity_name = $identity_email;	
	 }

	$storeid = 1;
	$this->inlineTranslation->suspend();
	try {
		$postObject = new \Magento\Framework\DataObject();
		$postObject->setData($post);
		$username = $post['name'];
		$email = $post['email'];
		$emailformmodal = $this->_emailFormFactory->create();
		$emailformmodal->setName($post['name']);
		$emailformmodal->setEmail($post['email']);
		$emailformmodal->setTelephone($post['telephone']);
		$emailformmodal->setComment($post['comment']);
		$error = false;
		
		$sender = [
		'name' => $this->_escaper->escapeHtml($post['name']),
		'email' => $this->_escaper->escapeHtml($post['email'])
		];
		/*$receiver = [
				'name' => $this->_escaper->escapeHtml($identity_name),
				'email' => $this->_escaper->escapeHtml($identity_email),
			];*/
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		$transport = $this->_transportBuilder
		->setTemplateIdentifier($templateUserId) // this code we have mentioned in the email_templates.xml
		->setTemplateOptions(
		[
		'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
		'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
		]
		)
		//->setTemplateVars(['data' => $postObject])
		->setTemplateVars(['emailform_name' =>$username,'emailform_email' => $email])
		->setFrom($sender)
		//->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope)) OR used Driect Input value.
		->addTo($identity_email)
		->getTransport();

		$transport->sendMessage();
		$emailformmodal->save();
		$this->inlineTranslation->resume();
		$this->messageManager->addSuccess(
		__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
		);
		$this->_redirect('*/*/');
		return;
} catch (\Exception $e) {
		$this->inlineTranslation->resume();
		$this->messageManager->addError(
		__('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage())
		);
		$this->_redirect('*/*/');
		return;
}
}
}
