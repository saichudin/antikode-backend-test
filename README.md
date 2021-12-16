## ANTIKODE Backend Test
#### Build with PHP 7.4, Laravel 8, and MySQL 8

How to run :
- pull this repo
- open in IDE
- copy .env.example to .env
- set Database connection in .env file
- change ``APP_URL`` variable in .env to ``APP_URL=http://localhost:8000``
- run ``composer install``
- run ``php artisan key:generate``
- run ``php artisan migrate``
- run ``php artisan db:seed``
- run app use ``php artisan serve``

use API client such as Postman to test the RESTFul API

use this for RESTFul API documentation : https://documenter.getpostman.com/view/12200000/UVR8oSem#07e43f38-d296-48e1-933d-f17a88ba22ec

i also create GrahpQL API, but only for Brands data, here the query :

url : http://localhost:8000/graphql

- list all brand :
    ````
    {
      brands {
        id
        name
        logo
        banner
      }
    }
    ````
- find brand by id
    ````
    {
      brand(id: 1) {
        name
        logo
        banner
      }
    }
    ````
- mutation create brand
    ````
    mutation createBrand {
      createBrand(name: "PSD", logo: "logo-psd.jpg", banner: "banner-psd.jpg") {
        id
        name
        logo
        banner
      }
    }
    ````
- mutation update brand
    ````
    mutation updateBrand {
      updateBrand(
        id: 3
        name: "PSD-e"
        logo: "logo-psd.jpg"
        banner: "banner-psd.jpg"
      ) {
        id
        name
        logo
        banner
      }
    }
    ````
- mutation delete brand
    ````
    mutation deleteBrand {
      deleteBrand(id: 3)
    }
    ````

already tested using client [Firecamp](https://firecamp.io/graphql)
