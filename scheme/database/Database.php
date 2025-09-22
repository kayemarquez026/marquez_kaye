<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - Lightweight PHP MVC Framework Database Class
 * ------------------------------------------------------------------
 *
 * @package LavaLust
 * @author Ronald M. Marasigan
 * @license MIT
 */

class Database {
    /**
     * @var Database|null
     */
    private static ?Database $instance = null;

    /**
     * @var PDO|null
     */
    private ?PDO $db = null;

    private string $driver;
    private ?string $dbprefix = null;
    private ?string $table = null;
    private ?string $columns = null;
    private ?string $sql = null;
    private array $bindValues = [];
    private ?string $join = null;
    private ?string $where = null;
    private bool $grouped = false;
    private int $rowCount = 0;
    private ?string $limit = null;
    private ?string $orderBy = null;
    private ?string $groupBy = null;
    private ?string $having = null;
    private int $lastIDInserted = 0;
    private int $transactionCount = 0;
    private ?string $offset = null;
    private array $operators = ['=', '!=', '<', '>', '<=', '>=', '<>'];
    private ?string $getSQL = null;

    /**
     * Constructor
     *
     * @param string|null $dbname
     * @throws PDOException
     */
    public function __construct(?string $dbname = null)
    {
        if (is_null($dbname)) {
            $database_config =& database_config()['main'];
        } else {
            if (isset(database_config()[$dbname])) {
                $database_config =& database_config()[$dbname];
            } else {
                throw new PDOException('No active configuration for this database.');
            }
        }

        $this->dbprefix = $database_config['dbprefix'];
        $driver = strtolower($database_config['driver']);
        $charset = $database_config['charset'];
        $host = $database_config['hostname'];
        $port = $database_config['port'];
        $dbname_value = $database_config['database'];
        $username = $database_config['username'];
        $password = $database_config['password'];
        $path = $database_config['path'] ?? null;

        switch ($driver) {
            case 'mysql':
                $dsn = "mysql:host=$host;dbname=$dbname_value;charset=$charset;port=$port";
                break;
            case 'pgsql':
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname_value;user=$username;password=$password";
                break;
            case 'sqlite':
                if (empty($path)) {
                    throw new PDOException('SQLite requires a valid file path.');
                }
                $dsn = "sqlite:$path";
                break;
            case 'sqlsrv':
                $dsn = "sqlsrv:Server=$host,$port;Database=$dbname_value";
                break;
            default:
                throw new PDOException("Unsupported database driver: $driver");
        }

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
            $this->driver = $this->db->getAttribute(PDO::ATTR_DRIVER_NAME);
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }

    /**
     * Get Database Instance
     *
     * @param string|null $dbname
     * @return Database
     */
    public static function instance(?string $dbname = null): Database
    {
        if ($dbname === null) {
            $dbname = 'main'; // default config
        }
        self::$instance = new Database($dbname);
        return self::$instance;
    }

    /**
     * Pagination method (chainable)
     *
     * @param int $records_per_page
     * @param int $page
     * @return Database
     */
    public function pagination(int $records_per_page, int $page): Database
    {
        $offset = ($page - 1) * $records_per_page;
        $this->limit = ' LIMIT '.$offset.', '.$records_per_page;

        return $this;
    }

    /**
     * Limit method (chainable)
     *
     * @param int $limit
     * @param int|null $end
     * @return Database
     */
    public function limit(int $limit, ?int $end = null): Database
    {
        $driver = $this->driver;
        if ($end === null) {
            switch ($driver) {
                case 'mysql':
                case 'pgsql':
                case 'sqlite':
                    $this->limit = " LIMIT $limit";
                    break;
                case 'sqlsrv':
                    $this->limit = " OFFSET 0 ROWS FETCH NEXT $limit ROWS ONLY";
                    break;
            }
        } else {
            switch ($driver) {
                case 'mysql':
                    $this->limit = " LIMIT $limit, $end";
                    break;
                case 'pgsql':
                case 'sqlite':
                    $this->limit = " LIMIT $end OFFSET $limit";
                    break;
                case 'sqlsrv':
                    $this->limit = " OFFSET $limit ROWS FETCH NEXT $end ROWS ONLY";
                    break;
            }
        }

        return $this;
    }

    /**
     * Reset queries
     */
    private function resetQuery(): void
    {
        $this->table = null;
        $this->columns = null;
        $this->sql = null;
        $this->bindValues = [];
        $this->limit = null;
        $this->offset = null;
        $this->orderBy = null;
        $this->groupBy = null;
        $this->having = null;
        $this->getSQL = null;
        $this->where = null;
        $this->join = null;
        $this->rowCount = 0;
        $this->lastIDInserted = 0;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->db = null;
    }
}
