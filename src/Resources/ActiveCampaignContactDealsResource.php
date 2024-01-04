<?php

namespace Label84\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use Label84\ActiveCampaign\DataObjects\ActiveCampaignContactDeal;
use Label84\ActiveCampaign\Exceptions\ActiveCampaignException;
use Label84\ActiveCampaign\Factories\ContactDealFactory;

class ActiveCampaignContactDealsResource extends ActiveCampaignBaseResource
{
    /**
     * Retrieve an existing secondary contact by its ID.
     *
     * @see https://developers.activecampaign.com/reference/retrieve-a-secondary-contact
     *
     * @throws ActiveCampaignException
     */
    public function get(int $id): ActiveCampaignContactDeal
    {
        return ContactDealFactory::make($this->request(
            method: 'get',
            path: 'contactDeal/'.$id,
            responseKey: 'contactDeal'
        ));
    }

    /**
     * List all secondary contacts.
     *
     * @see https://developers.activecampaign.com/reference/list-all-secondary-contacts
     *
     * @return Collection<int, ActiveCampaignContactDeal>
     *
     * @throws ActiveCampaignException
     */
    public function list(): Collection
    {
        $contacts = $this->request(
            method: 'get',
            path: 'contactDeals',
            responseKey: 'contactDeals'
        );

        return collect($contacts)
            ->map(fn ($contact) => ContactDealFactory::make($contact));
    }

    /**
     * Create a secondary contact and return the ID.
     *
     * @see https://developers.activecampaign.com/reference/create-a-secondary-contact
     *
     * @throws ActiveCampaignException
     */
    public function create(string $dealId, string $contactId): string
    {
        $contact = $this->request(
            method: 'post',
            path: 'contactDeals',
            data: [
                'contactDeal' => [
                    'deal' => $dealId,
                    'contact' => $contactId,
                ],
            ],
            responseKey: 'contactDeal'
        );

        return $contact['id'];
    }

    /**
     * Update an existing contact.
     *
     * @see https://developers.activecampaign.com/reference/update-a-secondary-contact
     *
     * @throws ActiveCampaignException
     */
    public function update(ActiveCampaignContactDeal $contact, ?int $role): ActiveCampaignContactDeal
    {
        return ContactDealFactory::make($this->request(
            method: 'put',
            path: 'contactDeals/'.$contact->id,
            data: [
                'contactDeal' => [
                    'contact' => $contact->contact,
                    'deal' => $contact->deal,
                    'role' => $role,
                ],
            ],
            responseKey: 'contactDeal'
        ));
    }

    /**
     * Delete an existing secondary contact by its ID.
     *
     * @see https://developers.activecampaign.com/referencedelete-a-secondary-contact
     *
     * @throws ActiveCampaignException
     */
    public function delete(string $id): void
    {
        $this->request(
            method: 'delete',
            path: 'contactDeals/'.$id
        );
    }
}
