# PHP Object-Oriented Programming Guide

## Table of Contents
- [Core Concepts](#core-concepts)
- [Basic OOP Elements](#basic-oop-elements)
- [Access Modifiers](#access-modifiers)
- [The Four Pillars](#the-four-pillars)
- [Advanced Concepts](#advanced-concepts)
- [Magic Methods](#magic-methods)
- [Namespaces & Autoloading](#namespaces--autoloading)
- [Design Patterns](#design-patterns)
- [Best Practices](#best-practices)
- [SOLID Principles](#solid-Principles)
- [Method Overloading in PHP](#Method-Overloading-in-PHP)
    

## Core Concepts

### Basic Terminology
- **Object-Relational Mapping (ORM)**:An Object-Relational Mapping (ORM)
     is a programming technique that converts data between incompatible type systems in object-oriented 
     programming languages and relational databases, creating a "virtual object database" 
     that can be used from within the programming language.
- **OOP (Object-Oriented Programming)**: A programming paradigm that organizes code into objects that contain data and code
- **Object**: An instance of a class that contains data and code
- **Class**: A blueprint for creating objects
- **Property**: A variable within a class (also called attribute)
- **Method**: A function within a class
- **Instance**: A specific object created from a class
- **Constructor**: Special method (`__construct()`) called when creating an object

### Operators
- **->** (Object Operator): Accesses object properties and methods
  ```php
  $user->name;        // Accessing property
  $user->getName();   // Calling method
  .this;              // Refers to the current instance of a class within its own methods
  new:                //Creates a new instance of a class
  throw;              // Generates an exception to signal an error or exceptional condition
  ```
- **::** (Scope Resolution Operator): Accesses static members, constants
  ```php
  ClassName::CONSTANT;    // Accessing constant
  ClassName::$property;   // Accessing static property
  ClassName::method();    // Calling static method
  ```

## Basic OOP Elements

### Class Structure
```php
class User {
    // Properties
    private $id;
    private $name;
    
    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }
    
    // Method
    public function getName() {
        return $this->name;
    }
}
```

### Getters and Setters
Definition: Methods that control access to object properties
```php
class Product {
    private $price;
    
    // Getter
    public function getPrice() {
        return $this->price;
    }
    
    // Setter with validation
    public function setPrice($price) {
        if ($price >= 0) {
            $this->price = $price;
            return true;
        }
        return false;
    }
}
```

## Access Modifiers

### Public
Definition: Accessible from anywhere
```php
class Example {
    public $name = "Public Property";
    
    public function publicMethod() {
        return "Accessible everywhere";
    }
}
```

### Protected
Definition: Accessible within the class and its descendants
```php
class Parent {
    protected $data = "Protected Data";
    
    protected function protectedMethod() {
        return "Accessible in Parent and Child classes";
    }
}
```

### Private
Definition: Accessible only within the declaring class
```php
class Secure {
    private $secret = "Private Data";
    
    private function privateMethod() {
        return "Only accessible within this class";
    }
}
```

## The Four Pillars

### 1. Encapsulation
Definition: Bundling of data and methods that operate on that data within a single unit or object, 
while restricting direct access to some of the object's components.

Here's a detailed explanation
```php
class BankAccount {
    private $balance;
    
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return true;
        }
        return false;
    }
    
    public function getBalance() {
        return $this->balance;
    }
}
```

### 2. Inheritance
Definition: Mechanism for creating a class that is a specialized version of another class

```php
class Animal {
    protected $name;
    
    public function makeSound() {
        return "Some sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Woof!";
    }
}
```

### 3. Polymorphism
Definition: Aconcept where objects of different types can be treated uniformly, 
allowing a single interface to represent different underlying forms or behaviors.
```php
interface Shape {
    public function calculateArea();
}

class Circle implements Shape {
    private $radius;
    
    public function calculateArea() {
        return pi() * $this->radius ** 2;
    }
}

class Square implements Shape {
    private $side;
    
    public function calculateArea() {
        return $this->side ** 2;
    }
}
```

### 4. Abstraction
Definition: Hiding complex implementation details and showing only necessary features
```php
abstract class Database {
    abstract public function connect();
    abstract public function query($sql);
    
    public function beginTransaction() {
        // Common implementation
        return "Transaction started";
    }
}
```

## Advanced Concepts

### Interfaces
Definition: Contracts that define what methods a class must implement
```php
interface Printable {
    public function print();
    public function getFormat();
}

class Document implements Printable {
    public function print() {
        return "Printing document";
    }
    
    public function getFormat() {
        return "PDF";
    }
}
```

### Traits
Definition: Mechanism for code reuse in single inheritance languages
```php
trait Loggable {
    public function log($message) {
        return date('Y-m-d H:i:s') . ": $message";
    }
}

class User {
    use Loggable;
}
```

### Static Members
Definition: Properties and methods that belong to the class itself, not instances
```php
class Config {
    private static $settings = [];
    
    public static function set($key, $value) {
        self::$settings[$key] = $value;
    }
    
    public static function get($key) {
        return self::$settings[$key] ?? null;
    }
}
```

## Magic Methods

### Overview
Magic methods are special methods that override PHP's default behavior for certain actions.

### Common Magic Methods
```php
class MagicExample {
    private $data = [];
    
    // Called when creating object
    public function __construct() {
        echo "Object created";
    }
    
    // Called when reading inaccessible properties
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    // Called when writing to inaccessible properties
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    // Called when checking if property exists
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    // Called when converting object to string
    public function __toString() {
        return json_encode($this->data);
    }
}
```
## Method Overriding and Overloading

### Method Overriding
Definition: Redefining a parent class method in a child class with the same signature

```php
class Vehicle {
    public function getSpeed() {
        return "Vehicle speed";
    }
    
    public function start() {
        return "Vehicle starting";
    }
}

class Car extends Vehicle {
    // Method overriding
    public function getSpeed() {
        return "Car speed: 100 km/h";
    }
    
    // Method overriding with parent call
    public function start() {
        return parent::start() . " - Car engine starting";
    }
}

$car = new Car();
echo $car->getSpeed(); // the output will be "Car speed: 100 km/h"
```

### Method Overloading in PHP
Definition:Method Overloading is a concept where a class can have multiple methods with the same name but with different parameters.
However, PHP doesn't support traditional method overloading like other languages (such as Java or C++) do.
Instead, PHP provides a way to simulate method overloading using magic methods.

```php
class Calculator {
    // Simulating method overloading using __call
    public function __call($name, $arguments) {
        if ($name === 'add') {
            return $this->handleAdd($arguments);
        }
    }
    
    private function handleAdd($arguments) {
        switch (count($arguments)) {
            case 1:
                return $arguments[0];
            case 2:
                return $arguments[0] + $arguments[1];
            case 3:
                return $arguments[0] + $arguments[1] + $arguments[2];
            default:
                return array_sum($arguments);
        }
    }
}

$calc = new Calculator();
echo $calc->add(1);        // Returns: 1
echo $calc->add(1, 2);     // Returns: 3
echo $calc->add(1, 2, 3);  // Returns: 6
```

### Real-world Example Combining Overriding and Polymorphism
```php
interface Logger {
    public function log($message);
}

class FileLogger implements Logger {
    public function log($message) {
        return "Writing to file: $message";
    }
}

class DatabaseLogger implements Logger {
    public function log($message) {
        return "Writing to database: $message";
    }
}

class Application {
    private $logger;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function doSomething() {
        $this->logger->log("Action performed");
    }
}

// Usage
$app1 = new Application(new FileLogger());
$app2 = new Application(new DatabaseLogger());
```


## Namespaces & Autoloading

### Namespaces
Definition: A namespace is a container or context that holds a set of unique identifiers (names)
 for variables, functions, classes, and other objects, ensuring each name is uniquely identified within that specific scope. 
It provides a way to organize and manage code by preventing naming conflicts and creating logical separations.

```php
namespace App\Models;

class User {
    // Class implementation
}

// Usage
use App\Models\User;
$user = new User();
```

### Autoloading
Definition: Automatically loads class files on-demand when they are first referenced,
eliminating the need for manual inclusion of class files and improving code organization and performance.
```php
// composer.json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}

// Usage
require_once 'vendor/autoload.php';
use App\Models\User;
```

## Design Patterns

### Singleton
Definition: Ensures a class has only one instance
```php
class Singleton {
    private static $instance = null;
    
    private function __construct() {}
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
```

### Factory
Definition: Creates objects without explicitly specifying their exact classes
```php
interface Animal {
    public function makeSound();
}

class Dog implements Animal {
    public function makeSound() {
        return "Woof!";
    }
}

class AnimalFactory {
    public static function createAnimal($type) {
        switch ($type) {
            case 'dog':
                return new Dog();
            // Add more animals
        }
    }
}
```

### MVC (Model-View-Controller)
Definition: Separates application logic into three interconnected components
```php
// Model: Handles data and business logic
class UserModel {
    public function getUserData($id) {
        // Database interaction logic
        return [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
    }
}

// View: Handles presentation
class UserView {
    public function renderProfile($userData) {
        echo "Profile Page\n";
        echo "Name: " . $userData['name'] . "\n";
        echo "Email: " . $userData['email'] . "\n";
    }
}

// Controller: Manages flow and user interactions
class UserController {
    private $model;
    private $view;

    public function __construct(UserModel $model, UserView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function showProfile($userId) {
        $userData = $this->model->getUserData($userId);
        $this->view->renderProfile($userData);
    }
}

// Usage
$model = new UserModel();
$view = new UserView();
$controller = new UserController($model, $view);
$controller->showProfile(1);
```


## Best Practices

### Method Chaining
```php
class QueryBuilder {
    public function select(): self {
        return $this;
    }
    
    public function where(): self {
        return $this;
    }
}
```

### Error Handling
```php
try {
    $user->save();
} catch (DatabaseException $e) {
    // Handle database errors
} catch (Exception $e) {
    // Handle other errors
}
```



### Documentation
```php
/**
 * Processes an order
 *
 * @param Order $order The order to process
 * @return bool Success status
 * @throws OrderException If processing fails
 */
public function processOrder(Order $order): bool {
    // Implementation
}
```