#### 6. Namespacing and Autoloading

Epsiode 5에서 작성한 Person, Business, Staff 클래스를 단일 파일로 ungrouping 하도록 하자(1 class per file)

- \src\Person.php
- \src\Business.php
- \src\Staff.php

새로운 디렉토리를 생성하여 각 클래스 별로 파일을 만든 후에 클래스를 호출하는 가장 기본적인 방법은 다음과 같음. 하지만 아래의 방법은 준비하는데 시간이 많이 걸릴 뿐더러 효과적인 방법이 아님.

```php
<?php

require 'src/Person.php';
require 'src/Business.php';
require 'src/Staff.php';

  
$harry = new Person('harry lee');
$staff = new Staff([$harry]);
$laracasts = new Business($staff);

$laracasts->hire(new Person('Ron Wizlie'));

var_dump($staff);
var_dump($laracasts->getStaffMembers());
```



클래스를 Autoloading 하는 방법을 이용할 수 있음. => `composer` 사용 

루트 디렉토리에 composer.json 생성 (파일안에는 어떠한 dependency도 선언할 필요는 없음)  

```php
// composer.json
{
  
}
```



 `composer install` 을 진행하면 vendor 디렉토리가 생성된 것을 알 수 있음. 이후 composer.json에서 autoload 관련 dependecy를 선언

```php
{
  "autoload": {
    "psr-4": {
      "Acme\\": "src"
    }
  }
}
```



src 디렉토리 내 클래스 파일에 각각 namespace 설정한 후 `composer dump-autoload`  입력을 하면 \composer\autoload_psr4.php에 코드가 추가된 것을 알 수 있음.

```php
// Person.php
<?php

namespace Acme;

// autoload_psr4.php

<?php

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Acme\\' => array($baseDir . '/src'),
);
```



autoloading 설정이 완료되었으므로 base 파일로 돌아가 Acme\를 앞에 붙여주며 클래스를 호출 하면됨. 

```php
<?php

$harry = new Acme\Person('harry lee');
$staff = new Acme\Staff([$harry]);
$laracasts = new Acme\Business($staff);
$laracasts->hire(new Acme\Person('Ron Wizlie'));

var_dump($laracasts->getStaffMembers());
```



그러나 아직까지 에러가 발생함. 

> PHP Fatal error:  Uncaught Error: Class 'Acme\Person' not found in ...

that's because we have an autoloading component, but we haven't yet pulled it into a project. for most frameworks and packages, usually that would be done at the entry point.

for example, index.php would require autoaloading. you only have to do that once for the whole project. 

=> `require 'vendor/autoloading.php` 입력

구조를 좀 더 클린하게 바꾸기 위해 index.php를 만들고 autoloading과 클래스를 호출하는 파일을 import 하자. ex.php에서는 클래스 앞에 붙여진 Acme\를 제거하고 파일 상단에 `use` 로 대체.

```php
// index.php
<?php

require 'vendor/autoload.php';
require 'ex.php';

// ex.php
<?php

use Acme\Person;
use Acme\Staff;
use Acme\Business;

$harry = new Person('harry lee');
$staff = new Staff([$harry]);
$laracasts = new Business($staff);
$laracasts->hire(new Person('Ron Wizlie'));


var_dump($laracasts->getStaffMembers());
```



현재, 이렇게 구조를 바꿨음에도 불구하고, Staff.php의 `add`  메서드의 파라미터에 Person을 그대로 쓸수 있는 것은 동일한 namespace를 공유하고 있기 때문임. 

만약에 src 디렉토리 내에 Users 디렉토리를 생성한 후 Person.php를 집어넣는다면 에러가 발생함. 네임스페이스는 디렉토리 구조를 반드시 따라야함. 아울러, Person 클래스를 파라미터로 받고 있는 Business와 staff는 Person 클래스가 동일한 네임스페이스를 공유하고 있지 않으므로 클래스를 따로 export 해줘야함. 

```php
// Users\Person.php
namespace Acme\Users;

// Business.php
use Acme\Users\Person;

// Staff.php
use Acme\Users\Person;

// ex.php
use Acme\Users\Person;
```



Summary

1. composer.json - reference that you are going to use "psr-4" autolading.
   1. as the key, you specify your root namespace  (corresponding to your product)
   2. as its value, you specify what directory should be associated with root namespace.
2. Person.php is in Users directory, thus change the namespace as `namespace Acme\Users;` 
3. if you follow this convention, remember to require autoloader at some point of your project 



#### 7. Statics and Constants

간단하게 들어온 숫자들의 합을 구하는 메소드를 구현해보도록 하자.

```php
 <?php

// option 1
class Math {
    public function add()
    {
        return array_sum(func_get_args());
    }
}

// option 2. applicable for recent version of PHP
class Math {
    public static function add(...$nums)
    {
        return array_sum($nums);
    }
}

$math = new Math;

var_dump($math->add(1, 2, 3, 4));
```



현재, `add` 메소드는 다른 클래스에서 호출하는 등 dynamic할 필요가 없음 (input을 받아서 계산 후 output을 반환하기만 하면 됨). 이처럼 dynamic 하지 않게 메소드를 구현하고 싶을 경우, 함수를 정의할 때  `static`  을 추가하면 됨. 

메서드를 호출할때는 `클래스명::메소드명` 으로 호출.  스태틱 메소드는 인스턴스를 생성하지 않고 바로 어디서든 사용이 가능함. 이러한 관점에서 볼 때, 스태틱 메소드는 `Global function ` 이라고 할 수 도 있음. 

만약 스태틱 메소드가 다른 클래스를 반환/호출하는 경우는 유지/테스트 하기에 매우 어려우므로 권장되는 방법이 아님.

```php
class Math {
    public static function add(...$nums)
    {
        return array_sum($nums);
    }
}

echo Math::add(1,2,3);
```



예시 2)

`Person` 이라는 클래스에 프로퍼티 `$age` 를 스태틱하게 1로 정의해보도록 하자. 이론적으로 문제 없이 동작하나, 객체 & 클래스의 관점에서 볼 때는 적절하지 못함. "사람" 이라는 클래스를 만들었다면 모든 사람들이 동일한 나이를 Share(=static) 한다는 것은 적절하지 않음.

```php
class Person {
    public static $age = 1;

}

echo Person::$age;
```



또한, 아래의 예시에서도 문제가 생길 수 있음. 스태틱 프로퍼티인 `$age` 를 1씩 증가시키는 `haveBirthday` 메소드를 구현하고, `harry` 와 `ron` 의 나이를 개별적으로 증가시켜보자. 우리는 `harry` 는 해당 메소드를 2번 호출하여 3이라는 값을 갖게 하고  `ron` 은 한번만 호출하여 2이라는 값을 갖게 하고 싶음. 그러나 스태틱 프로퍼티는 특정 오브젝트에만 할당되는 것이 아니라 공유되기 때문에 `ron` 의 나이는 4라는 값을 갖게 된다 => break encapsulation

```php
class Person {
    public static $age = 1;

    public function haveBirthday()
    {
        static::$age += 1;
    }

}

$harry = new Person;
$harry->haveBirthday(); // 2
$harry->haveBirthday(); // 3

echo $harry::$age; // 3

$ron = new Person;
$ron->haveBirthday(); // expected 2 but returns 4

echo $ron::$age; // 4
```



스태틱 프로퍼티는 어떠한 경우에 사용 될 수 있을까? 인스턴스마다 개별적인 값을 가지지 않고 모든 인스턴스에게 동일하게 적용되는 값들에게 스태틱 프로퍼티를 적용할 수 있을 것이다 (예를 들어, 세율).

아래의 예시의 경우,  `tax` 는 `public` 으로 정의된 스태틱 프로퍼티이므로 값을 변경할 수 있다. 만약에 반드시 고정된 값을 가지며 값을 변하게 하기 위해서는  `priave` 으로 변경할 수 도 있지만, 다른 방법으로 `const` (상수)를 사용할 수 있음.

```php
class BankAccount {
    // public static $tax = .09;
  	// private static $tax = .09;
  	const TAX = 0.9;

}

// echo BankAccount::$tax = 1.5;
echo BankAccount::TAX;
```



마찬가지로, 스태틱 메소드 또한 전역으로 사용하며 인스턴스 생성 없이 바로 사용하기 위해 쓴다.



#### 8. Interfaces

Think of interface as contract.  인터페이스 안에서 실제 로직을 작성하지 않음. 인터페이스는 어떠한 term이 적용되어야 하는지를 작성하는 개념. 아래 예시에서 `Animal`  이라는 인터페이스 내에 "모든 동물은 의사소통을 한다" 라는 term을 적용시키기 위해 `communication` 함수를 작성하였음. 인터페이스는 실제 로직을 작성하지 않으므로 함수의 body( `{}` )를 입력하지 않음.

```php
interface Animal {
    public function communicate();

}
```



> we want to make sure that any implementation that we have will at this contract. on the other words, I want any type of animal to offer communicate method. 
>
> `Animal` 인터페이스를 implements 함으로써, 인터페이스(계약서)에 작성된 메서드 `communicate` 를 반드시 사용해야함.

인터페이스와 추상 클래스의 차이는 무엇?

```php
interface Animal {
    public function communicate();

}

class Dog implements Animal {
    public function communicate()
    {
        // TODO: Implement communicate() method.
        return 'bark';
    }
}

class Cat implements Animal {
    public function communicate()
    {
        // TODO: Implement communicate() method.
        return 'meow';
    }
}
```



로그 기능을 구현한다고 가정해보자. 로그에는 파일/데이터베이스/온라인 서비스 등 다양한 영역에 접근할 수 있음. 이에 따라 기본적인 클래스를 구현하면 다음과 같음. 그리고 로그 데이터에 접근 & 출력에 대한 로직을 구현하는 컨트롤러도 작성해보자.

```php
class LogToFile {
    public function execute($message)
    {
        var_dump('log the message to a file: '. $message);
    }
}

class LogToDatabase {
    public function execute($message)
    {
        var_dump('log the message to a database: '. $message);
    }
}


class UsersController {

    protected $logger;

  	// LogToFile 클래스를 하드코딩으로 파라미터에 입력
    public function __construct(LogToFile $logger)
    {
        $this->logger = $logger;
    }

    public function show()
    {
        $user = 'harrylee';

        // log this information
        $this->logger->execute($user);
    }
}

$controller = new UsersController(new LogToFile);

$controller->show();
```



이제, 회사의 보스가 말하길 "파일"에는 더이상 로깅하지 않으니 "데이터베이스"에 로깅하는 코드로 변경하라, 고 새로운 지시를 내렸다고 가정해보자. 이제 문제는 `LogToFile`  이라는 specific implementation을 하드코딩하여 여러 군 데 사용했다는 것임. (과장해서, 여러 어플리케이션에 적용했다고 가정) => 코드를 찾아서 일일이 다 변경해줘야함.

> *"The problem was that we were too specific. on another word, the problem was that we assumed an implementation. we didn't think the possibilty that it might be changed"*
>
>  **“Coding to interfaces, not implementation(concretion)”**

이 말은 위의 예시와 정확히 일치한다. 위의 예시에서  `UserController` 클래스의 생성자 메소드를 작성할 때 우리는 implementation(concrete class)을 사용하였음. 그리고 이것을 다른 것으로 변경해야할 때 broke down 되었음.

if there are ever classess or tasks or you could imgine having multiple implementations(multiple different message excuting this task/behavior, then that is a  sign that you need to create interface)

따라서 두개의 클래스를 인터페이스와 연결한 후, `UserController` 클래스의 생성자 메서드의 인자로 클래스가 아니라 인터페이스인 `Logger` 를 넘김.

```php
interface Logger {
    public function execute($message);

}

class LogToFile implements Logger {
    public function execute($message)
    {
        var_dump('log the message to a file: '. $message);
    }
} 

class LogToDatabase implements Logger {
    public function execute($message)
    {
        var_dump('log the message to a database: '. $message);
    }
}

class UsersController {

    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
```

인자로 인터페이스를 넘기는 것과 특정 클래스를 넘기는데는 커다란 차이가 있음.  

1. 클래스를 넘긴 경우, 유저 컨트롤러는 바깥 세상에 "기능이 동작하려면 이 특정 인스턴스가 필요해" 라고 말함.
2. 인터페이스를 넘긴 경우, 유저 컨트롤러는 "기능이 동작하려면 어떤 종류의 함수가 필요해. 정확히 어떤 클래스인지는 알 필요 없어. 너가 정해. 난 그냥 유저 컨트롤러를 동작할 때 어떤 functionality가 있기만 하면 돼!" 

이제 `LogToDatabase` 클래스로 일일이 하드하게 변경할 필요가 없으며 `UserController`  또한 그대로 둬도 됨. 그저 인스턴스를 생성할 때 `LogToDatabase` 를 호출하기만 하면 됨.

```php
$controller = new UsersController(new LogToFile);
$controller->show();

$controller = new UsersController(new LogToDatabase);
$controller->show();
```



```php
interface Repository {
    public function save($data);
}

class MongoRepository implements Repository {
    public function save($data)
    {

    }
}

class FileRepository implements Repository {
    public function save($data)
    {

    }
}
```

```php
interface CanBeFiltered {
    public function filter();
}

class Favorited implements CanBeFiltered{
    public function filter()
    {

    }
}

class Unwatched implements CanBeFiltered{
    public function filter()
    {

    }
}

class Difficulty implements CanBeFiltered{
    public function filter()
    {

    }
}
```



#### 9. Interfaces vs Abstract Classes

어플리케이션에서 Github으로 로그인하는 함수를 구현한다고 가정해보자. 다른 SNS(페이스북, 카카오톡) 등으로 로그인을 시도하기 전까지는 문제가 없음. 

```php
function login(GithubProvider, $provider)
{
    $provider->authorize();
}
```



위의 예시는 provider implementation을 하드코딩한 상태임. 만약 페이스북의 경우는? 혹은 카카오톡의 경우는? 분기문을 따로 작성하여 프로바이더의 종류에 따라 다르게 동작하도록 코드를 작성해야할까? 

이처럼 오브젝트의 타입을 체크해야하는 경우, 99%의 경우 you should be leveraging polymorphism(다형성). 다형성의 관점에서 접근하여, 우리는 특정한 클래스를 참조할 것이 아니라 인터페이스를 활용하여 코드를 재작성할 수 있음. 이 경우, `login` 함수는 더이상 어떠한 프로바이더가 오는지 신경쓸 필요가 없게 됨. (다형성)

```php
interface Provider {
    public function authorize();
}

function login(Provider $provider)
{
    $provider->authorize();
}
```

인터페이스는 퍼블릭 메소드만 정의 가능함. 이를 통해 어떠한 호출가능한 클래스는 인터페이스의 메소드를 호출 할 수 있게 됨.



추상 클래스는 인스턴스를 만들 수 없음. 대신 서브 클래스에서 상속받아 인스턴스를 생성 할 수 있음.

```php
abstract class Provider {

    abstract Protected function getAuthorizationUrl();

}

class FacebookProvider extends Provider{

    protected function getAuthorizationUrl()
    {

    }
}
```



PHP는 기본적으로 다중상속을 지원하지 않음.

- Interface defines public API. It defines contract that any implementation has to buy it. however No logic will ever be stored within interface.
- Abstract class, something is in common. I can enforce contract by creating abstract method. so, subclass must buy it. However we're also having result to inheritance.





#### 10. A Review

Src\AuthController 생성 - receiving Http request and return response.

Method Injection: if it is the only place that dependency is referenced, if it is single controller method, use method injection 

Constructor Injection: if you are going to reference this object in multiple places of your class, use constructdor injection.



