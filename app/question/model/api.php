<?php
/**
 *
 */
class core_model_api_jsend
{
    const JSEND_SUCCESS = 'success',
          JSEND_FAIL    = 'fail',
          JSEND_ERROR   = 'error';

    /**
     * Format data using the JSend standard
     *
     * @param int $status
     * @param mixed $data
     * @param string $callback
     * @throws Mage_Core_Exception
     * @return string
     */
    public function jsend($status, $data, $callback = NULL)
    {
        $json = [
            'status' => $status
        ];

        switch ($status) {
            // required = status, data
            case self::JSEND_SUCCESS:
            // required = status, data
            case self::JSEND_FAIL:
                $json['data'] = $data;
                break;
            // required = status, message
            // optional = code, data
            case self::JSEND_ERROR:
                if (is_array($data)) {
                    $json = array_merge($data, $json);
                } elseif (is_string($data)) {
                    $json['message'] = $data;
                }
                if (!isset($json['message'])) {
                    Mage::throwException($this->__('"message" field is mandatory for "error" status code'));
                }
                break;
        }

        $json = json_encode($json);

        if ($callback) {
            $json = $callback . '(' . $json . ')';
        }

        return $json;
    }
}
