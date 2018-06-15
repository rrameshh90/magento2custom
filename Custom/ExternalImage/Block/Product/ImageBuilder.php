<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\ExternalImage\Block\Product;

class ImageBuilder extends \Magento\Catalog\Block\Product\ImageBuilder
{
	
	/*protected $_assetRepo;

	public function __construct(
    \Magento\Framework\View\Asset\Repository $assetRepo
	) {
    $this->_assetRepo = $assetRepo;
}*/
        
    /**
     * Create image block
     *
     * @return \Magento\Catalog\Block\Product\Image
     */
    public function create()
    {
        /** @var \Magento\Catalog\Helper\Image $helper */
        $helper = $this->helperFactory->create()
            ->init($this->product, $this->imageId);

        $template = $helper->getFrame()
            ? 'Magento_Catalog::product/image.phtml'
            : 'Magento_Catalog::product/image_with_borders.phtml';

        try {
            $imagesize = $helper->getResizedImageInfo();
        } catch (NotLoadInfoImageException $exception) {
            $imagesize = [$helper->getWidth(), $helper->getHeight()];
        }
        $skuid=$this->product->getSku();
		$url=$helper->getUrl();
		$link = $_SERVER['PHP_SELF'];
		$link_array = explode('/media/',$url);
		$imageendUrl = end($link_array);		
		if($imageendUrl=='import/'){
			$imageSrc='';
			$imageUrl=$url.''.$skuid.'.jpg';
			if(!@getimagesize($imageUrl)){
				$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
				$product = $objectManager->create('Magento\Framework\View\Asset\Repository');
				$imageSrc=$product->getUrl("Magento_Catalog::images/product/placeholder/thumbnail.jpg");
			}else{
				$imageSrc=$imageUrl;
			}
			$data = [
            'data' => [
                'template' => $template,
                'image_url' => $imageSrc,
                'width' => $helper->getWidth(),
                'height' => $helper->getHeight(),
                'label' => $helper->getLabel(),
                'ratio' =>  $this->getRatio($helper),
                'custom_attributes' => $this->getCustomAttributes(),
                'resized_image_width' => $imagesize[0],
                'resized_image_height' => $imagesize[1],
            ],
        ];
		}else{
		       $data = [
            'data' => [
                'template' => $template,
                'image_url' => $helper->getUrl(),
                'width' => $helper->getWidth(),
                'height' => $helper->getHeight(),
                'label' => $helper->getLabel(),
                'ratio' =>  $this->getRatio($helper),
                'custom_attributes' => $this->getCustomAttributes(),
                'resized_image_width' => $imagesize[0],
                'resized_image_height' => $imagesize[1],
            ],
        ];
	}
        return $this->imageFactory->create($data);
    }
}
