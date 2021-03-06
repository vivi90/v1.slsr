<?php
/**
 * Database class
 */
class Database
{
	/**
	 * @var PDO Instance of PDO
	 */
	private $pdo;

	/**
	 * @var int Datatype boolean
	 */
	const TYPE_BOOL = PDO::PARAM_BOOL;

	/**
	 * @var int Datatype NULL
	 */
	const TYPE_NULL = PDO::PARAM_NULL;

	/**
	 * @var int Datatype integer
	 */
	const TYPE_INT = PDO::PARAM_INT;

	/**
	 * @var int Datatype string
	 */
	const TYPE_STR = PDO::PARAM_STR;

	/**
	 * @var int Datatype LOB
	 */
	const TYPE_LOB = PDO::PARAM_LOB;

	/**
	 * Creates a new class instance
	 *
	 * @param string $host Database host
	 * @param int $port Database port
	 * @param string $database Database
	 * @param string $charset Character set
	 * @param string $user Database user
	 * @param string $password Database password
	 */
	public function __construct($host, $port, $database, $charset, $user, $password)
	{
		$dsn = 'mysql:host='.$host.';port='.$port.';dbname='.$database.';charset='.$charset;
		$this->pdo = new PDO($dsn, $user, $password);
	}

	/**
	 * Prepares a statement
	 *
	 * @param string $statement SQL statement template
	 *
	 * @return Statement|bool Instance of Statement or FALSE on failure
	 */
	public function prepare($statement)
	{
		$return = $this->pdo->prepare($statement);
		if (is_object($return)) {
			if (get_class($return) == 'PDOStatement') {
				return new Statement($return);
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
?>
