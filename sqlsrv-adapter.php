<?php

if (!function_exists('mssql_connect') && function_exists('sqlsrv_connect')) {
    define('MSSQL_ASSOC', SQLSRV_FETCH_ASSOC);
    define('MSSQL_NUM', SQLSRV_FETCH_NUMERIC);
    define('MSSQL_BOTH', SQLSRV_FETCH_BOTH);
    define('SQLTEXT', SQLSRV_SQLTYPE_TEXT);
    define('SQLVARCHAR', SQLSRV_SQLTYPE_VARCHAR(8000));
    define('SQLCHAR', SQLSRV_SQLTYPE_CHAR(1));
    define('SQLINT1', SQLSRV_SQLTYPE_TINYINT);
    define('SQLINT2', SQLSRV_SQLTYPE_INT);
    define('SQLINT4', SQLSRV_SQLTYPE_BIGINT);
    define('SQLBIT', SQLSRV_SQLTYPE_BIT);
    define('SQLFLT4', SQLSRV_PHPTYPE_FLOAT);
    define('SQLFLT8', SQLSRV_PHPTYPE_FLOAT);
    sqlsrv_configure("WarningsReturnAsErrors", 0);

    function mssql_connect($hostname, $username, $password) {
        $connectionInfo = array(
            "UID" => $username,
            "PWD" => $password,
            "APP" => "Samo-Online",
            "MultipleActiveResultSets" => true,
        );
        $conn = sqlsrv_connect($hostname, $connectionInfo);
        if ($conn === false) {
            $GLOBALS['_SQLSRV_CONNECT'] = null;
        } else {
            $GLOBALS['_SQLSRV_CONNECT'] = $conn;
        }
        return $GLOBALS['_SQLSRV_CONNECT'];

    }

    function mssql_pconnect($hostname, $username, $password) {
        return mssql_connect($hostname, $username, $password);
    }

    function mssql_select_db($databasename, $conn = null) {
        return (false !== mssql_query('use [' . $databasename . ']',$conn));
    }

    function mssql_query($sql, $conn = null) {
        $conn = ($conn === null) ? $GLOBALS['_SQLSRV_CONNECT'] : $conn;
        $return = sqlsrv_query($conn , $sql,array(), array( "Scrollable" => 'buffered' ));
        return $return;
    }

    function mssql_fetch_object($rsql) {
        if ($array = mssql_fetch_array($rsql, SQLSRV_FETCH_ASSOC)) {
            $object = new stdClass();
            if (is_array($array) && !empty($array)) {
                foreach ($array as $name => $value) {
                    $name = trim($name);
                    if (!empty($name)) {
                        $object->$name = $value;
                    }
                }
            }
            if (empty($array)) {
                return null;
            }
            return $object;
        }
        return false;
    }

    function mssql_fetch_array($rsql, $mode = SQLSRV_FETCH_ASSOC) {
        $meta = sqlsrv_field_metadata($rsql);
        $return = sqlsrv_fetch_array($rsql, $mode);
        if (is_array($return)) {
            foreach ($meta as $data) {
                switch ($data['Type']) {
                    case 3:
                        $return[$data['Name']] = (null !== $return[$data['Name']]) ? floatval($return[$data['Name']]) : null;
                        break;
                    default:
                        break;
                }
            }
        }
        return (null === $return) ? false : $return;
    }

    function mssql_fetch_assoc($rsql, $mode = SQLSRV_FETCH_ASSOC) {
        return mssql_fetch_array($rsql, $mode = SQLSRV_FETCH_ASSOC);
    }

    function mssql_fetch_row($rsql) {
        $return = sqlsrv_fetch_array($rsql, SQLSRV_FETCH_NUMERIC);
        return (null === $return) ? false : $return;
    }

    function mssql_close($conn = null) {
        return sqlsrv_close($conn);
    }

    function mssql_has_rows($rsql) {
        $num = sqlsrv_has_rows($rsql);
        return $num;
    }


    function mssql_num_rows($rsql) {
        $num = sqlsrv_has_rows($rsql) ? sqlsrv_num_rows($rsql) : 0;
        $num = intval($num);
        return $num;
    }

    function mssql_rows_affected($rsql) {
        return sqlsrv_rows_affected($rsql);
    }

    function mssql_num_fields($rsql) {
        return sqlsrv_num_fields($rsql);
    }


    function mssql_next_result($rsql) {
        return sqlsrv_next_result($rsql);
    }

    function mssql_get_last_message() {
        $errors = sqlsrv_errors();
        if (is_array($errors)) {
        /* If errors and/or warnings occurred on the last sqlsrv operation,
            an array of arrays containing error information is returned.
        */
            $last = end($errors);
            return $last['message'];
        }
        /* If no errors and/or warnings occurred on the last sqlsrv operation, NULL is returned */
        return "";
    }

    function mssql_free_result($result) {
        return sqlsrv_free_stmt($result);
    }
    function mssql_data_seek($result , $row_number) {
          debug_print_backtrace();
    }
    function mssql_bind($stmt , $param_name , &$var , $type ,$is_output = false ,  $is_null = false , $maxlen = -1 ) {
        debug_print_backtrace();
    }
    function mssql_execute($stmt, $skip_results = false) {
        debug_print_backtrace();
    }
    function mssql_fetch_field($result,$field_offset = -1) {
        debug_print_backtrace();
    }
    function mssql_field_type($result, $offset = -1) {
        $meta = sqlsrv_field_metadata($result);
        $offset = (-1 === $offset) ? 0 : $offset;
        return isset($meta[$offset]) ? $meta[$offset]['Type'] : false;
    }
    function mssql_field_seek($result, $offset) {
        debug_print_backtrace();
    }
    function mssql_free_statement($stmt) {
        debug_print_backtrace();
    }
    function mssql_guid_string($binary, $short_format = false) {
        debug_print_backtrace();
    }
    function mssql_init($sp_name,$link_identifier) {
        debug_print_backtrace();
    }
    function mssql_min_error_severity($severity) {
        debug_print_backtrace();
    }
    function mssql_min_message_severity($severity) {
        debug_print_backtrace();
    }
    function mssql_field_name($result,$offset = -1) {
        $meta = sqlsrv_field_metadata($result);
        $offset = (-1 === $offset) ? 0 : $offset;
        return isset($meta[$offset]) ? $meta[$offset]['Name'] : false;
    }
    function mssql_field_length($result,$offset = -1) {
        $meta = sqlsrv_field_metadata($result);
        $offset = (-1 === $offset) ? 0 : $offset;
        return isset($meta[$offset]) ? $meta[$offset]['Size'] : false;
    }
    function mssql_fetch_batch($result) {
        debug_print_backtrace();
    }
}