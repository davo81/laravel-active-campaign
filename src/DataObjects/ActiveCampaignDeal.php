<?php

namespace Label84\ActiveCampaign\DataObjects;

class ActiveCampaignDeal
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly int $value,
        public readonly string $currency,
        public readonly string $group,
        public readonly string $stage,
        public readonly string $owner,
        public readonly ?string $description,
        public readonly ?string $account,
        public readonly ?string $contact,
        public readonly ?int $percent,
        public readonly ?int $status,
    ) {
    }
}
