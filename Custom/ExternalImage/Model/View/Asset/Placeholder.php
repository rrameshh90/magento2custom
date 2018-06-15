<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\ExternalImage\Model\View\Asset;

use Magento\Framework\View\Asset\ContextInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Asset\Repository;
/**
 * A locally available image placeholder file asset that can be referred with a file type
 */
class Placeholder extends \Magento\Catalog\Model\View\Asset\Placeholder
{
    /**
     * Type of placeholder
     *
     * @var string
     */
    private $type;

    /**
     * Filevpath of placeholder
     *
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private $contentType = 'image';

    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @var Repository
     */
    private $assetRepo;

    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Placeholder constructor.
     *
     * @param ContextInterface $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Repository $assetRepo
     * @param string $type
     */
    public function __construct(
        ContextInterface $context,
        ScopeConfigInterface $scopeConfig,
        Repository $assetRepo,
        $type
    ) {
        $this->context = $context;
        $this->scopeConfig = $scopeConfig;
        $this->assetRepo = $assetRepo;
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
		$externalpath = $this->scopeConfig->getValue('catalog/custom_externalImage/external_path',\Magento\Store\Model\ScopeInterface::SCOPE_STORE); 
        if ($this->getFilePath() !== null) {
            $result = $this->context->getBaseUrl() . '/' . $this->getModule() . '/' . $this->getFilePath();
        }elseif(!empty($externalpath)){
            $result = $externalpath;
            //$result = 'C:/xampp/htdocs/media/import/';
        }else{
			$result = $this->assetRepo->getUrl("Magento_Catalog::images/product/placeholder/{$this->type}.jpg");
		}
        return $result;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        if ($this->getFilePath() !== null) {
            $result = $this->getContext()->getPath()
                . DIRECTORY_SEPARATOR . $this->getModule()
                . DIRECTORY_SEPARATOR . $this->getFilePath();
        } else {
            $defaultPlaceholder = $this->assetRepo->createAsset(
                "Magento_Catalog::images/product/placeholder/{$this->type}.jpg"
            );
            try {
                $result = $defaultPlaceholder->getSourceFile();
            } catch (NotFoundException $e) {
                $result = null;
            }
        }

        return $result;
    }
     /**
     * {@inheritdoc}
     */
    public function getFilePath()
    {
        if ($this->filePath !== null) {
            return $this->filePath;
        }
        // check if placeholder defined in config
        $isConfigPlaceholder = $this->scopeConfig->getValue(
            "catalog/placeholder/{$this->type}_placeholder",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $this->filePath = $isConfigPlaceholder;

        return $this->filePath;
    }

}
