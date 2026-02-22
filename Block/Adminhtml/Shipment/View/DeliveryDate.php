<?php

declare(strict_types=1);

namespace Mumzworld\ShipmentDeliveryDate\Block\Adminhtml\Shipment\View;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Mumzworld\Shipment\Api\ShipmentDeliveredDateRepositoryInterface;

class DeliveryDate extends Template
{
    public function __construct(
        Context $context,
        private readonly Registry $registry,
        private readonly ShipmentDeliveredDateRepositoryInterface $deliveredDateRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getShipment()
    {
        return $this->registry->registry('current_shipment');
    }

    public function getDeliveryDate(): ?int
    {
        $shipment = $this->getShipment();
        if ($shipment) {
            return $this->deliveredDateRepository->getDeliveredDateByShipmentId((int)$shipment->getId());
        }
        return null;
    }

    public function getSaveUrl(): string
    {
        return $this->getUrl('adminhtml/shipment/saveDeliveryDate', ['shipment_id' => $this->getShipment()->getId()]);
    }
}
