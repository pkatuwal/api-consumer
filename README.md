# Api Consumer


This Package developed to request various external api without creating external service or traits.

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

## Define your custom settings[yml]
You can create your own config to manage and get proper visualization of endpoint used in your app.
1. Create Folder inside App eg, app/Consumers/covid.yml
    or you can create your own folder where you have to  separate **yml** as per your service name. 

2. Sample For yaml
```
filename:app/Consumers/covid.yml
```
```yaml
summary:
    uri: summary
    story: this is summary uri
countries:
    uri: countriesRoute
    story: All countries Route
```

    Where **uri** must be your request path and story for short descriptions or uri.



3.  Final Request
    
    Sample Code
    ```php
    //add second param on your via method

    //for static uri eg, canvasenx.com.np/users
    return Api::consume('covid19api')
        ->via('summary', true)
        ->toCollection();

    //for dynamic uri you must add your uri payload with value as
    return Api::consume('covid19api')
        ->via('countryDayOneRoute', [
            'country'=>'nepal'
        ])
        ->toCollection();
        
    ```
    Note: your configuration should look like this
    ```yml
    summary:
        uri: summary
        story: this is summary uri
    countries:
        uri: countriesRoute
        story: All countries Route
    countryDayOneRoute:
        uri: dayone/country/{country}
        story: Returns all cases by case type for a country from the first recorded case. Country must be the country_slug from /countries. Cases must be one of confirmed, recovered, deaths"
    ```

    Note: Your Dynamic uri must be covered with curly brackets {}.
4. Final Words for **Via** injections

    Adding **true** or **array** on second parameters will observe your custom class which is defined in config file as **custom_consumer** array file
    ```php
    'covid19api'=>[
        'baseUri'=>'https://api.covid19api.com/',
        'custom_consumer' => [
            'Consumers/covid'
        ],
        'timeout'=>10
    ]
    ``` 

# Monitor Your Request Log

You can monitor external call request, response and execution time which is stored as json format in your default log. **To activate log monitor** you should enable middleware on your application

```php
$app->middleware([
    Pramod\ApiConsumer\Middleware\LogRequestMiddleware::class
]);
```
#### Descriptions
1. **consume**
    
    Request Or find Service Name mapped in config file having basic application url,version definitions.

2.  **via**

    This method is used to point service end or function name written in service Namespace
    +  Available Method
        +   first parameter: <i>Api endpoint or uri</i>
        +   Second parameter: <i>if second param is **true**, first param must be method name defined inside your services Folder's class</i>

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

## HAPPY CODING :) 