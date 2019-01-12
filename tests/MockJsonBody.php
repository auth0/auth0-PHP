<?php
namespace Auth0\Tests;


class MockJsonBody {

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $dataBackup = [];

    /**
     * MockJsonBody constructor.
     *
     * @param $name
     *
     * @throws \Exception
     */
    public function __construct( $name )
    {
        $file_path     = AUTH0_PHP_TEST_JSON_DIR.'management-api--' . $name . '.json';

        if ( !file_exists( $file_path ) ) {
            throw new \Exception( 'Cannot find file ' . $file_path );
        }
        $json_contents = file_get_contents( $file_path );
        $this->data    = json_decode( $json_contents, true );
        $this->dataBackup = $this->data;
    }

    /**
     * Remove data that does not pass the filter check.
     *
     * @param string $filter_key
     * @param string $filter_val
     *
     * @return $this
     */
    public function withFilter( $filter_key, $filter_val )
    {
        foreach ($this->data as $index => $datum) {
            if ($datum[$filter_key] !== $filter_val) {
                unset($this->data[$index]);
            }
        }
        return $this;
    }

    /**
     * @param int $page_num
     * @param int $per_page
     *
     * @return $this
     */
    public function withPages( $page_num, $per_page ) {
        $this->data = array_slice($this->data, $page_num * $per_page, $per_page);
        return $this;
    }

    /**
     * @param array $fields Array
     * @param bool $include_fields True to include the fields above, false to exclude them.
     *
     * @return $this
     */
    public function withFields( array $fields, $include_fields = true ) {
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
     * @return string
     */
    public function getClean() {
        $output = json_encode( array_values( $this->data ) );
        $this->data = $this->dataBackup;
        return $output;
    }

}
