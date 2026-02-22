# Shipment Delivery Date Module

Adds a delivery date timestamp field to the shipment admin page.

## Features
- Adds datetime input field to shipment view page in admin
- Saves delivery date as epoch timestamp to `shipment_delivereddate` table
- Uses existing API endpoint: `rest/V1/shipment/delivereddate`

## Installation
Add to composer.json require-dev section and run composer update.
