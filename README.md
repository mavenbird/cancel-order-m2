# Mavenbird_CancelOrder

Lightweight Magento 2 module that adds a frontend "Cancel Order" button on order history and order view pages, a cancel popup with predefined reasons (and "Other"), and a backend configuration to enable/disable the feature.

## Features
- Frontend cancel button on customer order history and order view.
- Cancel popup with multiple predefined reasons + "Other".
- AJAX-based cancel request with Magento message feedback.
- Admin configuration under Stores → Configuration → Mavenbird → Cancel Order.
- ACL resource for admin configuration: `Mavenbird_CancelOrder::config`.

## Requirements
- Magento 2 (tested on 2.4.x)
- PHP and system requirements matching your Magento installation

## Installation (manual)
1. Copy the module into app/code/Mavenbird/CancelOrder
2. Enable and install:
   - php bin/magento module:enable Mavenbird_CancelOrder
   - php bin/magento setup:upgrade
   - php bin/magento cache:flush
3. (Optional) If in production mode:
   - php bin/magento setup:di:compile
   - php bin/magento setup:static-content:deploy -f

## Configuration
Admin: Stores → Configuration → Mavenbird → Cancel Order → General Settings
- Enable Cancel Order Feature: Yes/No

ACL: A new ACL resource is provided (etc/acl.xml). Grant the `Cancel Order Configuration` permission to admin roles that should manage the setting.

## Usage
- When enabled, customers see a cancel button on eligible orders.
- Clicking opens a popup to choose a reason or enter a custom reason.
- Cancellation is submitted via AJAX; success/failure messages appear using Magento message framework.

## Changelog
See CHANGELOG.md for release notes.

## License
See LICENSE.txt bundled with the module or the license URL in module headers.
