<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Antes que nada configurar las variables de entorno para no tener conflictos con los puertos:

- `DB_HOST=mysql` 
- `FORWARD_DB_PORT=3391` 
- `APP_PORT=8098` 

Los puertos que elegí son los que tengo disponibles.

Correr este comando en el directorio del proyecto:

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
Con el siguiente comando creamos el alias de "sail":
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Para iniciar el contenedor, podemos hacerlo directamente en la terminal o pasándole el argumento `-d` para correrlo en segundo plano. 
```
sail up -d || sail up -d 
```

Para detener la ejecución del contenedor, podemos presionar `ctrl + c`, o el `sail stop` si el proceso corre en segundo plano. 
```
sail stop
```

Generamos la variable de entorno `APP_KEY` en `.env`.
```
sail artisan key:generate
```

Correr los siguientes comandos:

```
sail npm install
```

```
sail npm run dev
```

```
sail artisan migrate --seed
```
