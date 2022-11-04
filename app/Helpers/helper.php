<?php
    /**
     * for database datetime
     */
    if (!function_exists('databaseFormattedDatetime')) {
        function databaseFormattedDatetime($date = null)
        {
            return $date ? date('Y-m-d H:i:s', strtotime($date)) : date('Y-m-d H:i:s');
        }
    }

    /**
     * for database date
     */
    if (!function_exists('databaseFormattedDate')) {
        function databaseFormattedDate($date = null)
        {
            return $date ? date('Y-m-d', strtotime($date)) : date('Y-m-d');
        }
    }

    /**
     * for database time
     */
    if (!function_exists('databaseFormattedTime')) {
        function databaseFormattedTime($date = null)
        {
            return $date ? date('H:i:s', strtotime($date)) : date('H:i:s');
        }
    }

    /**
     * for user date
     */
    if (!function_exists('userFormattedDate')) {
        function userFormattedDate($date = null)
        {
            return $date ? date('d M, y', strtotime($date)) : date('d M, y');
        }
    }

    /**
     * for user datetime
     */
    if (!function_exists('userFormattedDatetime')) {
        function userFormattedDatetime($date = null)
        {
            return $date ? date('d M, y  h:i A', strtotime($date)) : date('d M, y  h:i A');
        }
    }

    /**
     * for user time
     */
    if (!function_exists('userFormattedTime')) {
        function userFormattedTime($date = null)
        {
            return $date ? date('h:i A', strtotime($date)) : date('h:i A');
        }
    }
