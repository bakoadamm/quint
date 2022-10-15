<?php

if ( ! function_exists('env')) {
    function env($key, $default = null) {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        if (startsWith($value, '"') && endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if ( ! function_exists('apiResponse')) {

    /**
     * @param array $data
     * @param int $statusCode
     */
    function apiResponse(array $data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}

if ( ! function_exists('response')) {

    /**
     * @param array $data
     */
    function response(array $data) {
        apiResponse([
            'success' => $data[0],
            'error' => [
                'code' => $data[1],
                'message' => $data[2]
            ]
        ], $data[1]);
    }
}

if ( ! function_exists('startsWith')) {

    /**
     * @param $string
     * @param $startString
     * @return bool
     */
    function startsWith($string, $startString) {
        return (substr($string, 0, strlen($startString)) === $startString);
    }
}

if ( ! function_exists('endsWith')) {

    /**
     * @param $haystack
     * @param $needles
     * @return bool
     */
    function endsWith($haystack, $needles) {
        foreach ((array) $needles as $needle) {
            if (
                $needle !== '' && $needle !== null
                && substr($haystack, -strlen($needle)) === (string) $needle
            ) {
                return true;
            }
        }
        return false;
    }

}

if ( ! function_exists('redirect')) {

    /**
     * @param $url
     */
    function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}

if ( ! function_exists('auth')) {

    /**
     * @return bool
     */
    function auth() {
        return isset($_SESSION['user']);
    }
}

if ( ! function_exists('user')) {

    /**
     * @return array|null
     */
    function user() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }
}
