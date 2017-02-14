<?php

/**
 * Connects to the database
 *
 * @return mysqli
 */
function db_connect()
{


    $dbServer = "";    // Servername:portnumber
    $dbUser = "";           // Database username
    $dbPass = "";               // Database password
    $dbName = "";       // Name of the database

    // Declared as static so it keeps its value between calls to the method
    // This way we can connect to the database once and use the same connection
    // This is perhaps not always a good thing...
    static $con;

    // Connect to the database only if a connection has not been established yet
    if (!isset($con)) {
        // Create the connection
        $con = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
    }
    return $con;
}

/**
 * Ask the database for data
 * Note, the query must be cleaned
 *
 * @param $query
 * @return bool|mysqli_result
 */
function db_query($query) {

    // Get the link to the database, connects if needed
    $connection = db_connect();
    //echo $query;
    // If the connection is made
    if ($connection) {
        // Send the query to the database
        $result = mysqli_query($connection, $query);
        return $result;
    }
    // Something went wrong
    return false;
}

/**
 * Makes a SELECT-query to the database
 * Note, the query must be cleaned
 *
 * @param $query
 * @return array
 */
function db_select($query) {
    $rows = array();
    // Make the query
    $result = db_query($query);
    // If query was successful
    if($result) {
        // Retrieve all the rows into an array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    return $rows;
}

/**
 * Uses mysqli_real_escape_string to clean up the users input
 *
 * @param $value the users input
 * @return string the cleaned value
 */
function db_quote($value) {
    $connection = db_connect();
    if ($connection) {
        return "'" . mysqli_real_escape_string($connection, $value) . "'";
    }
    return null;
}

/**
 * Gets the latest error message
 * @return string
 */
function db_error() {
    $connection = db_connect();
    if ($connection) {
        return mysqli_error($connection);
    }
    return mysqli_connect_error();
}

/**
 * Import database tables to a database that already exists
 * Use this function to import tables into the LTU-database
 * Use the web-interface MyPhpAdmin to export the database to a .sql-file
 *
 * @param $filename the name of the file that contains the sql-dump
 */
function db_import($filename) {

    // Store the next query
    $query = '';

    // Read all of the file
    $lines = file($filename);

    // Process one line at the time
    foreach ($lines as $line)
    {
        // Do nothing with comments or empty lines
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add line to the current query
        $query .= $line;

        // End of query is reached if a semicolon is found in the end if the line
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            db_query($query) or print('Error in import \'<strong>' . $query . '\'</strong>: ' . mysqli_connect_error() . '<br><br>');

            // Reset temp variable to empty
            $query = '';
        }
    }
    echo "Tables imported";
}

?>