# 🧠 Foro de TI para Estudiantes

Este proyecto es un **foro académico** dirigido a estudiantes del área de Tecnologías de la Información, donde pueden **realizar publicaciones, comentar y compartir conocimientos**. Está desarrollado con Laravel y Tailwind CSS, enfocado en la simplicidad, accesibilidad y participación activa.

## 🚀 Tecnologías utilizadas

- Laravel 11 con Breeze
- Tailwind CSS para diseño
- Storage Disk de Laravel para carga y gestión de imágenes
- Política de roles para control de acceso
- Laravel Lang para soporte en español
- MySQL

## 💻 Instalación del Proyecto
1. Realiza un fork del repositorio
2. Clona tu fork localmente:
   git clone https://github.com/*TuUsuario*/Foro-TI-910-AEI.git

3. Entra al directorio del proyecto:
   cd Foro-TI-910-AEI

4. Instala las dependencias de PHP y JavaScript:
   composer install
   npm install

5. Copia el archivo de entorno:
   cp .env.example .env

6. Configura en `.env`:
   - La zona horaria: `America/Mexico_City`
   - El idioma predeterminado: `es` (usa Laravel Lang para la localización)

7. Crea una base de datos en tu gestor (ej. MySQL) y coloca las credenciales en `.env`

8. Genera la clave de la aplicación:
   php artisan key:generate

9. Ejecuta las migraciones:
   php artisan migrate

10. Crea el enlace simbólico al almacenamiento:
    php artisan storage:link

12. Descarga los componetes de heroicons:
    composer require blade-ui-kit/blade-heroicons

13. Levanta el servidor y prueba que todo funcione:
    php artisan serve

14. Actualizar valores para poner a prueba las configuraciones.

## 🤝 Aportaciones al proyecto
Si deseas colaborar, sigue estas convenciones:

🔧 Vistas
Las nuevas vistas deben agregarse en una carpeta independiente, cuyo nombre haga referencia al cambio realizado.

Usa @include para insertar tu vista en layouts existentes.

No se requiere el uso de componentes Blade o de Tailwind con slot por ahora.

📚 Controladores, Modelos y Rutas
Comenta claramente cada cambio con tu nombre o usuario como referencia.

No crear nuevos archivos de rutas; modifica solo los existentes si es necesario.

## 🔁 Flujo de trabajo colaborativo
1. Agrega el repositorio original como upstream:
   git remote add upstream https://github.com/Lotharyhg/Foro-TI-910-AEI.git

2. Crea una nueva rama para tus aportaciones:
   ### Para nuevas funcionalidades
   git checkout -b feature/nombre-de-la-funcion

   ### Para correcciones
   git checkout -b fix/nombre-de-la-correccion

   ### Para mejoras
   git checkout -b refactor/nombre-de-la-mejora

4. Realiza tus aportes y haz commit:
   git commit -m "Agrega nueva funcionalidad: X por @tuusuario"

5. Haz push a tu fork:
   git push origin nombre-de-la-rama

6. Abre una Pull Request con:
   - Descripción detallada de la aportación
   - Capturas de pantalla si aplica
   - Comentarios explicativos en cada imagen
   - Tu autoría como colaborador

---

## 🖼️ Vista previa del proyecto
![Foro-TI (1)](https://github.com/user-attachments/assets/2c0443ee-49bd-410b-9982-8c4e495b0984)
---
![Foro-TI (2)](https://github.com/user-attachments/assets/59347237-d879-440f-9ef1-b13cad78b652)

## 👨‍💻 Autor principal
Desarrollado y mantenido por:

*Lothar Hdez*
GitHub: *@Lotharyhg*
Proyecto educativo para fines académicos.


## 📄 Licencia
Este proyecto está bajo la licencia MIT. Puedes usarlo, modificarlo y distribuirlo libremente con la debida atribución.

