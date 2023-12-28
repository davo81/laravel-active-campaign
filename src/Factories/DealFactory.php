<?php

namespace Label84\ActiveCampaign\Factories;

use Label84\ActiveCampaign\DataObjects\ActiveCampaignDeal;

class DealFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignDeal
    {
        return new ActiveCampaignDeal(
            $attributes['id'],
            $attributes['title'],
            intval($attributes['value']),
            $attributes['currency'],
            $attributes['group'],
            $attributes['stage'],
            $attributes['owner'],
            $attributes['description'],
            $attributes['account'],
            $attributes['contact'],
            intval($attributes['percent']),
            intval($attributes['status']),
        );
    }
}
