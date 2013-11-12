<?php
/**
 *
 */
class apiModel extends baseModel
{
    const JSEND_SUCCESS = 'success',
          JSEND_FAIL    = 'fail',
          JSEND_ERROR   = 'error';

    public function getActions()
    {
        $reflection = new ReflectionClass('apiController');
        $methods = [];
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() == $reflection->getName()) {
                $methods[] = $method->getName(); 
            }
        }

        $data = [ 
            'description' => 'Available API actions',
            'actions' => $methods
        ];

        $response = $this->_jsend(self::JSEND_SUCCESS, $data);
        return $response;
    }

    /**
     * Format data using the JSend standard
     *
     * @param int $status
     * @param mixed $data
     * @param string $callback
     * @throws Mage_Core_Exception
     * @return string
     */
    private function _jsend($status, $data, $callback = NULL)
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
