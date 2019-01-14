<?php
namespace Auth0\Tests;

/**
 * Class MockJsonBody.
 *
 * @package Auth0\Tests
 */
class MockJsonBody
{

    /**
     * Mock API JSON data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Backup data to reset.
     *
     * @var array
     */
    protected $dataBackup = [];

    /**
     * MockJsonBody constructor.
     *
     * @param string $name Endpoint name, used to load the JSON file.
     *
     * @throws \Exception When the JSON data file cannot be loaded.
     */
    public function __construct($name)
    {
        $file_path = AUTH0_PHP_TEST_JSON_DIR.'management-api--'.$name.'.json';

        if (! file_exists( $file_path )) {
            throw new \Exception( 'Cannot find file '.$file_path );
        }

        $json_contents    = file_get_contents( $file_path );
        $this->data       = json_decode( $json_contents, true );
        $this->dataBackup = $this->data;
    }

    /**
     * Filter returned data.
     *
     * @param string $filter_key Filter key to use.
     * @param string $filter_val Filter value to keep.
     *
     * @return $this
     */
    public function withFilter($filter_key, $filter_val)
    {
        foreach ($this->data as $index => $datum) {
            if ($datum[$filter_key] !== $filter_val) {
                unset($this->data[$index]);
            }
        }

        return $this;
    }

    /**
     * Paginate returned data.
     *
     * @param integer $page_num Page number, zero-based.
     * @param integer $per_page Number of results per page.
     *
     * @return $this
     */
    public function withPages($page_num, $per_page)
    {
        $this->data = array_slice($this->data, $page_num * $per_page, $per_page);
        return $this;
    }

    /**
     * Include or exclude specific fields.
     *
     * @param array   $fields         Fields to include or exclude.
     * @param boolean $include_fields True to include the fields above, false to exclude them.
     *
     * @return $this
     */
    public function withFields(array $fields, $include_fields = true)
    {
        // Switch field values to keys.
        $check_fields = array_flip( $fields );
        foreach ($this->data as $index => $datum) {
            if ($include_fields) {
                // Keep the keys indicated.
                $this->data[$index] = array_intersect_key( $datum, $check_fields );
            } else {
                // Remove the keys indicated.
                $this->data[$index] = array_diff_key( $datum, $check_fields );
            }
        }

        return $this;
    }

    /**
     * Get final JSON and reset to original data.
     *
     * @param boolean $single True for a single object result, false for all results as array.
     *
     * @return string
     */
    public function getClean($single = false)
    {
        $data       = array_values( $this->data );
        $this->data = $this->dataBackup;
        return json_encode( $single ? $data[0] : $data );
    }
}
