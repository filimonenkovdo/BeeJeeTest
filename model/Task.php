<?php 

class Task 
{

    private static $pdo = null;
	
    /**
     * primary key 
     * @var int
     */
	private $id;
	
	/**
	 * true when task was modified by administrator, false by default
	 * @var boolead
	 */
	private $modified;
	
	/**
	 * true when task is solved? false by default 
	 * @var boolean
	 */
	private $solved;
	
	/**
	 * user name 
	 * @var string
	 */
    private $username;
    
    /**
     * user email
     * @var string
     */
	private $email;
	
	/**
	 * task description 
	 * @var string
	 */
	private $text;
	
	
	public static function getPdo()
	{		
		if (!self::$pdo) {
			self::$pdo = new \PDO('mysql:host=127.0.0.1;dbname=BeeJeeTest', 'root', '1234');
			if (!self::$pdo) {
				echo 'No database connection';
			}
		}
		return self::$pdo;
	}
	
	public function getId()
	{
		return $this->id;
	}

    public function getModified()
	{
		return $this->modified;
	}
	
    public function setModified($modified)
	{
		$this->modified = $modified;
		return $this;
	}
	
    public function getSolved()
	{
		return $this->solved;
	}
	
    public function setSolved($solved)
	{
		$this->solved = $solved;
		return $this;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
    public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}
	
    public function getEmail()
	{
		return $this->email;
	}
	
    public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

    public function getText()
	{
		return $this->text;
	}
	
    public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	/**
	 * return a list of task for one page or false if none
	 * @param int $limit
	 * @param int $offset
	 */
	public static function tasks($limit = 3, $offset = 0)
	{
		$pdo = self::getPdo();
		$sql = "SELECT * FROM task LIMIT $offset, $limit";
		$stm = $pdo->query($sql);
		$answer = $stm->fetchAll(\PDO::FETCH_CLASS, 'Task');
		return $answer;
	}

	/**
	 * return a number of all tasks
	 * @return int
	 */
	public static function countTask()
	{
		$pdo = self::getPdo();
		$sql = 'SELECT COUNT(id) FROM task';
		return intval($pdo->query($sql)->fetch(\PDO::FETCH_COLUMN, 0));
	}
	
	/**
	 * Insert new task to database 
	 */
	public function insert()
	{
		$pdo = self::getPdo();
		$sql = 'INSERT INTO task (`username`, `email`, `text`, `modified`, `solved`)' . 
			' VALUES (:username, :email, :text, false, false)';
		$stm = $pdo->prepare($sql);
		$stm->bindParam(':username', $this->getUsername());
		$stm->bindParam(':email', $this->getEmail());
		$stm->bindParam(':text', $this->getText());

		$answer = $stm->execute();
		return $answer;
	}
	
}
?>