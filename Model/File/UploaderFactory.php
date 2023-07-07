<?php
/**
 * Navigate Commerce
 *
 * @author       Navigate Commerce
 * @package      Navigate_AllowSvgWebpAvifImage
 * @copyright    Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license      https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\AllowSvgWebpAvifImage\Model\File;

use Magento\Framework\File\UploaderFactory as ImageUploaderFactory;
use Magento\Framework\ObjectManagerInterface;

class UploaderFactory extends ImageUploaderFactory
{
    /**
     *
     * @var ObjectManagerInterface
     */
    private $_objectManager;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        parent::__construct($objectManager);

        $this->_objectManager = $objectManager;
    }

    /**
     * Create new uploader instance
     *
     * @param array $data
     * @return Uploader
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create(Uploader::class, $data);
    }
}
