<?php
/**
 * Navigate Commerce
 *
 * @author       Navigate Commerce
 * @package      Navigate_AllowSvgWebpAvifImage
 * @copyright    Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license      https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\AllowSvgWebpAvifImage\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Filesystem\Driver\File as DriverFile;

class ImageHelper extends AbstractHelper
{
    public const IS_ENABLE                      = 'navigate_allowsvgwebpavifimage/general/enabled';
    public const XML_PATH_VECTOR_EXTENSIONS     = 'navigate_allowsvgwebpavifimage/extensions/vector';
    public const XML_PATH_WEB_IMAGE_EXTENSIONS  = 'navigate_allowsvgwebpavifimage/extensions/web_image';
    public const XML_PATH_AVIF_IMAGE_EXTENSIONS = 'navigate_allowsvgwebpavifimage/extensions/avif_image';

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var DriverFile
     */
    protected $fileDriver;

    /**
     * ImageHelper constructor.
     *
     * @param Context $context
     * @param DriverFile $fileDriver
     */
    public function __construct(Context $context, DriverFile $fileDriver)
    {
        $this->fileDriver = $fileDriver;
        parent::__construct($context);
    }

    /**
     * Check Module is enabled or not
     *
     * @return boolean
     */
    public function isEnableModule()
    {
        return (bool) $this->scopeConfig->getValue(self::IS_ENABLE, 'store');
    }

    /**
     * Check if the file is a vector image
     *
     * @param string $file
     * @return bool
     */
    public function isVectorImage($file)
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION)); //phpcs:ignore
        if (empty($extension) && $this->fileDriver->isExists($file)) {
            $mimeType = mime_content_type($file);
            $extension = str_replace('image/', '', $mimeType);
        }

        return in_array($extension, $this->getVectorExtensions());
    }

    /**
     * Get vector image extensions
     *
     * @return array
     */
    public function getVectorExtensions()
    {
        if ($this->isEnableModule()) {
            return $this->scopeConfig->getValue(self::XML_PATH_VECTOR_EXTENSIONS, 'store') ?: [];
        }
        return [];
    }

    /**
     * Get web image extensions
     *
     * @return array
     */
    public function getWebImageExtensions()
    {
        if ($this->isEnableModule()) {
            return $this->scopeConfig->getValue(self::XML_PATH_WEB_IMAGE_EXTENSIONS, 'store') ?: [];
        }
        return [];
    }
}
