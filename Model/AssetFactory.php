<?php
/**
 * Navigate Commerce
 *
 * @author       Navigate Commerce
 * @package      Navigate_AllowSvgWebpAvifImage
 * @copyright    Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license      https://www.navigatecommerce.com/end-user-license-agreement
 */

namespace Navigate\AllowSvgWebpAvifImage\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\ReadInterface;
use Magento\MediaGalleryApi\Api\Data\AssetInterfaceFactory;
use Navigate\AllowSvgWebpAvifImage\Helper\ImageHelper;

class AssetFactory extends AssetInterfaceFactory
{
    /**
     * @var AssetInterfaceFactory
     */
    private $assetFactory;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var ImageHelper
     */
    private $imageHelper;

    /**
     * AssetFactory constructor.
     * @param AssetInterfaceFactory $assetFactory
     * @param Filesystem $filesystem
     * @param ImageHelper $imageHelper
     */
    public function __construct(
        AssetInterfaceFactory $assetFactory,
        Filesystem $filesystem,
        ImageHelper $imageHelper
    ) {
        $this->assetFactory = $assetFactory;
        $this->filesystem = $filesystem;
        $this->imageHelper = $imageHelper;
    }

    /**
     * Set height and width for SVG images when saving to DB
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data = [])
    {
        if ((empty($data['width']) || empty($data['height']))
            && isset($data['path'])
            && $this->imageHelper->isVectorImage($data['path'])
        ) {
            $absolutePath = $this->getMediaDirectory()->getAbsolutePath($data['path']);
            $width = 300;
            $height = 150;

            $avifFlag = false;
            if (isset($data['path'])) {
                $uploadImagePath = explode("/", $data['path']);
                $uploadImageName = end($uploadImagePath);
                if (strtolower(pathinfo($uploadImageName, PATHINFO_EXTENSION)) == "avif") { //phpcs:ignore
                    $avifFlag = true;
                }
            }
            if (!$avifFlag) {
                $svg = simplexml_load_file($absolutePath);
                if (!empty($svg['width']) && !empty($svg['height'])) {
                    $width = int($svg['width']);
                    $height = int($svg['height']);
                }

                $data['width'] = $width;
                $data['height'] = $height;
            }
        }

        return $this->assetFactory->create($data);
    }

    /**
     * Retrieve media directory instance with read access
     *
     * @return ReadInterface
     */
    private function getMediaDirectory()
    {
        return $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
    }
}
