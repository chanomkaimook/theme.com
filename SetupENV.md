# Setup ENV
### - run composer command
> composer require vlucas/phpdotenv

### - create ENV file
* copy env.example from root project
* paste on root project and change name to **.env**
* custom data in **.env**

### - coding index.php
* open index.php on root project
* coding on first page like below

```
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
```