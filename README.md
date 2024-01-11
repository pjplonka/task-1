# How to run
Requires php >= 8.1 and composer locally.  

Run db in docker:
`make init`
`make dev`

`bin/console doctrine:migrations:migrate`  
`symfony server:start`  
`php bin/phpunit`  

# API 

To create order:  
Request:
```
POST /orders
{
  "items": [
    {
      "id": 1, // product ID
      "quantity": 4
    },
    {
      "id": 2, // product ID
      "quantity": 1
    }
  ]
}
```
Response:
```
{
  "id": 8,
  "prices": {
    "netPrice": 43885,
    "vat": 10093,
    "grossPrice": 53978
  },
  "items": [
    {
      "product": {
        "id": 1,
        "name": "fdsa",
        "price": 321
      },
      "quantity": 2,
      "price": 321
    },
    {
      "product": {
        "id": 2,
        "name": "dgdfs",
        "price": 43243
      },
      "quantity": 1,
      "price": 43243
    }
  ]
}
```

To get order details:
Request:
``
Response:
```
GET /orders/1
{
  "id": 8,
  "prices": {
    "netPrice": 43885,
    "vat": 10093,
    "grossPrice": 53978
  },
  "items": [
    {
      "product": {
        "id": 1,
        "name": "fdsa",
        "price": 321
      },
      "quantity": 2,
      "price": 321
    },
    {
      "product": {
        "id": 2,
        "name": "dgdfs",
        "price": 43243
      },
      "quantity": 1,
      "price": 43243
    }
  ]
}
```

# Assumptions:
- Product missing fields: description, amount in stock
- Order missing fields: customer, comment, ordered_at, shipped_at, status
- Integer was used for prices storage - Money package should be used for calculations: https://github.com/moneyphp/money
- Order item should also contain prices (price could be changed meanwhile)
- Database product validator should be added to check if product is found by provided id in request
- Entities and properties - accessibility and readonly option should be checked
- `Order` and `Product` should use UUID instead of id
- Prices calculator should calculate every Order Item, not only Order