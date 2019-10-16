<?php

namespace Auth0\SDK\API\Management;

class Blacklists extends GenericResource
{
    /**
     *
     * @param  string $aud
     * @return mixed
     */
    public function getAll($aud)
    {
        return $this->apiClient->method('get')
            ->addPath('blacklists', 'tokens')
            ->withParam('aud', $aud)
            ->call();
    }

    /**
     *
     * @param  string $aud
     * @param  string $jti
     * @return mixed
     */
    public function blacklist($aud, $jti)
    {
        return $this->apiClient->method('post')
            ->addPath('blacklists', 'tokens')
            ->withBody(json_encode([
                'aud' => $aud,
                'jti' => $jti
            ]))
            ->call();
    }
}
