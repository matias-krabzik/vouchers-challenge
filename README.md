## Vouchers Challenge

#### Instrucciones

1. Ejecutar <code>composer install</code>
2. Ejecutar <code>npm install</code>
3. Haga una copia del del archivo. 
   1. Windows <code>copy .env.example .env</code>.
   2. Unix <code>cp .env.example .env</code>.
4. Ejecutar <code>php artisan key:generate</code>
5. Modificar el archivo .env agregando las variables <code>DB_DATABASE</code>, <code>DB_USERNAME</code> y <code>DB_PASSWORD</code>
6. Ejecutar <code>php artisan migrate:fresh --seed</code>
7. Ejecutar <code>php artisan serve</code>


