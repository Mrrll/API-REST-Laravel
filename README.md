# API REST LARAVEL
**`Nota:` Instalamos de laravel 8 y configuramos la BD.**

## Índice de contenidos

<a name="top"></a>

- [Creamos la tabla pacientes](#item1)
- [Creamos el seeder a la tabla pacientes](#item2)

## Creamos la tabla pacientes ...
<a name="item1"></a>

>`Typee:` En Consola ...
```console
php artisan make:migration create_pacientes_table
```
### Creamos los campos de la tabla pacientes ...
>`Abrimos:` el archivo `####_##_##_######_create_pacientes_table.php` que se encuentra en la carpeta `database\migrations` y en la funcion `up` escribimos lo siguiente ...
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
[Subir](#top)

## Creamos el seeder a la tabla pacientes ...
<a name="item2"></a>

>`Typee:` En Consola ...
```console
php artisan make:seeder PacienteSeeder
```
### Ingresar registros a la tabla pacientes ...
>`Abrimos:` el archivo `PacienteSeeder.php` que se encuentra en la carpeta `database\seeders` y en la funcion `run` escribimos lo siguiente ...
```php
    public function run()
    {
        DB::table('pacientes')->insert([
        	[
	        	'nombres' => 'Alex Oscar',
	        	'apellidos' => 'Gamarra Solis',
	        	'edad' => 28,
	        	'sexo' => 'Masculino',
	        	'dni' => 70218511,
	        	'tipo_sangre' => 'A+',
	        	'telefono' => 943124351,
	        	'correo' => 'alex@gmail.com',
	        	'direccion' => 'Jr. Ramón Castilla 110'
        	],
        	[
	        	'nombres' => 'María Perla',
	        	'apellidos' => 'Saruc Main',
	        	'edad' => 34,
	        	'sexo' => 'Femenino',
	        	'dni' => 80218522,
	        	'tipo_sangre' => 'A-',
	        	'telefono' => 952312435,
	        	'correo' => 'maria@gmail.com',
	        	'direccion' => 'Jr. Manuel Ruíz 230'
        	],
        	[
	        	'nombres' => 'Julio Ramón',
	        	'apellidos' => 'Quiroga Hasher',
	        	'edad' => 52,
	        	'sexo' => 'Masculino',
	        	'dni' => 23219913,
	        	'tipo_sangre' => 'A+',
	        	'telefono' => 977123331,
	        	'correo' => 'julio@gmail.com',
	        	'direccion' => 'Jr. Enrique Palacios 202'
        	],
        	[
        		'nombres' => 'Mario Idalgo',
				'apellidos' => 'Cuerbo Nieto',
				'edad' => 18,
				'sexo' => 'Masculino',
				'dni' => 80218511,
				'tipo_sangre' => 'B+',
				'telefono' => 932112351,
				'correo' => 'mario@gmail.com',
				'direccion' => 'Jr. Manuel Ruiz 800'
        	],
        	[
        		'nombres' => 'María Rosa',
        		'apellidos' => 'Jara Uri',
				'edad' => 40,
				'sexo' => 'Femenino',
				'dni' => 62215777,
				'tipo_sangre' => 'AB+',
				'telefono' => 951774351,
				'correo' => 'maría@gmail.com',
				'direccion' => 'Jr. Ramón Castilla 401'
        	],
        	[
        		'nombres' => 'Kevin Juan',
				'apellidos' => 'Rodriguez Ezquivel',
				'edad' => 49,
				'sexo' => 'Masculino',
				'dni' => 78218555,
				'tipo_sangre' => 'A+',
				'telefono' => 934994351,
				'correo' => 'kevin@gmail.com',
				'direccion' => 'Jr. Alfonso Ugarte 2020'
        	],
        	[
        		'nombres' => 'Cielo Celeste',
				'apellidos' => 'Lázaro Peterson',
				'edad' => 50,
				'sexo' => 'Femenino',
				'dni' => 23888591,
				'tipo_sangre' => 'A-',
				'telefono' => 971661152,
				'correo' => 'cielo@gmail.com',
				'direccion' => 'Jr. Francisco Bolognesi'
        	]
        ]);
    }
```
**`Nota:` Importamos la clase `DB` en el archivo `PacienteSeeder.php`  .**
```php
use Illuminate\Support\Facades\DB;
```

### Creamos la llamada al seeder Paciente para su ejecucion ...
>`Abrimos:` el archivo `DatabaseSeeder.php` que se encuentra en la carpeta `database\seeders` y en la funcion `run` escribimos lo siguiente ...
```php
    public function run()
    {
        $this->call(PacienteSeeder::class);
    }
```
### Ejecutamos el seeder Paciente ...
>`Typee:` En Consola ...
```console
php artisan db:seed
```
[Subir](#top)
