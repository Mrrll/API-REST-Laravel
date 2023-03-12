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
- [Mostrar un registro](#item7)
- [Actualizar registro](#item8)
- [Eliminar registro](#item9)
- [Api resources](#item10)
- [Laravel Sanctum](#item11)

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
        ],200);
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
<a name="item7"></a>

## Mostrar un registro ...
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `show` escribimos lo siguiente ...
```php
    public function show(Paciente $paciente)
    {
        return response()->json([
            'res' => true,
            'paciente' => $paciente
        ],200);
    }
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('pacientes',[PacienteController::class,'index']);
    Route::post('pacientes',[PacienteController::class,'store']);
    Route::get('pacientes/{paciente}',[PacienteController::class,'show']);
```
**`Nota:` Cambiar el mensaje de la excepcion si no encuentra un registro.**
>`Abrimos:`el archivo `Handler.php` que se encuentra en la carpeta `app\Exceptions\Handler.php` y añadimos lo siguente al final del documento.
```php
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json(["res" => false, "error" => "Error modelo no encontrado"], 400);
        }
        return parent::render($request, $exception);
    }
```
**`Nota:` Importamos la clase `ModelNotFoundException` y `use Throwable;` en el archivo `Handler.php`  .**
```php
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
```
[Subir](#top)
<a name="item8"></a>

## Actualizar registro ...

### Creamos un Request ...
**`Nota:` El Request sirve para poder controlar la verificacion de los datos .**
>`Typee:` En Consola ...
```console
php artisan make:request ActualizarPacienteRequest
```
>`Abrimos:` el archivo `ActualizarPacienteRequest.php` que se encuentra en la carpeta `app\http\Requests\ActualizarPacienteRequest.php` y en la funcion `authorize` escribimos lo siguiente ...
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
            "dni" => "required|unique:pacientes,dni,".$this->route('paciente')->id,
            "tipo_sangre" => "required",
            "telefono" => "required",
            "correo" => "required",
            "direccion" => "required"
        ];
    }
```
**`Nota:` Para poder actualizar el campo Dni escribimos `"dni" => "required|unique:pacientes,dni,".$this->route('paciente')->id,` en la regla de validacion.**

>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `update` escribimos lo siguiente ...
```php
    public function update(ActualizarPacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return response()->json([
            'res' => true,
            "msg" => 'Paciente Actualizado Correctamente'
        ],200);
    }
```
**`Nota:` Importamos el Request `ActualizarPacienteRequest` en el archivo `PacienteControler.php`  .**
```php
use App\Http\Requests\ActualizarPacienteRequest;
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('pacientes',[PacienteController::class,'index']);
    Route::post('pacientes',[PacienteController::class,'store']);
    Route::get('pacientes/{paciente}',[PacienteController::class,'show']);
    Route::put('pacientes/{paciente}',[PacienteController::class,'update']);
```
[Subir](#top)
<a name="item9"></a>

## Eliminar registro ...
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `destroy` escribimos lo siguiente ...
```php
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json([
            'res' => true,
            "msg" => 'Paciente Eliminado Correctamente'
        ],200);
    }
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('pacientes',[PacienteController::class,'index']);
    Route::post('pacientes',[PacienteController::class,'store']);
    Route::get('pacientes/{paciente}',[PacienteController::class,'show']);
    Route::put('pacientes/{paciente}',[PacienteController::class,'update']);
    Route::delete('pacientes/{paciente}',[PacienteController::class,'destroy']);
```
[Subir](#top)
<a name="item10"></a>

## Api resources ...
### Refrescamos BD
**`Nota:` Refrescamos la tabla pacientes de la BD .**
>`Typee:` En Consola ...
```console
php artisan migrate:refresh --path=database/migrations/XXXX_XX_XX_XXXXXX_create_pacientes_table.php --seed
```
### Generando Recursos
**`Nota:` Nos permite estructurar la api y cambiar los formatos a las respuesta de los datos se llama `Capa de Transformacion` .**
>`Typee:` En Consola ...
```console
php artisan make:resource PacienteResource
```
>`Abrimos:` el archivo `PacienteResource.php` que se encuentra en la carpeta `app\http\Resource\PacienteResource.php` y en la funcion `toArray` escribimos lo siguiente ...
```php
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombres' => Str::of($this->nombres)->upper(),
            'apellidos' => Str::of($this->apellidos)->upper(),
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'dni' => $this->dni,
            'tipo_sangre' => $this->tipo_sangre,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'fecha_creada' => $this->created_at->format('d-m-Y'),
            'fecha_actualizada' => $this->updated_at->format('d-m-Y')
        ];
    }
```
**`Nota:` Importamos la clase `Str` en el archivo `PacienteResource.php`  .**
```php
use Illuminate\Support\Str;
```
**`Nota:` Metodos para modificar los formatos de los datos [Lista de Ayudantes](https://laravel.com/docs/8.x/helpers).**

**`Nota:` Importamos el Recurso `PacienteResource` en el archivo `PacienteControler.php`  .**
```php
use App\Http\Resources\PacienteResource;
```
### Cambiamos los metodos del controlador `PacienteController` para utilizar las capas de transformacion de recursos.
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `index` escribimos lo siguiente ...
```php
    public function index()
    {
        return PacienteResource::collection(Paciente::all());
    }
```
>En la funcion `store` escribimos lo siguiente ..
```php
    public function store(GuardarPacienteRequest $request)
    {
        return new PacienteResource(Paciente::create($request->all()));
    }
```
>En la funcion `show` escribimos lo siguiente ..
```php
    public function show(Paciente $paciente)
    {
        return new PacienteResource($paciente);
    }
```
>En la funcion `update` escribimos lo siguiente ..
```php
    public function update(ActualizarPacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return new PacienteResource($paciente);
    }
```
>En la funcion `destroy` escribimos lo siguiente ..
```php
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return new PacienteResource($paciente);
    }
```
### Devolver otra propiedad dentro del Recurso
>`Abrimos:` el archivo `PacienteResource.php` que se encuentra en la carpeta `app\http\Resource\PacienteResource.php` y al final del documento escribimos lo siguiente ...
```php
    public function with($request)
    {
        return [
            'res' => true,
        ];
    }
```
### Devolver otra propiedad dinamica dentro del Recurso
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `store` escribimos lo siguiente ..
```php
    return (new PacienteResource(Paciente::create($request->all())))->additional(['msg' => 'Paciente Guardado Correctamente']);
```
>Y en la funcion `update` escribimos lo siguiente ..
```php
    return (new PacienteResource($paciente))->additional(['msg' => 'Paciente Actualizado Correctamente']);
```
>Y en la funcion `destroy` escribimos lo siguiente ..
```php
    return (new PacienteResource($paciente))->additional(['msg' => 'Paciente Eliminado Correctamente'])
```
### Podemos cambiar el Status Code de la respuesta
>`Abrimos:` el archivo `PacienteControler.php` que se encuentra en la carpeta `app\http\Controllers\PacienteControler.php` y en la funcion `update` escribimos lo siguiente ...
```php
    return (new PacienteResource($paciente))->additional(['msg' => 'Paciente Actualizado Correctamente'])->response()->setStatusCode(202);
```
### Reducir las rutas de Pacientes
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
    Route::apiResource('pacientes',PacienteController::class);
```
**`Notas` Reducimos todas las rutas de pacientes a una ruta unica .**

[Subir](#top)
<a name="item11"></a>

## Laravel Sanctum ...
>`Typee:` En Consola ...
```console
composer require laravel/sanctum
```
**`Nota:` Instalamos el paquete laravel sanctum .**

>`Typee:` En Consola ...
```console
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```
**`Nota:` Publicar los archivos de configuración y migración de Sanctum .**

>`Typee:` En Consola ...
```console
php artisan migrate:reset
```
**`Nota:` Limpiamos todos las migraciones de la bd .**

>`Typee:` En Consola ...
```console
php artisan migrate --seed
```
**`Nota:` Hacemos las migraciones con el seeder de Pacientes de la bd .**

### Agregar el middleware de Sanctum a su api
>`Abrimos:` el archivo `Kernel.php` que se encuentra en la carpeta `app/Http/Kernel.php` y en la seccion `api` escribimos lo siguiente ...
```php
    'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],
```
### Para comenzar a emitir tokens para los usuarios
>`Abrimos:` el archivo `User.php` que se encuentra en la carpeta `app/Models/User.php` y en la seccion `api` escribimos lo siguiente ...
```php
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;
    }
```
**`Nota:` Si `HasApiTokens` da error, SanctumServiceProvider no se registra automáticamente en su aplicación. Para resolver su problema, debe agregar el proveedor de servicios manualmente .**
>`Abrimos:` el archivo `app.php` que se encuentra en la carpeta `Config/app.php` y en la seccion `providers` escribimos lo siguiente ...
```php
'providers' => [
    //...
    Laravel\Sanctum\SanctumServiceProvider::class,
];
```
**`Nota:` Cierre el editor y vuelva a arrancarlo y deberia de haber solucionado el problema, agradecimientos al usuario Thân LƯƠNG Đình de stackoverflow.**

### Creamos un request para registro
>`Typee:` En Consola ...
```console
php artisan make:request RegistroRequest
```
>`Abrimos:` el archivo `RegistroRequest.php` que se encuentra en la carpeta `app\http\Requests\RegistroRequest.php` y en la funcion `authorize` escribimos lo siguiente ...
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];
    }
```
**`Nota:` Importamos el Request `RegistroRequest` en el archivo `AutenticarController.php`  .**
```php
use App\Http\Requests\RegistroRequest;
```
### Creamos Cotrolador Auth api token
>`Typee:` En Consola ...
```console
php artisan make:controller AutenticarController
```
### Creamos el metodo Registro
>`Abrimos:` el archivo `AutenticarController` que se encuentra en la carpeta `app/Http/Controllers/AutenticarController.php` y escribimos lo siguiente ...
```php
class AutenticarController extends Controller
{
    public function registro(RegistroRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'res' => true,
            'msg' => 'Usuario Registrado Correctamente'
        ],200);
    }
}
```
**`Nota:` Importamos el Modelo `User` en el archivo `AutenticarController.php`  .**
```php
use App\Models\User;
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
Route::post('registro',[AutenticarController::class,'registro']);
```
**`Nota:` Importamos el Controlador `AutenticarController` en el archivo `api.php`  .**
```php
use App\Http\Controllers\AutenticarController;
```
### Creamos un request para el acceso
>`Typee:` En Consola ...
```console
php artisan make:request AccesoRequest
```
>`Abrimos:` el archivo `AccesoRequest.php` que se encuentra en la carpeta `app\http\Requests\AccesoRequest.php` y en la funcion `authorize` escribimos lo siguiente ...
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
```
**`Nota:` Importamos el Request `AccesoRequest` en el archivo `AutenticarController.php`  .**
```php
use App\Http\Requests\AccesoRequest;
```
### Creamos el metodo Acceso
>`Abrimos:` el archivo `AutenticarController` que se encuentra en la carpeta `app/Http/Controllers/AutenticarController.php` y escribimos lo siguiente ...
```php
class AutenticarController extends Controller
{
    public function acceso(AccesoRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'msg' => ['Las credenciales son incorrectas!!!'],
            ]);
        }

        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'res' => true,
            'token' => $token
        ],200);
    }
}
```
**`Nota:` Importamos las clases `Hash, ValidationException` en el archivo `AutenticarController.php`  .**
```php
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
```
### Crear ruta api ...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
Route::post('acceso',[AutenticarController::class,'acceso']);
```
### Creamos el metodo Cerrar Sesion
>`Abrimos:` el archivo `AutenticarController` que se encuentra en la carpeta `app/Http/Controllers/AutenticarController.php` y escribimos lo siguiente ...
```php
class AutenticarController extends Controller
{
    public function cerrarSesion(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'res' => true,
            'msg' => 'Token Eliminado Correctamente'
        ],200);
    }
}
```
### Crear ruta api con middleware de auth sactum...
>`Abrimos:` el archivo `api.php` que se encuentra en la carpeta `routes\api.php` y escribimos lo siguiente ...
```php
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('cerrarsesion',[AutenticarController::class,'cerrarSesion']);
});
```
### Capturar Excepcion RouteNotFoundException
>`Abrimos:`el archivo `Handler.php` que se encuentra en la carpeta `app\Exceptions\Handler.php` y añadimos al metodo render.
```php
    public function render($request, Throwable $exception)
    {
        if($exception instanceof RouteNotFoundException){
            return response()->json(["res" => false, "error" => "No tiene permiso a esta ruta"], 401);
        }
        return parent::render($request, $exception);
    }
```
**`Nota:` Importamos la clase `RouteNotFoundException` en el archivo `Handler.php`  .**
```php
use Symfony\Component\Routing\Exception\RouteNotFoundException;
```
[Subir](#top)
