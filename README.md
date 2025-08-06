# Blog de Videojuegos

## Descripción
Blog de Videojuegos es una plataforma web desarrollada en PHP que permite a los usuarios compartir y descubrir contenido relacionado con videojuegos. Los usuarios pueden registrarse, iniciar sesión, crear entradas en diferentes categorías, editar su perfil y buscar contenido específico.

## Características

- **Sistema de usuarios**: Registro, inicio de sesión y gestión de perfil
- **Gestión de entradas**: Crear, editar y eliminar publicaciones
- **Categorización**: Organización de contenido por categorías personalizables
- **Búsqueda**: Sistema de búsqueda para encontrar contenido específico
- **Interfaz responsive**: Diseño adaptable a diferentes dispositivos
- **Tema oscuro**: Soporte para modo oscuro basado en preferencias del sistema

## Tecnologías utilizadas

- PHP 7+
- MySQL
- HTML5
- CSS3 (con variables CSS para personalización)


## Estructura de la base de datos

El proyecto utiliza una base de datos MySQL con las siguientes tablas principales:

- **usuarios**: Almacena información de los usuarios registrados
- **categorias**: Contiene las diferentes categorías de videojuegos
- **entradas**: Almacena las publicaciones de los usuarios

## Instalación

1. Clona este repositorio en tu servidor web local o remoto
2. Importa la estructura de la base de datos desde el archivo `database.sql` (si está disponible)
3. Configura los parámetros de conexión a la base de datos en `assets/includes/conexion.php`
4. Accede al proyecto desde tu navegador

## Uso

1. Regístrate como nuevo usuario
2. Inicia sesión con tus credenciales
3. Explora las diferentes categorías o crea las tuyas propias
4. Crea nuevas entradas para compartir contenido
5. Busca contenido específico utilizando el buscador

## Estructura del proyecto

```
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── fonts/
│   ├── img/
│   ├── includes/
│   │   ├── cabezera.php
│   │   ├── conexion.php
│   │   ├── helpers.php
│   │   ├── lateral.php
│   │   ├── pie.php
│   │   └── redireccion.php
│   └── js/
├── index.php
├── login.php
├── registro.php
├── crear_categoria.php
├── crear_entrada.php
├── editar_entrada.php
├── entrada.php
├── entradas.php
└── ... (otros archivos PHP)
```

## Contribución

Si deseas contribuir a este proyecto, puedes seguir estos pasos:

1. Haz un fork del repositorio
2. Crea una rama para tu nueva funcionalidad (`git checkout -b feature/nueva-funcionalidad`)
3. Realiza tus cambios y haz commit (`git commit -m 'Añadir nueva funcionalidad'`)
4. Sube tus cambios a tu fork (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE para más detalles.

## Autor

Jorge Enrique Fernandez
