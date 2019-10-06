# Uvinum -  Carrito de la compra

### Suposiciones

* Todos los precios están en euros.

### Notas

* El funcionamiento de las piezas se ha comprobado mediante tests unitarios.

## Estructua del código

### Dominio

#### `/src/Domain/Cart`

* `Cart.php`: Clase del carrito.
* `CartRepositoryInterface.php`: Interface que implementaran las clases que lean/escriban de base de datos.
* `Exceptions/*`: Excepciones relacionadas con el carrito.
* `Validations/*`: Validaciones relacionadas con el carrito:
    * Al añadir un producto, se pueden añadir un máximo de 10 productos diferentes.
    * Al añadir un producto, se pueden añadir un máximo de 50 unidades por producto.
    * Al borrar un producto, este debe estar en el carrito.

#### `/src/Domain/Product`

* `Product.php`: Clase de producto.
* `ProductRepositoryInterface.php`: Interface que implementaran las clases que lean/escriban de base de datos.
* `Exceptions/*`: Excepciones relacionadas con un producto.

#### `/src/Domain/Currency`

* `Currency.php`: Clase moneda.
* `CurrencyRepositoryInterface.php`: Interface que implementaran las clases que lean/escriban de base de datos.
* `Exceptions/*`: Excepciones relacionadas con una moneda.

#### `/src/Domain/Common`

* `Validator.php`: Clase para las validaciones.
* `ValidatorInterface.php`: Interface que deben implementar todas las validaciones.

### Aplicación (casos de uso)

#### Añadir producto

* `AddProduct.php`: Clase que ejecuta el caso de uso.
* `AddProductRequest.php`
* `AddProductResponse.php`
* `AddProductValidator.php`: Clase encargada de construir las validaciones para este caso de uso.

#### Eliminar producto

* `DeleteProduct.php`: Clase que ejecuta el caso de uso.
* `DeleteProductRequest.php`
* `DeleteProductResponse.php`
* `DeleteProductValidator.php`: Clase encargada de construir las validaciones para este caso de uso.

#### Calcular importe total del carrito - Cambio de divisa

Estos de casos de uso se han juntado en uno sólo. La parte relacionada con el cambio de divisa se ha realizado de la siguiente forma:

Por un lado, la realización de un comando a parte (`/command`) para la importación a la base de datos de los valores de la divisas (actualmente sólo imprime los resultados). Según el enlace enviado en la prueba, estos datos se actualizan una vez al día a las 16.00h. Bastaría con lanzar el comando una vez al día sobre esa hora para tener siempre los datos actualizados.
Por otro lado, se ha creado una interface para un repositorio para consultar los resultados (`/currency/CurrencyRepositoryInterface`).

* `CalculateImportProduct.php`: Clase que ejecuta el caso de uso.
* `CalculateImportProductRequest.php`: Tiene unos atributos para pedir el importe transformado a una divisa si se requiere.
* `CalculateImportProductResponse.php`: Dentro incluye el importe y el importe transformado a la divisa pedida.

### Otros

#### Acualizar valores de las monedas

* `command/src/UpdateCurrencyValuesCommand.php`: Consulta en la URL facilitada en el enunciado el precio actual de los datos. La idea sería que actualizase la base de datos una vez al día (actualmente sólo lo imprime por pantalla).

## Ejecución

```bash
$ composer tests # Ejecuta los tests unitarios
$ composer console:update-currency-values # Ejecuta el comando que actualizaría los datos en la base de datos.
```
