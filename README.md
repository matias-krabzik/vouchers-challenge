## Vouchers Challenge

#### Instrucciones

1. Ejecutar <code>composer install</code>
2. Ejecutar <code>npm install</code>
3. Haga una copia del del archivo. 
   1. Windows <code>copy .env.example .env</code>.
   2. Unix <code>cp .env.example .env</code>.
4. Ejecutar <code>php artisan key:generate</code>
5. Modificar el archivo .env agregando las variables <code>DB_DATABASE</code>, <code>DB_USERNAME</code> y <code>DB_PASSWORD</code>, <code>DB_PASSWORD</code> para la internacionalización.
6. Ejecutar <code>php artisan migrate:fresh --seed</code>
   1. Es importante que este agregada a las variables de entorno mysql para que el seed funcione.
7. Ejecutar <code>php artisan serve</code>
8. entrar a la Url http://localhost:8000.

#### Como se resolvío

###### Internacionalización 

La internacionalización de la aplicacion se realizo según lo especificado. En el archivo <code>.env</code> se debe de agregar la variable de entorno <code>APP_LANG</code>, cuyo valor depende de la internacionalización realizada y configurada dentro de la <code>lang</code>. Para este challenge se agrego la traducción al español. 

Dentro del archivo <code>/config/app.php</code>, modifiqué la variable <code>'locale' => 'es'</code> por <code>'locale' => env('APP_LANG', 'en')</code>, la cual me permite cumplir con el requerimiento.

Para la pantalla de Vouchers, se genero el archivo <code>/lang/en/vouchers.php</code>, el cual contiene todos los textos de la pantalla. Este mismo fue traducido al español y agregado a la carpeta correspondiente.
 

###### Autenticación de usuarios. 

La autenticación de usuarios se realizó con el paquete Laravel UI. 

No se utilizo el facade <code>Auth::routes();</code>, solamente introducimos las rutas de login y logout al archivo <code>/routes/web.php</code>.

###### Listado de Vouchers.

Se optó por utilizar Balde junto con Bootstrap.


