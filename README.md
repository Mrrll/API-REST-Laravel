# API REST LARAVEL
**`Nota:` Instalamos de laravel 8 y configuramos la BD.**
<a name="top"></a>

## Índice de contenidos

- [Creamos la tabla pacientes](#item1)

## Creamos la tabla pacientes ...
<a name="item1"></a>

>`Typee:` En Consola ...
```console
php artisan make:migration create_pacientes_table
```
### Creamos los campos de la tabla pacientes ...
>`Abrimos:` el archivo `####_##_##_######_create_pacientes_table` y en la funcion `up` escribimos lo siguiente ...
```php
public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('edad');
            $table->string('sexo');
            $table->string('dni',8)->unique();
            $table->string('tipo_sangre');
            $table->string('telefono',9);
            $table->string('correo');
            $table->string('direccion');
            $table->timestamps();
        });
    }
```
### Hacemos la migracion de la tabla a la BD ...

>`Typee:` En Consola ...
```console
php artisan migrate --path=database/migrations/####_##_##_######_create_pacientes_table.php
```
<a name="top"></a>
