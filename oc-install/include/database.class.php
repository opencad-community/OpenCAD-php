<?php

/**
 *	Class Database (PDO Extension)
 *  ---------------------------- 
 *  Description : encapsulates database operations & properties with PDO
 *  Updated	    : 22.05.2013
 *  Version     : 1.0.7
 *	Written by  : ApPHP
 *	Used in     : DataGridWizard, AdminPanel, EasyInstaller
 *	Syntax (standard)  : $db = new Database($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, $is_installation);
 *	Syntax (singleton) : $db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, EI_DATABASE_TYPE, $is_installation);
 *
 *  PUBLIC              STATIC				 PROTECTED           PRIVATE
 *  -------             ----------          ----------          ---------- 
 *  __construct         GetInstance                             PrepareLogSQL
 *	__destruct          IsConnected
 *	Create
 *	AllowTransactions
 *	Open             
 *	Close
 *	CloseCursor
 *	GetVersion
 *	GetDbDriver
 *	Query
 *	Exec
 *	AffectedRows
 *	RowCount
 *	ColumnCount
 *	InsertID
 *	SetEncoding
 *	Error
 *	ErrorCode
 *	ErrorInfo
 *	FetchAssoc
 *	FetchArray
 *	ShowTables
 *	ShowColumns
 *
 *	CHANGE LOG
 *	-----------
 *  1.0.7
 *      - added CloseCursor()
 *      - added "persistent_connection" (default - false)
 *      -
 *      -
 *      -
 *  1.0.6
 *      - changed syntaxt for mssql to 'sqlsrv'
 *      - added $PROJECT
 *      - returned old syntax for 'mssql'
 *      - added sqlsrv in ShowTables()
 *      - added $this->sth = null; to Query()
 *  1.0.5
 *      - removed Query() from ShowColumns() and ShowTables()
 *      - added AllowTransactions()
 *      - added schema parameter for ShowTables/ShowColumns
 *      - added ` for some queries
 *      - fixed some syntaxt errors for mssql in ShowColumns and ShowTables
 *  1.0.4
 *      - added ShowTables()
 *      - PrepareLogSQL code placed in separated function
 *      - updated ShowTables()
 *      - added additional check if object exists for Query, Exec etc. methods
 *      - added ShowColumns()
 *  1.0.3
 *      - improved Exec() - added $check_error parameter
 *      - improved Query() - added fetch type
 *      - added oci connection case in Open() method
 *      - improved oci connection string
 *      - added connect syntaxt for 'ibm'
 *  1.0.2
 *  	- added FetchAssoc()
 *  	- fixed bug in RowCount
 *  	- fixed bug in GetInstance()
 *  	- added IsConnected()
 *  	- fixed error with $installation property
 *	
 **/

class Database
{
    // connection parameters
	private $host = '';
	private $port = '';
	private $db_driver = '';
    private $database = '';
    private $user = '';
    private $password = '';
    private $allow_transactions = false;
	private $force_encoding = false;
    private $persistent_connection = false;
	private static $installation = false;
	private $use_mysql = false;

	private $error = '';
	private $affectedRows = '0';
    // database connection handler 
    private $dbh = NULL;
	// database statament handler 
	private $sth = NULL;
	// static data members	
	private static $objInstance; 

	// DataGridWizard, AdminPanel, EasyInstaller
	private static $PROJECT = 'EasyInstaller';  


	//==========================================================================
    // Class Constructor
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	// 		@param $is_installation
	//==========================================================================
    function __construct($database_host='', $database_name='', $database_username='', $database_password='', $db_driver='', $force_encoding=false, $is_installation=false)	
    {
		$this->host = $database_host;
		$this->port = '';
		
		$host_parts = explode(':', $database_host);		
		if(isset($host_parts[1]) && is_numeric($host_parts[1])){
			$this->host = $host_parts[0];	
			$this->port = $host_parts[1];	
		}
		
		if($database_host == '' && $database_name == ''){
			$config = new Config();	
			$this->host = $config->getHost();
			$this->user = $config->getUser();
			$this->password = $config->getPassword();
			$this->database = $config->getDatabase();
			$this->db_driver = $config->getDatabaseType();
            $this->allow_transactions = false;
		}else{
			$this->database  = $database_name;   	
			$this->user 	 = $database_username;
			$this->password  = $database_password;
			$this->db_driver = strtolower($db_driver);
			$this->allow_transactions = false;
		}
		$this->force_encoding = $force_encoding;
		
		self::$installation = ($is_installation) ? true : false;
	}

	//==========================================================================
    // Class Destructor
	//==========================================================================
    function __destruct()
	{
		// echo 'this object has been destroyed';
    }

    /**
     *	Allow transactions
     *	    @param $mode
     */
    public function AllowTransactions($mode = false)
    {
        $this->allow_transactions = ($mode == true) ? $mode : false;
    }

    /**
     *	Create database
     */
    public function Create()
    {
		$this->dbh = new PDO($this->db_driver.':host='.$this->host, $this->user, $this->password);
		$this->dbh->exec('CREATE DATABASE IF NOT EXISTS `'.$this->database.'`;');
		if($this->dbh->errorCode() != '00000'){
			$err = $this->dbh->errorInfo();
			$this->error = $err[2];
			return false; 
		}
		return true; 
	}

    /**
     *	Checks and opens connection with database
     */
    public function Open()
    {
        // Without PDO extension
        if($this->use_mysql && $this->db_driver == 'mysql'){
            // Choose the appropriate connect function 
            if($this->persistent_connection){
                $func = 'mysql_pconnect';
            } else {
                $func = 'mysql_connect';
            }    
            // Connect to the MySQL server 
            $this->dbh = $func($this->host, $this->user, $this->password);
            return true;
        }
        
        // With PDO extension
		if(version_compare(PHP_VERSION, '5.0.0', '<') || !defined('PDO::ATTR_DRIVER_NAME')){
			$this->error = 'You must have PHP 5 or newer installed to use PHP Data Objects (PDO) extension';
			return false; 
		}

		$port = (!empty($this->port)) ? ';port='.$this->port : '';

		try{
			switch($this->db_driver){
				case 'mssql':
                    $this->dbh = new PDO('mssql:host='.$this->host.$port.';dbname='.$this->database, $this->user, $this->password);
					break;
                case 'sqlsrv': 
                    $this->dbh = new PDO('sqlsrv:Server='.$this->host.$port.';Database='.$this->database, $this->user, $this->password);
					break;
				case 'sybase': 
					$this->dbh = new PDO('sybase:host='.$this->host.$port.';dbname='.$this->database, $this->user, $this->password);
					break;
				case 'sqlite':
					$this->dbh = new PDO('sqlite:my/database/path/database.db');
					break;
				case 'pgsql':
					$this->dbh = new PDO('pgsql:host='.$this->host.$port.';dbname='.$this->database, $this->user, $this->password);
					break;
                case 'ibm': 
                    $this->dbh = new PDO('ibm:'.$this->database, $this->user, $this->password);
                    break;
				case 'oci':
					// Look for valid parameters in product\10.2.0\server\NETWORK\ADMIN	
					// Example: $tns = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = private-22269fa)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = XE) ))';
					$port = (!empty($this->port)) ? $this->port : '1521';
					$tns = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = '.$this->host.')(PORT = '.$port.')) (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = '.$this->database.') ))';
					$this->dbh = new PDO('oci:dbname='.$tns, $this->user, $this->password);
					break;
				case 'mysql':
				default:
					$this->dbh = new PDO($this->db_driver.':host='.$this->host.$port.';dbname='.$this->database, $this->user, $this->password);
                    $this->dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                    if($this->persistent_connection) $this->dbh->setAttribute(PDO::ATTR_PERSISTENT, true);
					break;
			}
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(empty($this->dbh)){
				return false;
			}else if($this->force_encoding){
				$this->dbh->exec('set names utf8');
			}
		}catch(PDOException $e){  
			$this->error = $e->getMessage();
			return false; 
		}            

        return true;
    }	
    
    /**
     *	Close connection 
     */
    public function Close()
    {
		$this->sth = null;
		$this->dbh = null;
    }

	/**
	 * Close cursor
	 * The following call to closeCursor() may be required by some drivers
	 */
    public function CloseCursor()
    {
		return ($this->dbh) ? $this->dbh->closeCursor() : '';
    }

    /**
     *	Returns database engine version
     */
	public function GetVersion()
	{
        if($this->use_mysql && $this->db_driver == 'mysql'){
            $version = mysql_get_server_info();
        }else{
            $version = $this->dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
        }
        // clean version number from alphabetic characters
		return preg_replace('/[^0-9,.]/', '', $version);
	}

    /**
     *	Get DB driver
     */
    public function GetDbDriver()
    {
		return $this->db_driver;
    }

    /**
     *	Runs query
     *		@param $query
     *		@param $fetch_mode
     */
    public function Query($query = '', $fetch_mode = PDO::FETCH_ASSOC)
    {
        if(!$this->dbh || empty($query)) return false;
        
        if($this->use_mysql && $this->db_driver == 'mysql'){
            $this->sth = mysql_query($query, $this->dbh);            
            return ($this->sth != false);            
        }else{
            try{  
                $this->sth = $this->dbh->query($query);
                if($this->sth !== FALSE){
                    $this->sth->setFetchMode($fetch_mode);
                    return $this->sth;
                }
                else return false; 
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                $this->sth = null;
                if(!self::$installation){
                    $sql_log = $this->PrepareLogSQL($e, $query);
                    $this->Exec($sql_log);
                }
                return false; 
            }                        
        }    
    }

    /**
     *	Executes query
     *		@param $query
     *		@param $check_error
     */
    public function Exec($query = '', $check_error = true)
	{
        if(!$this->dbh) return false;
        if(empty($query)) return false;  
		try{
			$this->affectedRows = $this->dbh->exec($query);
			return $this->affectedRows;	
		}catch(PDOException $e){            
			if($check_error){
				$this->error = $e->getMessage();				
				if(!self::$installation){
					$sql_log = $this->PrepareLogSQL($e, $query);
					$this->Query($sql_log);
				}				
			}			
			return false; 
		}		
	}

    /**
     *	Set encoding and collation on database
     *		@param $encoding
     *		@param $collation
     */
    public function SetEncoding($encoding = 'utf8', $collation = 'utf8_unicode_ci')
    {		
		if(empty($encoding)) $encoding = 'utf8';
        if(empty($collation)) $collation = 'utf8_unicode_ci';    
        $sql_variables = array(
                'character_set_client'  =>$encoding,
                'character_set_server'  =>$encoding,
                'character_set_results' =>$encoding,
                'character_set_database'=>$encoding,
                'character_set_connection'=>$encoding,
                'collation_server'      =>$collation,
                'collation_database'    =>$collation,
                'collation_connection'  =>$collation
        );
        foreach($sql_variables as $var => $value){
            $sql = 'SET '.$var.'='.$value;
            $this->Query($sql);
        }        
    }

    /**
     *	Returns affected rows after exec()
     */
    public function AffectedRows()
    {
		return $this->affectedRows;
    }	

    /**
     *	Returns rows count for query()
     */
    public function RowCount()
    {
		return (isset($this->sth)) ? $this->sth->rowCount() : 0; 
    }		

    /**
     *	Returns columns count for query()
     */
    public function ColumnCount()
    {
		return $this->sth->columnCount(); 
    }		

    /**
     *	Returns last insert ID
     */
	public function InsertID()
    {
		return $this->dbh->lastInsertId();
    }

    /**
     *	Returns error 
     */
    public function Error()
    {
		return $this->error;		
    }
	
    /**
     *	Returns error code
     */
    public function ErrorCode()
    {
        return ($this->dbh) ? $this->dbh->errorCode() : false;
    }

    /**
     *	Returns error code
     */
    public function ErrorInfo()
    {
		return ($this->sth) ? $this->sth->errorInfo() : false;
    }
 
	/**
	 * Fetch assoc
	 */
    public function FetchAssoc()
    {
		return ($this->sth) ? $this->sth->fetch(PDO::FETCH_ASSOC) : false;
    }
 
	/**
	 * Fetch array
	 */
    public function FetchArray()
    {
		return ($this->sth) ? $this->sth->fetch(PDO::FETCH_BOTH) : false;
    }
	
	/**
	 * Show tables from current database
	 *      @param $schema
	 */
    public function ShowTables($schema = '')
    {
		switch($this->db_driver){
			case 'mssql';
            case 'sqlsrv':
				$sql = 'SELECT * FROM sys.all_objects WHERE type = \'U\'';
				break;
            case 'pgsql':
                $sql = 'SELECT tablename FROM pg_tables WHERE tableowner = current_user';
                break;
            case 'sqlite':
                $sql = 'SELECT * FROM sqlite_master WHERE type=\'table\'';
                break;
			case 'oci':
				$sql = 'SELECT * FROM system.tab';
				break;
			case 'ibm':
				$sql = 'SELECT TABLE_NAME FROM qsys2.systables'.(($schema != '') ? ' WHERE TABLE_SCHEMA = \''.$schema.'\'' : '');
				break;
			case 'mysql':
			default:
				$sql = 'SHOW TABLES IN `'.$this->database.'`';	
				break;
		}
        return $sql;
    }
	
	/**
	 * Show columns from current database
	 */
    public function ShowColumns($table, $schema = '')
    {
		switch($this->db_driver){
			case 'ibm':
                $sql = 'SELECT COLUMN_NAME FROM qsys2.syscolumns WHERE TABLE_NAME = \''.$table.'\''.(($schema != '') ? ' AND TABLE_SCHEMA = \''.$schema.'\'' : ''); 
				break;
			case 'mssql':
                $sql = 'select COLUMN_NAME, data_type, character_maximum_length from '.$this->database.'.information_schema.columns where table_name = \''.$table.'\'';
				break;
			case 'mysql':
			default:
				$sql = 'SHOW COLUMNS FROM `'.$table.'`';
				break;
		}
        return $sql;
    }


	//==========================================================================
    // Returns DB instance or create initial connection 
	// 		@param $database_host
	// 		@param $database_name
	// 		@param $database_username
	// 		@param $database_password
	// 		@param $db_driver
	// 		@param $force_encoding
	// 		@param $is_installation
	//==========================================================================
	public static function GetInstance($database_host = '', $database_name = '', $database_username = '', $database_password = '', $db_driver = '', $force_encoding = false, $is_installation = false)
	{
		$database_port = '';
		
		$host_parts = explode(':', $database_host);		
		if(isset($host_parts[1]) && is_numeric($host_parts[1])){
			$database_host = $host_parts[0];	
			$database_port = $host_parts[1];	
		}
		
		if($database_host == ''){
			$config = new Config();	
			$database_host = $config->getHost();
			$database_name = $config->getDatabase();
			$database_username = $config->getUser();
			$database_password = $config->getPassword();			
			$db_driver = $config->getDatabaseType();
		}
		
		if(!self::$objInstance){
			self::$objInstance = new Database($database_host, $database_name, $database_username, $database_password, $db_driver, $force_encoding, $is_installation);
			self::$objInstance->Open();
        }		
        return self::$objInstance; 
	}
	
	/**
	 * Check if connected
	 */
	public static function IsConnected()
	{
		return (self::$objInstance) ? true : false; 
	}
	
	/**
	 * Prepare log SQL
	 */
	private function PrepareLogSQL($e, $query)
	{
        if(self::$PROJECT == 'AdminPanel'){
            $sql_log = '';
            $error_no = $e->getCode();
            $error_descr  = 'ENV:        '.$_SERVER['SERVER_NAME'].'<br><br>';
            $error_descr .= 'TIME:       '.@date('M d, Y g:i A').'<br><br>';
            $error_descr .= 'SCRIPT:     '.$_SERVER['PHP_SELF'].'<br><br>';
            $error_descr .= 'ERROR LINE: '.(int)$e->getLine().'<br><br>'; 
            $error_descr .= 'ERROR:      '.$this->error.'<br><br>';
            $error_descr .= 'QUERY:      '.$query.'<br><br>';
            $current_file = basename($_SERVER['PHP_SELF'], '.php').'.php';
            
            $ip_address = get_ip_address();
            $sql_log = 'INSERT INTO '.TABLE_SYSTEM_LOGS.' (id, log_type, title, file_name, log, ip_address, date_created)
                        VALUES (NULL, \'Error\', \'DB Error #'.$error_no.'\', \''.$current_file.'\', \''.encode_text($error_descr).'\', \''.$ip_address.'\', \''.@date('Y-m-d H:i:s').'\')';
            return $sql_log;            
        }else{
            return '';
        }
	}
	
}

