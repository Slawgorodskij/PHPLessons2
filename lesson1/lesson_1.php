<?php
/*
1. Придумать класс, который описывает любую сущность
 из предметной области интернет-магазинов:
 продукт, ценник, посылка и т.п.
2. Описать свойства класса из п.1 (состояние).
3. Описать поведение класса из п.1 (методы).
*/

class Product
{
    protected $id;
    protected $article;
    protected $name;
    protected $image;
    protected $description;
    protected $size;
    protected $color;
    protected $count;
    protected $price;

    public function __construct($id, $article, $name, $image, $description, $size, $color, $count, $price)
    {
        $this->id = $id;
        $this->article = $article;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->size = $size;
        $this->color = $color;
        $this->count = $count;
        $this->price = $price;
    }

    protected function productDiscount($discount)
    {
        return $this->price - ($this->price * $discount / 100);

    }

    public function renderInfoDiscount($discount)
    {
        $finPrice = $this->productDiscount($discount);
        echo " <p>There is a $discount discount for you</p>
               <p>Total cost: $
               <span>$finPrice</span>
               </p>";
    }

    public function renderProduct()
    {
        echo "<figure'>
               <img src='$this->image' alt='$this->name'>
            <figcaption>
               <h2>$this->name</h2>
               <p>$this->description</p>
               <p>Цвет:<span>$this->color</span></p>
               <p>Размер:<span>$this->size</span></p>             
               <h3>$ $this->price</h3>
            </figcaption>
         </figure>";
    }
}

$product1 = new Product(1, 1234, 'cardigan',
    'https://picsum.photos/250/250', 'a very necessary product',
    'XL', 'gray', 5, 52);

$product1->renderProduct();
$product1->renderInfoDiscount(10);

//4. Придумать наследников класса из п.1. Чем они будут отличаться?

class SaleProduct extends Product
{
    protected $yearCollection;
    protected $discount;
    protected $newPrice;

    public function __construct($id, $article, $name, $image, $description, $size,
                                $color, $count, $price, $yearCollection, $discount, $newPrice = ' ')
    {
        parent::__construct($id, $article, $name, $image, $description, $size, $color, $count, $price);
        $this->yearCollection = $yearCollection;
        $this->discount = $discount;
        $this->newPrice = parent::productDiscount($this->discount);
    }

    public function renderSaleProduct()
    {
        parent::renderProduct();
        echo "<p>the $this->yearCollection model</p>
              <p>discount: $this->discount</p>
              <h3>special price: $ $this->newPrice </h3>";
    }
}

$productSale1 = new SaleProduct(3, 4254, 'the Park',
    'https://picsum.photos/250/250', 'a very necessary product',
    'M', 'blue', 5, 45, 2019, 10);

$productSale1->renderSaleProduct();

/*
 5. Дан код:
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
*/

//Что он выведет на каждом шаге? Почему?
/*
    Так как статические свойства принадлежат классу, а не его экземплярам.
 то переменная "Х" будет увеличиваться на единицу и сохранять значение
 при каждом вызове функции  "foo" хоть экземпляром класса а1, хоть а2.
 Выведется 1234
 */

/*
 Немного изменим п.5:
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
*/
//6. Объясните результаты в этом случае.

/*
    Переменные $a1 и $b1 принадлежат разным классам,
 при этом class B наследует от class A function foo()
 в результате каждая переменная будет вызывать function foo()
 из "своего" класса (хоть и одну и туже функцию).
 Следовательно переменная "Х" будет увеличиваться на единицу
 для каждого экземпляра персонально.
   вывод: 1122
 */

/*
7. *Дан код:
class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A
{
}

$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
*/
/*
    Код отработает как и в предыдущей задаче: 1122.
 Отличие между ними в способе вызова.
 Если у класса нет конструктора,
 или его конструктор не имеет обязательных параметров,
 скобки после имени класса можно не писать.
 Конструктор класс А и наследуемый от него класс В не имеют.
*/