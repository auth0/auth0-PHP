<?php

namespace Auth0\SDK\API\Helpers;

class InformationHeaders
{

    /**
     *
     * @var array
     */
    protected $data = [];

    /**
     *
     * @param string $name
     * @param string $version
     */
    public function setPackage($name, $version)
    {
        $this->data['name']    = $name;
        $this->data['version'] = $version;
    }

    /**
     * Add an optional env property for SDK telemetry.
     *
     * @param string $name    - Property name to set, name of dependency or platform.
     * @param string $version - Version number.
     */
    public function setEnvProperty($name, $version)
    {
        if (! isset($this->data['env']) || ! is_array($this->data['env'])) {
            $this->data['env'] = [];
        }

        $this->data['env'][$name] = $version;
    }

    /**
     * TODO: Deprecate, not used.
     *
     * @param string $name
     * @param string $version
     *
     * @codeCoverageIgnore - Slated for deprecation
     */
    public function setEnvironment($name, $version)
    {
        $this->data['environment'][] = [
            'name' => $name,
            'version' => $version,
        ];
    }

    /**
     * TODO: Deprecate, not used.
     *
     * @param array $data
     *
     * @codeCoverageIgnore - Slated for deprecation
     */
    public function setEnvironmentData($data)
    {
        $this->data['environment'] = $data;
    }

    /**
     * TODO: Deprecate, not used.
     *
     * @param string $name
     * @param string $version
     *
     * @codeCoverageIgnore - Slated for deprecation
     */
    public function setDependency($name, $version)
    {
        $this->data['dependencies'][] = [
            'name' => $name,
            'version' => $version,
        ];
    }

    /**
     * TODO: Deprecate, not used.
     *
     * @param array $data
     *
     * @codeCoverageIgnore - Slated for deprecation
     */
    public function setDependencyData($data)
    {
        $this->data['dependencies'] = $data;
    }

    /**
     *
     * @return array
     */
    public function get()
    {
        return $this->data;
    }

    /**
     *
     * @return string
     */
    public function build()
    {
        return base64_encode(json_encode($this->get()));
    }

    /**
     * TODO: Deprecate, not used.
     *
     * @param  InformationHeaders $headers
     * @return InformationHeaders
     *
     * @codeCoverageIgnore - Slated for deprecation
     */
    public static function Extend(InformationHeaders $headers)
    {
        $newHeaders = new InformationHeaders;

        $oldData = $headers->get();

        $newHeaders->setEnvironmentData($oldData['environment']);
        $newHeaders->setDependency($oldData['name'], $oldData['version']);

        return $newHeaders;
    }
}
