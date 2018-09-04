#Notas  

- Tener ya instalado localmente composer y npm


#Instrucciones

Una vez clonado el repo ejecutar los siguientes pasos:

1. composer install (ejecutar en terminal dentro del proyecto)

2. npm install

3. Utilizar MySQL(LAMP/phpmyadmin) localmente y crear una base de datos para el proyecto

4. Copias el contenido de '.env.example' y crear un archivo '.env' con ese contenido
    4.1 Editar el archivo .env con la información de base de datos que se creo anteriormente
    4.2 Agregar las siguientes variables de entorno al final del archivo .env:
        MIX_ROOT_URL=http://localhost
        MIX_API_PORT=8000(este puede ser cualquier puerto que se desee, pero como la app corre en el puerto 8000 es mejor dejarlo asi, en caso de que se desee cambiar el puerto, correr la app en el puerto deseado, ejemplo: php artisan serve --port=3000)

5. php artisan migrate

6. php artisan key:generate

7. npm run dev

8. php artisan serve 
