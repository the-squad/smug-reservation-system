<?php
class Database {

    // Host.
    private $host = "localhost";
    // Username.
    private $user = "root";
    // Password.
    private $password = "";
    // Database name.
    private $database = "smug";
    // Connection object.
    private $connection = NULL;
    // Database object.
    private static $DB = NULL;

    /** Constructor */
    private function __construct() {
        //$this->createConnection();
    }

    /** return object of type Database. */
    public static

    function getObject() {
        if (Database::$DB == NULL) {
            Database::$DB = new Database();
        }
        return Database::$DB;
    }

    /**
     * Establish new connection or throw Exception.
     */
    private function createConnection() {
        $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        mysqli_set_charset($this->connection, "utf8");
        if (!$this->connection) {
            throw new Exception("Error: Can't create connection.", 1);
        }
    }

    /** Return connection. */
    public function getConnection() {
        if (!$this->connection) {
            $this->createConnection();
        }
        return $this->connection;
    }

    /** Close opened connection. */
    public function closeConnection() {
        if ($this->connection) {
            mysqli_close($this->connection);
            $this->connection = NULL;
        }
    }

    /**
     * Insert new record into database.
     *
     * $table : Table name.
     * $data  : Associative array ("Attribute" => "Value").
     *
     * return : TRUE on success, FALSE on failure.
     */
    public function add($table, $data) {
        $this->createConnection();
        $attributes = [];
        $values = [];
        foreach($data as $key => $value) {
            $attributes[] = $key;
            $values[] = $value;
        }
        $query = "INSERT INTO `{$table}` (`".implode("`, `", $attributes)."`) VALUES ('".implode("', '", $values)."')";
        return mysqli_query($this->connection, $query);
    }

    /**
     * Updates an existing record.
     *
     * $table  : Table name.
     * $data   : Associative array ("Attribute" => "Value").
     * $column : WHERE Attribute.
     * $value  : WHERE Value.
     *
     * return  : TRUE on success, FALSE on failure.
     */
    public function edit($table, $data, $column, $val) {
        $this->createConnection();
        $values = [];
        foreach($data as $key => $value) {
            $values[] = "`{$key}` = '{$value}'";
        }
        $query = "UPDATE `{$table}` SET ".implode(", ", $values)." WHERE `{$column}` = '{$val}'";

        return mysqli_query($this->connection, $query);
    }

    /**
     * Delete an existing record.
     *
     * $table  : Table name.
     * $column : WHERE Attribute.
     * $value  : WHERE Value.
     *
     * return  : TRUE on success, FALSE on failure.
     */
    public function delete($table, $column, $value) {
        $this->createConnection();
        $query = "DELETE FROM `{$table}` WHERE `{$column}` = '{$value}'";
        return mysqli_query($this->connection, $query);
    }

    /**
     * Get all records or specific record from database.
     *
     * $table   : Table name.
     * $columns : Array of Attributes.
     * $column  : (Optional) WHERE Attribute.
     * $value   : (Optional) WHERE Value.
     *
     * return   : mysqli_result object on success, FALSE on failure.
     */
    public function get($table, $columns, $column = '1', $value = '1') {
        $this->createConnection();
        $column = $column == '1' ? "'{$column}'" : "`{$column}`";
        $query = "SELECT `".implode("`, `", $columns)."` FROM `{$table}` WHERE {$column} = '{$value}'";
        return mysqli_query($this->connection, $query);
    }

    /**
     * Execute sql query.
     *
     * $query : query :D.
     *
     * return : mysqli_result object on success, FALSE on failure.
     */
    public function execute($query) {
        $this->createConnection();
        return mysqli_query($this->connection, $query);
    }

    /**
     * get all result in asscative array.
     *
     * @param mysqli_result $result mysql result.
     *
     * @return all rows in assocative array.
     */
    public function fetchAll(mysqli_result $result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
