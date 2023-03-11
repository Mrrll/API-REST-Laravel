# API REST LARAVEL
**`Nota:` Instalamos de laravel 8 y configuramos la BD, tambien utilizaremos [Postman](https://www.postman.com/) para realizar las llamadas a las rutas de nuestra api.**

<a name="top"></a>

## Índice de contenidos

- [Creamos la tabla pacientes](#item1)
- [Creamos el seeder a la tabla pacientes](#item2)
- [Creamos el modelo y el controlador de pacientes](#item3)
- [Revertir migracion](#item4)
- [Guardar registros](#item5)
- [Traducir Mensajes de Validaciones](#item6)

<a name="item1"></a>

## Creamos la tabla pacientes ...

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

<a name="item2"></a>

## Creamos el seeder a la tabla pacientes ...

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
<a name="item3"></a>

## Creamos el modelo y el controlador de pacientes ...
### Creamos el modelo Paciente ...
>`Typee:` En Consola ...
```console
php artisan make:model Paciente
```
### Creamos el controlador Paciente ...
**`Nota:` Creamos el controlador dentro de una carpeta llamada `API` y indicamos que queremos la estructura para tener los metodos de una api de esta manera `API/PacienteController --api`  .**
>`Typee:` En Consola ...
```console
php artisan make:controller API/PacienteController --api
```
### Asignamos los campos masivos en el modelo ...
>`Abrimos:` el archivo `Paciente.php` que se encuentra en la carpeta `app\Models\Paciente.php` y en la clase `Paciente` escribimos lo siguiente ...
```php
    class Paciente extends Model
    {
        use HasFactory;
        protected $fillable = [
            'nombres',
            'apellidos',
            'edad',
            'sexo',
            'dni',
            'tipo_sangre',
            'telefono',
            'correo',
            'direccion'
        ];
    }
```
### Leer datos de los pacientes desde el controlador ...
>`Abrimos:` el archivo `PacienteController.php` que se encuentra en la carpeta `app\Http\Controllers\API\PacienteController.php` y en la funcion `index` escribimos lo siguiente ...
```php
    public function index()
    {
        return Paciente::all();
    }
```
**`Nota:` Importamos el modelo `Paciente` en el archivo `PacienteController.php`  .**
```php
use App\Models\Paciente;
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('pacientes',[PacienteController::class,'index']);
```
**`Nota:` Importamos el Controlador `PacienteController` en el archivo `api.php`  .**
```php
use App\Models\PacienteController;
```
**`Nota:` Para acceder a una ruta api  `http://127.0.0.1:8000/api/pacientes`.**

### Ocultar datos en la consulta ...
>`Abrimos:` el archivo `Paciente.php` que se encuentra en la carpeta `app\Models\Paciente.php` y en la clase `Paciente` escribimos lo siguiente ...
```php
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
```
[Subir](#top)
<a name="item4"></a>

## Revertir migracion ...
**`Nota:` Podemos modificar la tabla y con la siguente instruccion revertimos la migracion `php artisan migrate:refresh` y con los parametros adicionales `--path=database/migrations/####_##_##_######_create_pacientes_table.php` para que solo nos revierta una tabla en concreto y `--seed` nos haga el seeder de la misma.**
>`Typee:` En Consola ...
```console
php artisan migrate:refresh --path=database/migrations/####_##_##_######_create_pacientes_table.php --seed
```
### Añdimos contenido al seeder ...
>`Abrimos:` el archivo `PacienteSeeder.php` que se encuentra en la carpeta `database\seeders\PacienteSeeder.php` y en la funcion `run` añadimos a cada paciente los created_at y update_at con formato escribimos lo siguiente ...
```php
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d')
```
### Modificamos la zona horaria de la app ...
>`Abrimos:` el archivo `app.php` que se encuentra en la carpeta `config\app.php` y en `timezone` añadimos nuestra zona horaria [Listado de Zonas horarias](https://www.php.net/manual/es/timezones.php) `ej:Europe/Madrid` ...
```php
'timezone' => 'Europe/Madrid',
```
[Subir](#top)
<a name="item5"></a>

## Guardar registros ...

### Creamos un Request ...
**`Nota:` El Request sirve para poder controlar la verificacion de los datos .**
>`Typee:` En Consola ...
```console
php artisan make:request GuardarPacienteRequest
```
>`Abrimos:` el archivo `GuardarPacienteRequest.php` que se encuentra en la carpeta `app\http\Requests\GuardarPacienteRequest.php` y en la funcion `authorize` escribimos lo siguiente ...
```php
    public function authorize()
    {
        return true;
    }
```
>Y en la funcion `rules` escribimos lo siguiente ...
```php
    public function rules()
    {
        return [
            "nombres" => "required",
            "apellidos" => "required",
            "edad" => "required",
            "sexo" => "required",
            "dni" => "required|unique:pacientes,dni",
            "tipo_sangre" => "required",
            "telefono" => "required",
            "correo" => "required",
            "direccion" => "required"
        ];
    }
```
**`Nota:` Las regla de validacion [Lista de Validaciones](https://laravel.com/docs/8.x/validation#available-validation-rules) .**

### Configuramos el metodo para guardar registros.
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `store` escribimos lo siguiente ...
```php
    public function store(GuardarPacienteRequest $request)
    {
        Paciente::create($request->all());
        return response()->json([
            'res' => true,
            'msg' => 'Paciente Guardado Correctamente'
        ]);
    }
```
**`Nota:` Importamos el Request `GuardarPacienteRequest` en el archivo `PacienteControler.php`  .**
```php
use App\Http\Requests\GuardarPacienteRequest;
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('pacientes',[PacienteController::class,'index']);
    Route::post('pacientes',[PacienteController::class,'store']);
```
[Subir](#top)
<a name="item6"></a>

## Traducir Mensajes de Validaciones ...
**`Nota:` Utilizaremos archivos de un repositorio en GitHub para hacer las traducciones [Link de Github Traducciones](https://github.com/Laraveles/spanish), Agradecimientos por el reporte de github que nos ofre IsraelOrtuno.**
>`Abrimos en el repositorio:` el archivo `validation.php` que se encuentra en la carpeta `resources\lang\es\validation.php` y en nuestra app creamos una carperta llamada `es` en `resources\lang\` y dentro creamos el archivo `validation.php` y pegamos el codigo del archivo del repositorio de GitHub ...
>`Abrimos:`el archivo `app.php` que se encuentra en la carpeta `config\app.php` y añadimos en `locale` la abreviatura `es`.
```php
'locale' => 'es',
```
**`Nota:` Esto es para traducir al español nuestra app.**
**`Nota:` Traducir al español el menssage interno de la validacion.**
>`Abrimos:`el archivo `Handler.php` que se encuentra en la carpeta `app\Exceptions\Handler.php` y añadimos lo siguente al final del documento.
```php
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => __('Los datos proporcionados no son válidos.'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }
```
**`Nota:` Importamos la clase `ValidationException` en el archivo `Handler.php`  .**
```php
use Illuminate\Validation\ValidationException;
```
[Subir](#top)
