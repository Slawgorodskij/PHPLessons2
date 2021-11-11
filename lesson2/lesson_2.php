<?php
/*
1. Создать структуру классов ведения товарной номенклатуры.
   a) Есть абстрактный товар;
   b) Есть цифровой товар, штучный физический товар и товар на вес;
   c) У каждого есть метод подсчета финальной стоимости;
   d) У цифрового товара стоимость постоянная.
      У штучного товара стоимость зависит от количества штук,
      у весового – в зависимости от продаваемого количества в килограммах.
      У всех формируется в конечном итоге доход с продаж.
Что можно вынести в абстрактный класс, наследование?

*/

abstract class Product
{
    const PROFIT_PERCENT = 30;
    static protected $revenueFromSales = 0;
    protected $name;
    protected $image;
    protected $description;
    protected $price;

    public function __construct($name, $image, $description, $price)
    {
        self::setName($name);
        self::setImage($image);
        self::setDescription($description);
        self::setPrice($price);
    }

    abstract function costGoods();

    abstract function calcRevenueFromSales();

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
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

    public function renderProduct()
    {
        echo "<figure'>
               <img src='$this->image' alt='$this->name'>
            <figcaption>
               <h2>$this->name</h2>
               <p>$this->description</p>   
               <h2>$ $this->price</h2>         
            </figcaption>
         </figure>";
    }
}


class Ebook extends Product
{
    const PRICE = 15;
    protected $format;
    protected $author;
    protected $genreBook;
    protected $publishingHouse;

    public function __construct($name, $image, $description, $author, $genreBook, $publishingHouse, $format)
    {
        parent::__construct($name, $image, $description, $price = self::PRICE);
        self::setAuthor($author);
        self::setGenreBook($genreBook);
        self::setPublishingHouse($publishingHouse);
        self::setFormat($format);
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format): void
    {
        $this->format = $format;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function getGenreBook()
    {
        return $this->genreBook;
    }

    public function setGenreBook($genreBook): void
    {
        $this->genreBook = $genreBook;
    }

    public function getPublishingHouse()
    {
        return $this->publishingHouse;
    }

    public function setPublishingHouse($publishingHouse): void
    {
        $this->publishingHouse = $publishingHouse;
    }

    function costGoods()
    {
        return $this->price;
    }

    function calcRevenueFromSales()
    {
        return parent::$revenueFromSales += ($this->costGoods() * Product::PROFIT_PERCENT / 100);
    }

    public function renderEbook()
    {
        echo "<p>format: $this->format</p>
              <h2> $this->author</h2>
              <p>genre of the book: $this->genreBook</p>
              <h3>Publishing House: $this->publishingHouse </h3>";
        parent::renderProduct();
    }
}

$product1 = new Ebook('Vingt mille lieues sous les mers', 'https://picsum.photos/250/250',
    'The novel tells about the adventures of Captain Nemo on the Nautilus 
                            submarine built by him — a technological miracle of the time described. 
                            The story is told in the first person, according to the professor of 
                            the Museum of Natural History Pierre Aronnax, one of the accidental 
                            passengers of this submarine.', 'Jules Gabriel Verne',
    'science fiction', 'Librairie Hachette', 'fb2');

$product1->renderEbook();
echo $product1->calcRevenueFromSales() . PHP_EOL;


class Books extends Ebook
{
    protected $count;

    public function __construct($name, $image, $description, $author, $genreBook, $publishingHouse, $format, $count)
    {
        $price = parent::PRICE;
        parent::__construct($name, $image, $description, $author, $genreBook, $publishingHouse, $format, $price);
        self::setCount($count);
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count): void
    {
        $this->count = $count;
    }

    function costGoods()
    {
        return $this->price * 2 * $this->count;
    }

    function calcRevenueFromSales()
    {
        return parent::$revenueFromSales += ($this->costGoods() * Product::PROFIT_PERCENT / 100);
    }

    public function renderBooks()
    {
        parent::renderEbook();
    }
}

$product2 = new Books('Vingt mille lieues sous les mers', 'https://picsum.photos/250/250',
    'The novel tells about the adventures of Captain Nemo on the Nautilus 
                            submarine built by him — a technological miracle of the time described. 
                            The story is told in the first person, according to the professor 
                            of the Museum of Natural History Pierre Aronnax, one of the accidental 
                            passengers of this submarine.', 'Jules Gabriel Verne',
    'science fiction', 'Librairie Hachette', 'book', 2);

$product2->renderBooks();
echo $product2->calcRevenueFromSales() . '<br>';
echo $product2->calcRevenueFromSales() . '<br>';


class Candies extends Product
{
    protected $weight;

    public function __construct($name, $image, $description, $price, $weight)
    {
        parent::__construct($name, $image, $description, $price);
        self::setWeight($weight);
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    function costGoods()
    {
        return $this->price * $this->weight;
    }

    function calcRevenueFromSales()
    {
        return parent::$revenueFromSales += ($this->costGoods() * Product::PROFIT_PERCENT / 100);
    }

    public function renderCandies()
    {
        parent::renderProduct();
    }
}

$product3 = new Candies('Daisies', 'https://picsum.photos/250/250', 'Fragrant fondant 
                        candies "Daisies" in chocolate glaze. A delicate vanilla-cream filling with an 
                        exquisite taste of creme brulee and a bright cognac aroma immerses in sweet 
                        bliss, the glaze pleasantly shades it with chocolate flavor, and shiny red 
                        and green wrappers give a festive atmosphere.', 3, 3);
$product3->renderCandies();
echo $product3->calcRevenueFromSales() . '<br>';


//2. *Реализовать паттерн Singleton при помощи traits.

trait ForSingleton
{
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

class Singleton
{
    private static Singleton|ForSingleton $instance;

    use ForSingleton;
}

$example1 = Singleton::getInstance();
$example2 = Singleton::getInstance();

var_dump($example1 === $example2);