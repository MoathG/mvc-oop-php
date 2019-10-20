<?php


class Category
{
    private $conn;
    private $name;
    private $created;

    /**
     * category constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated()
    {
        $date = new DateTime();

        $this->created = $date->format('Y-m-d H:i:s');
    }

    function create() {
        $this->setCreated();

        $sql = "INSERT INTO categories (name, created)
                VALUES ('$this->name', '$this->created')";

        return $this->conn->exec($sql);

    }

    function getAll() {
        $query = $this->conn->prepare("SELECT id, name, modified, created FROM categories");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteCategory($conn, $id) {
        $sql = "DELETE FROM categories WHERE id=$id";
        $conn->exec($sql);
    }

    function updateCategory() {

    }
}