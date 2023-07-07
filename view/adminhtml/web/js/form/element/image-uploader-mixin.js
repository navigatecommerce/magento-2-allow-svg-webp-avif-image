/**
 * Navigate Commerce
 *
 * @author       Navigate Commerce
 * @package      Navigate_AllowSvgWebpAvifImage
 * @copyright    Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license      https://www.navigatecommerce.com/end-user-license-agreement
 */

define(function () {
    'use strict';

    return function (imageUploader) {
        return imageUploader.extend({
            initialize: function () {
                this._super();

                this.allowedExtensions += ' svg';
                this.allowedExtensions += ' webp';
                this.allowedExtensions += ' avif';
            }
        });
    };
});
