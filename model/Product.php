<?php


class Product
{
    private $conn;
    private $name;
    private $description;
    private $price;
    private $category_id;
    private $created;
    private $modified;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function setCreated()
    {
        $date = new DateTime();

        $this->created = $date->format('Y-m-d H:i:s');
    }

    private function setModified() {
        $date = new DateTime();
        $modified_timestamp = $date->format('Y-m-d H:i:s');

        $this->modified = $modified_timestamp;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getCategoryId()
    {
        return $this->category_id;
    }


    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }



    public function create () {

        $this->setCreated();

        $sql = "INSERT INTO products(name, price, description, created, category_id)
                VALUES('$this->name', $this->price, '$this->description', '$this->created', $this->category_id)";

        return $this->conn->exec($sql);

//        var_dump($sql);
    }

    function getAll() {
        $query = $this->conn->prepare("select products.*, 
                                        categories.name as category 
                                        from products
                                        inner join
                                        categories on
                                        products.category_id = categories.id");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteProduct($conn, $id) {
        $sql = "DELETE FROM products WHERE id=$id";
        $conn->exec($sql);
    }

    function getOne($id) {
        $query = $this->conn->prepare("SELECT * FROM products WHERE id = $id");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result[0];
    }

    function editProd($id) {
        $sql = "UPDATE products SET 
                name='$this->name', 
                price=$this->price, 
                description='$this->description',
                category_id = $this->category_id,
                modified = '$this->modified' 
                WHERE id=$id";

        $edit = $this->conn->exec($sql);
        return $edit;

    }
}