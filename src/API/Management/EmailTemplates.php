<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Header\ContentType;

class EmailTemplates extends GenericResource
{
    /**
     * Get an email template
     *
     * @param string $templateName - the email template name to get
     *
     * @return mixed
     */
    public function get($templateName)
    {
        return $this->apiClient->get()->addPath('email-templates', $templateName)->call();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create($data) 
    {
        return $this->apiClient->post()
            ->clients()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * @param string $id
     * @param array $data
     * @return mixed
     */
    public function patch($id, $data)
    {
        return $this->apiClient->patch()
            ->clients($id)
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();
    }
}