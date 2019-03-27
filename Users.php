<?php
require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Users {
    protected $database;
    protected $dbname;

    /*
     * Constructor Load First
     * @param table name
     * */
    public function __construct($dbname){
        $this->dbname = $dbname ;

        $acc = ServiceAccount::fromJsonFile(__DIR__ . '/secret/php-tutorial-acb18-2508895cc8d3.json');
        $firebase = (new Factory)->withServiceAccount($acc)->create();
        $this->database = $firebase->getDatabase();
    }


    /*
    * Get Specific Data or ALl
    * @param id
    * */
    public function get(int $userID = NULL){
        if (empty($userID) || !isset($userID)) { return FALSE; }
        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
        } else {
            return FALSE;
        }
    }

    /*
    * Insert Data
    * @param data array
    * */
    public function insert(array $data) {
        if (empty($data) || !isset($data)) { return FALSE; }
        foreach ($data as $key => $value){
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }
        return TRUE;
    }


    /*
    * Delete Specific Data From Table
    * @param userid
    * */
    public function delete(int $userID) {
        if (empty($userID) || !isset($userID)) { return FALSE; }
        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
$customer   = new Users("customers");
$category   = new Users("categories");
$product    = new Users("products");

//var_dump($product->get(1));
//var_dump($product->delete(2));

//die;
/*
//Customer
var_dump($customer->insert([
    array('1',"Ariful Islam","Elenga, Tangail, Bangladesh",20),
    array('2',"Khayrul Islam","Dhalapara, Ghatail, Tangail, Bangladesh",22),
    array('3',"Shamim Al-Deen","Makrai, Ghatail, Tangail,Bangladesh",23),
    array('4',"Idris Ali","Dikpait, Sherpur, Bangladesh",24),
    array('5',"Jane Alam Mizan","Noakhali, Bangladesh",21)
]));


//product category
var_dump($category->insert([
    array('1',"Electronics"),
    array('2',"Kichen"),
    array('3',"Furniture"),
    array('4',"Garments"),
    array('5',"Men's Ware"),
    array('6',"Women's Ware"),
    array('7',"Bathroom Decorator"),
]));

//products
var_dump($product->insert([
    array('1',"1","Health Mug",20),
    array('2',"2","Usable Boul",80),
    array('3',"1","Kichen Towel",20),
    array('4',"4","Dish Washer",120),
]));

*/
for($i= 1; $i<=6; $i++)
{
    $product    = new Users("products".$i);

    var_dump($product->insert([
        array('1',"1","Health Mug",20),
        array('2',"2","Usable Boul",80),
        array('3',"1","Kichen Towel",20),
        array('4',"4","Dish Washer",120),
    ]));
}
