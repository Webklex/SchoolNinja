<?php
/*
 * 
 * POWERD AND DOCUMENTED BY http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/ 
 * 
*/


class classes_DB{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;
    private $error;
	
    private $stmt;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
	
    /*
     * 
     * The prepare function allows you to bind values into your SQL statements. This is important because 
     * it takes away the threat of SQL Injection because you are no longer having to manually include 
     * the parameters into the query string.
     *  
    */
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    /*
     * 
     * The prepare function allows you to bind values into your SQL statements. This is important
     *  because it takes away the threat of SQL Injection because you are no longer having to manually 
     * include the parameters into the query string.
     * 
     * PARAM	 is the placeholder value that we will be using in our SQL statement, example :name.
     * VALUE	 is the actual value that we want to bind to the placeholder, example “John Smith”.
     * TYPE	 is the datatype of the parameter, example string.
     * 
     */
    public function bind($param, $value, $type = null){
        if (is_null($type)) {
                switch (true) {
                case is_int($value):
                        $type = PDO::PARAM_INT;
                    break;
                    case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                        break;
               case is_null($value):
                        $type = PDO::PARAM_NULL;
                    break;
                    default:
                    $type = PDO::PARAM_STR;
                }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /*
     * 
     * The execute method executes the prepared statement.
     * 
     */
    public function execute(){
        return $this->stmt->execute();
    }

    /*
     * 
     * The Result Set function returns an array of the result set rows. 
     * First we run the execute method, then we return the results.
     * 
     */
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * 
     * Very similar to the previous method, the Single method simply returns a single record from 
     * the database. Again, first we run the execute method, then we return the single result.
     * 
     */
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * 
     * The next method simply returns the number of effected rows from the previous delete, 
     * update or insert statement.
     * 
     */
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    /*
     * 
     * The Last Insert Id method returns the last inserted Id as a string.
     * 
     */
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    /*
     * 
     * ################################
     * ##########TRANSACTIONS##########
     * ################################
     * Transactions allows you to run multiple changes to a database all in one batch to 
     * ensure that your work will not be accessed incorrectly or there will be no outside 
     * interferences before you are finished. If you are running many queries that all rely upon 
     * each other, if one fails an exception will be thrown and you can roll back any previous 
     * changes to the start of the transaction.
     * 
     * For example, say you wanted to enter a new user into your system. The create new user 
     * insert worked, but then you had to create the user configuration details in a separate 
     * statement. If the second statement fails, you could then roll back to the beginning of 
     * the transaction.
     * 
T	 * ransactions also prevent anyone accessing your database from seeing inconsistent data. 
     * For example, say we created the user but someone accessed that data before the user 
     * configuration was set. The accessing user would see incorrect data (a user without 
     * configuration) which could potentially expose our system to errors.
     * 
     * To begin a transaction:
     * 
     */
    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    /*
     * 
     * To end a transaction and commit your changes:
     * 
     */
    public function endTransaction(){
        return $this->dbh->commit();
    }

    /*
     * 
     * To cancel a transaction and roll back your changes:
     * 
     */
    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    /*
     * 
     * The Debut Dump Parameters methods dumps the the information that was contained 
     * in the Prepared Statement.
     * 
     */
    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }
}
?>