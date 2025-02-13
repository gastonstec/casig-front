<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

# Sistema de Asignación de Cartas

Sistema que ayudará a generar cartas de asignación de dispositivos. Este repositorio contiene y trabaja sobre el lado del frontend, proporcionando la estructura y el diseño de las interfaces del sistema.

## Requisitos

Para ejecutar este proyecto, se requiere:

- **Laravel** (versión recomendada 8 o superior)
- **XAMPP** (para ejecutar Apache y MySQL)
- **Visual Studio Code** o cualquier otro editor de código
- **PHP** (versión 7.4 o superior)

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```sh
   git clone https://github.com/gastonstec/casig-front.git
   ```

2. **Mover el proyecto a la carpeta de XAMPP:**
   - Copia el proyecto dentro de `C:\xampp\htdocs\`

3. **Encender el servidor local:**
   - Iniciar Apache y MySQL desde XAMPP

4. **Configurar la base de datos:**
   - Se utiliza **MySQL** y la base de datos se llama `whr`.
   - Importar el esquema de la base de datos si es necesario.

5. **Ejecutar el proyecto:**
   ```sh
   php artisan serve
   ```
   - Abre el navegador y accede a la URL proporcionada en la terminal.

## Estructura del Proyecto

```
casig-front/
│── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   ├── Models/
│   ├── Providers/
│── bootstrap/
│── config/
│── database/
│── public/
│   ├── img/
│   ├── css/
│   ├── js/
│── resources/
│   ├── views/
│── routes/
│── storage/
│── .env
│── .gitignore
│── composer.json
│── README.md
```

## 🔗 API de Google

El sistema ya cuenta con las integraciones necesarias con las API de Google, incluyendo OAuth2 para la autenticación y Google Drive para el almacenamiento de documentos. Si se desea modificar las credenciales o cambiar la configuración de las API, se deben actualizar en el archivo `.env`.

## 🤝 Contribuciones

Este es un proyecto colaborativo desarrollado por un equipo de dos personas. Se aceptan contribuciones mediante *pull requests*.

## 📜 Licencia

No se ha definido una licencia específica para este proyecto.
