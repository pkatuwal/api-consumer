# Api Consumer

### Basic Syntax
```php
Api::consume('ebill')
    ->via('customers/pramodk_home/documents')
    ->with([
        'headers'=>'all_http_headers',
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
        +   Second parameter: <i>if second param is **true**, first param must be method name defined inside your services Folder's class</i>

3.  **with**

    Includes all parameter including headers, payload, query string and method name

4.  **notify**

    Alert developer on error

5.  **on**

    Action on error, return code with message else message only

6.  **superChargedBy**

    Its advance method to keep your response on cache with defined cache name and time. It pick default cache Setting from your env

7.  **conversion** method
    +   **toArray**
    +   **toJson**
    +   **toCollection**
    +   **toObject**
    +   **toSerialize**
    +   **toCsv**
    +   **toTable**


