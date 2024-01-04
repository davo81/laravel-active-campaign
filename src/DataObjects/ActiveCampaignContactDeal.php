<?php

namespace Label84\ActiveCampaign\DataObjects;

class ActiveCampaignContactDeal
{
    public function __construct(
        public readonly string $id,
        public readonly string $contact,
        public readonly string $deal,
    ) {
    }
}
