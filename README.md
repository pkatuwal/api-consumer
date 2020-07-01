# Api Consumer


This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require pramod/api-consumer
```

## Usage

Copy Config
```sh
php artisan vendor:publish --provider="Pramod\ApiConsumer\ApiConsumerServiceProvider" --tag="config"
``` 
If you are using **Lumen**
Copy Config
```bash
cp vendor/pramod/ApiConsumer/config/api-consumer.php config/
```
Autoload Config

```php
$app->configure('api-consumer');
```

``` php
// Register Service Provider
 $this->app->register(ApiConsumerServiceProvider::class);
```

<i>Please Refer Test Case For Complete Reference which is located in tests/ExampleTest.php</i>

### Basic Syntax
```php
Api::consume('ebill')
    ->via('customers/pramodk_home/documents')
    ->with([
        'headers'=>[
                    'Authorization'=>'xx',
                    'Content-Type'=>'',
                    'Accept'=>''
                    ],
        'method'=>'POST',
        'version'=>'v1',
        'payload'=>[
            'name'=>'name is here'
        ]
    ])
    ->superChargedBy([
        'cache'=>[
            'ttl'=>20,
            'key_prefix'=>'documents'
        ]
    ])
    ->toArray();
```

#### Descriptions
1. **consume**
    
    Request Or find Service Name mapped in config file having basic application url,version definitions.

2.  **via**

    This method is used to point service end or function name written in service Namespace
    +  Available Method
        +   first parameter: <i>Api endpoint or uri</i>
        +   ![Test](test.png) Second parameter: <i>if second param is **true**, first param must be method name defined inside your services Folder's class</i>

3.  **with**

    Includes all parameter including headers, payload, query string and method name

4.  ![Test](test.png) **notify**[proposed] 

    Alert developer on error

5.  ![Test](test.png) **on**[proposed]

    Action on error, return code with message else message only

6.  **superChargedBy**

    Its advance method to keep your response on cache with defined cache name and time. It pick default cache Setting from your env

7.  **conversion** method
    +   **toArray**
    +   **toJson**
    +   **toCollection**

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email pramodktwl@gmail.com instead of using the issue tracker.

## Credits

- [Pramod Katuwal](https://github.com/pramod)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).