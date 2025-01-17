<?php

namespace Label84\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use Label84\ActiveCampaign\DataObjects\ActiveCampaignTag;
use Label84\ActiveCampaign\Exceptions\ActiveCampaignException;
use Label84\ActiveCampaign\Factories\TagFactory;

class ActiveCampaignTagsResource extends ActiveCampaignBaseResource
{
    /**
     * Retrieve an existing tag by its ID.
     *
     * @see https://developers.activecampaign.com/reference/retrieve-a-tag
     *
     * @throws ActiveCampaignException
     */
    public function get(int $id): ActiveCampaignTag
    {
        $tag = $this->request(
            method: 'get',
            path: 'tags/'.$id,
            responseKey: 'tag'
        );

        return TagFactory::make($tag);
    }

    /**
     * List all tags, optionally filtering them by name
     *
     * @see https://developers.activecampaign.com/reference/retrieve-all-tags
     *
     * @return Collection<int, ActiveCampaignTag>
     *
     * @throws ActiveCampaignException
     */
    public function list(?string $name = '', array $params = []): Collection
    {
        $tags = $this->request(
            method: 'get',
            path: 'tags?search='.$name . '&' . http_build_query($params),
            responseKey: 'tags'
        );

        return (new Collection($tags))
            ->map(fn ($tag) => TagFactory::make($tag));
    }

    /**
     * Create a tag and return its ID.
     *
     * @see https://developers.activecampaign.com/reference/create-a-new-tag
     *
     * @throws ActiveCampaignException
     */
    public function create(string $name, string $description = ''): string
    {
        $tag = $this->request(
            method: 'post',
            path: 'tags',
            data: [
                'tag' => [
                    'tag' => $name,
                    'tagType' => 'contact',
                    'description' => $description,
                ],
            ],
            responseKey: 'tag'
        );

        return $tag['id'];
    }

    /**
     * Update an existing tag.
     *
     * @see https://developers.activecampaign.com/reference/update-a-tag
     *
     * @throws ActiveCampaignException
     */
    public function update(ActiveCampaignTag $tag): ActiveCampaignTag
    {
        return TagFactory::make($this->request(
            method: 'put',
            path: 'tags/'.$tag->id,
            data: [
                'tag' => [
                    'tag' => $tag->name,
                    'tagType' => 'contact',
                    'description' => $tag->description,
                ],
            ],
            responseKey: 'tag'
        ));
    }

    /**
     * Delete an existing tag by its ID.
     *
     * @see https://developers.activecampaign.com/reference/delete-a-tag
     *
     * @throws ActiveCampaignException
     */
    public function delete(int $id): void
    {
        $this->request(
            method: 'delete',
            path: 'tags/'.$id
        );
    }
}
