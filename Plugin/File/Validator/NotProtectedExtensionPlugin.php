<?php
/**
 * Navigate Commerce
 *
 * @author       Navigate Commerce
 * @package      Navigate_AllowSvgWebpAvifImage
 * @copyright    Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license      https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\AllowSvgWebpAvifImage\Plugin\File\Validator;

use Magento\MediaStorage\Model\File\Validator\NotProtectedExtension;
use Navigate\AllowSvgWebpAvifImage\Helper\ImageHelper;

class NotProtectedExtensionPlugin
{
    /**
     * @var ImageHelper
     */
    private $imageHelper;

    /**
     * NotProtectedExtensionPlugin constructor.
     * @param ImageHelper $imageHelper
     */
    public function __construct(
        ImageHelper $imageHelper
    ) {
        $this->imageHelper = $imageHelper;
    }

    /**
     * Remove vector images from protected extensions list
     *
     * @param NotProtectedExtension $subject
     * @param string $result
     * @return string|string[]
     */
    public function afterGetProtectedFileExtensions(NotProtectedExtension $subject, $result)
    {
        $vectorExtensions = $this->imageHelper->getVectorExtensions();

        if (is_string($result)) {
            $result = explode(',', $result);
        }

        foreach (array_keys($result) as $extension) {
            if (in_array($extension, $vectorExtensions)) {
                unset($result[$extension]);
            }
        }

        return $result;
    }
}
