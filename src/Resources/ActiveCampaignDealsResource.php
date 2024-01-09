<?php

namespace Label84\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use Label84\ActiveCampaign\DataObjects\ActiveCampaignDeal;
use Label84\ActiveCampaign\Exceptions\ActiveCampaignException;
use Label84\ActiveCampaign\Factories\DealFactory;

class ActiveCampaignDealsResource extends ActiveCampaignBaseResource
{
    /**
     * Retrieve an existing deal by its ID.
     *
     * @see https://developers.activecampaign.com/reference/retrieve-a-deal
     *
     * @throws ActiveCampaignException
     */
    public function get(string $id): ActiveCampaignDeal
    {
        return DealFactory::make($this->request(
            method: 'get',
            path: 'deals/'.$id,
            responseKey: 'deal'
        ));
    }

    /**
     * List all deals, search deals, or filter deals by query defined criteria.
     *
     * @see https://developers.activecampaign.com/reference/list-all-deals
     *
     * @return Collection<int, ActiveCampaignDeal>
     *
     * @throws ActiveCampaignException
     */
    public function list(?string $query = ''): Collection
    {
        $deals = $this->request(
            method: 'get',
            path: 'deals?'.$query,
            responseKey: 'deals'
        );

        return collect($deals)
            ->map(fn ($deal) => DealFactory::make($deal));
    }

    /**
     * Create a deal and return the deal ID.
     *
     * @see https://developers.activecampaign.com/reference/create-a-deal-new
     *
     * @throws ActiveCampaignException
     */
    public function create(array $attributes = []): string
    {
        $deal = $this->request(
            method: 'post',
            path: 'deals',
            data: [
                'deal' => $attributes,
            ],
            responseKey: 'deal'
        );

        return $deal['id'];
    }

    /**
     * Update an existing deal.
     *
     * @see https://developers.activecampaign.com/reference/update-a-deal-new
     *
     * @throws ActiveCampaignException
     */
    public function update(string $id, array $attributes = []): ActiveCampaignDeal
    {
        return DealFactory::make($this->request(
            method: 'put',
            path: 'deals/'.$id,
            data: [
                'deal' => $attributes,
            ],
            responseKey: 'deal'
        ));
    }

    /**
     * Delete an existing deal by its ID.
     *
     * @see https://developers.activecampaign.com/reference/delete-a-deal
     *
     * @throws ActiveCampaignException
     */
    public function delete(string $id): void
    {
        $this->request(
            method: 'delete',
            path: 'deals/'.$id
        );
    }

    /**
     * Create a deal note
     *
     * @see https://developers.activecampaign.com/reference/create-a-deal-note
     *
     * @return Collection<int, ActiveCampaignDeal>
     *
     * @throws ActiveCampaignException
     */
    public function createNote(string $dealId, string $note): Collection
    {
        $deals = $this->request(
            method: 'post',
            path: 'deals/'.$dealId.'/notes',
            data: [
                'note' => [
                    'note' => $note,
                ],
            ],
            responseKey: 'deals'
        );

        return collect($deals)
            ->map(fn ($deal) => DealFactory::make($deal));
    }

    /**
     * Update a deal note
     *
     * @see https://developers.activecampaign.com/reference/update-a-deal-note
     *
     * @return Collection<int, ActiveCampaignDeal>
     *
     * @throws ActiveCampaignException
     */
    public function updateNote(string $dealId, string $noteId, string $note): Collection
    {
        $deals = $this->request(
            method: 'delete',
            path: 'deals/'.$dealId.'/notes/'.$noteId,
            data: [
                'note' => [
                    'note' => $note,
                ],
            ],
            responseKey: 'deals'
        );

        return collect($deals)
            ->map(fn ($deal) => DealFactory::make($deal));
    }
}
