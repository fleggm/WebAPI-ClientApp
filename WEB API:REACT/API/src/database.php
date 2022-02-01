<?php 
/**
 * Connect to an SQLite Database
 * 
 * @author Matthew Flegg w19001527
 */

class Database{
    private $dbConnection;
    /**
     * Make a connection to an sqlite database or throw an exception
     */

    public function __construct($dbName){
        $this->setDbConnection($dbName);
    }

    private function setDbConnection($dbName){
            $this->dbConnection = new PDO('sqlite:'.$dbName);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Execute an SQL prepared statement
     *
     * This function executes the query and uses the PDO 'fetchAll' method with the
     * 'FETCH_ASSOC' flag set so that an associative array of results is returned.
     *
     * @param  string  $sql     An SQL statement
     * @param  array   $params  An associative array of parameters (default empty array) 
     * @return array            An associative array of the query results
     */

    public function executeSQL($sql,$params=[]){
        $stmt = $this->dbConnection->prepare($sql);
        $stmt -> execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}