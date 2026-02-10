# Mavenbird_CancelOrder Module - Change Log

## [1.0.0] - 2025-09-25
### Added
- Initial release of the Mavenbird Cancel Order module.
- Frontend cancel button on order history and order view pages.
- Cancel popup with multiple predefined reasons and "Other" option.
- AJAX cancel request with Magento messages for success/failure.
- System configuration to enable/disable the cancel button.
- Helper class `Mavenbird\CancelOrder\Helper\Data` for module settings.
- Block class `CancelButton` with proper DI for helper and order repository.
- Full PHPCS Magento2 standard compliance (escaped output and docblocks).
