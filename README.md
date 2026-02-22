# Shipment Delivery Date Module

Magento 2 module that adds a delivery date timestamp field to the shipment admin page.

## Features
- Adds datetime input field to shipment view page in admin
- Saves delivery date as epoch timestamp to `shipment_delivereddate` table
- Uses existing API endpoint: `rest/V1/shipment/delivereddate`

## Installation
```bash
composer require mumzworld/shipment-delivery-date --dev
php bin/magento module:enable Mumzworld_ShipmentDeliveryDate
php bin/magento setup:upgrade
php bin/magento cache:flush
```
