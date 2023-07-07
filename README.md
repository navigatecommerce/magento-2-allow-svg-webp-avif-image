# Navigate Commerce Product Allow Svg, Webp and Avif Image Extension for Magento 2

## How to install Navigate_AllowSvgWebpAvifImage module

### Composer Installation

Run the following command in Magento 2 root directory to install Navigate_AllowSvgWebpAvifImage module via composer.

#### Install

```
composer require navigate/magento-2-allow-svg-webp-avif-image
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

#### Update

```
composer update navigate/magento-2-allow-svg-webp-avif-image
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

Run below command if your store is in the production mode:

```
php bin/magento setup:di:compile
```

### Manual Installation

If you prefer to install this module manually, kindly follow the steps described below - 

- Download the latest version [here](https://github.com/navigatecommerce/magento-2-allow-svg-webp-avif-image/archive/refs/heads/main.zip) 
- Create a folder path like this `app/code/Navigate/AllowSvgWebpAvifImage` and extract the `main.zip` file into it.
- Navigate to Magento root directory and execute the below commands.

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```
