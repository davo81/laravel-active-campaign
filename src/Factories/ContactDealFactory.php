<?php

namespace Label84\ActiveCampaign\Factories;

use Label84\ActiveCampaign\DataObjects\ActiveCampaignContactDeal;

class ContactDealFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignContactDeal
    {
        return new ActiveCampaignContactDeal(
            $attributes['id'],
            $attributes['contact'],
            $attributes['deal'],
        );
    }
}
