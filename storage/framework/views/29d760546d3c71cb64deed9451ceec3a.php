<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Asignación de Equipos</title>

    <!-- Importing Bootstrap from local files -->
    <link href="<?php echo e(asset('bootstrap.min.css')); ?>" rel="stylesheet">

    <style>
       /* General body settings */
       body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #d6d6d6;
        }

        /* Header styles */
        .header {
            background-color: #f8f9fa;
            padding: 10px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #ddd;
        }

        .header img {
            height: 40px;
        }

        /* Main content container */
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .container-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1600px;
        }

        /* Form container */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 5px;
        }

        /* Footer styles */
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
        }

        h4 {
            font-size: 1.1rem;
            margin-top: 15px;
        }

        table {
            font-size: 0.9rem;
        }

        /* Error message styles */
        #error-message {
            display: none;
            font-size: 0.9rem;
            padding: 8px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 250px;
            z-index: 1000;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            background-color: #f8d7da;
            color: #721c24;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header with logo -->
    <header class="header">
        <img src="<?php echo e(asset('img/logo.jpg')); ?>" alt="Logo">
    </header>

    <!-- Main container -->
    <main class="content">
        <div class="container-box">
            <h2 class="text-center">Control de Asignación de Equipos</h2>

            <!-- Assignment form -->
            <form>
                <div class="form-container">
                    <!-- Error message for unknown ID -->
                    <div id="error-message">El ID ingresado no existe.</div>

                    <!-- User ID input field -->
                    <div class="form-group">
                        <label class="form-label">User ID</label>
                        <input type="text" class="form-control" id="userId" placeholder="Ingrese el ID del usuario">
                    </div>

                    <!-- User information fields -->
                    <div class="form-group">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="name" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" id="email" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="location" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Call Center</label>
                        <input type="text" class="form-control" id="callCenter" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Puesto</label>
                        <input type="text" class="form-control" id="position" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Supervisor</label>
                        <input type="text" class="form-control" id="supervisor" disabled>
                    </div>
                </div>

                <!-- Technician and device selection -->
                <h4>Técnico</h4>
                <div class="form-group">
                    <label class="form-label">Técnico que entregará</label>
                    <select class="form-select" id="technician">
                        <option selected>Seleccione un técnico</option>
                    </select>
                </div>

                <h4>Dispositivo</h4>
                <div class="form-group">
                    <label class="form-label">Selecciona dispositivo</label>
                    <select class="form-select" id="device">
                        <option selected>Seleccione un dispositivo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Selecciona N/S</label>
                    <select class="form-select">
                        <option selected>Muestra Números de serie SNOW del ítem seleccionado</option>
                    </select>
                </div>

                <!-- Table of assigned devices -->
                <h4>Lista de Dispositivos Asignados</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción Dispositivo</th>
                            <th>Asset Tag</th>
                            <th>Número de Serie</th>
                        </tr>
                    </thead>
                    <tbody id="assignedDevicesTable">
                        <!-- To be dynamically populated -->
                    </tbody>
                </table>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Asignar Dispositivos</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 Mi Aplicación. Todos los derechos reservados.
    </footer>

    <script>
        /**
         * Handles the blur event on the User ID field.
         * Makes a request to the API to fetch user data.
         */
        document.getElementById('userId').addEventListener('blur', function() {
            let userId = this.value.trim();
            let errorMessage = document.getElementById('error-message');

            if (userId === '') {
                clearFields();
                return;
            }

            let apiUrl = `http://127.0.0.1:8000/SnowGetUserId?UserId=${userId}`;

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Usuario no encontrado");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Datos recibidos:", data); // Agregar esta línea para ver la respuesta en la consola

                    document.getElementById('name').value = data.Name || '';
                    document.getElementById('email').value = data.Email || '';
                    document.getElementById('location').value = data.Location || '';
                    document.getElementById('callCenter').value = data.CallCenter || '';
                    document.getElementById('position').value = data.Position || '';
                    document.getElementById('supervisor').value = data.Supervisor || '';

                    errorMessage.style.display = 'none';
                })
                .catch(() => {
                    errorMessage.style.display = 'block';
                    setTimeout(() => errorMessage.style.display = "none", 3000);
                    clearFields();
                });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\casig-front\resources\views/admi.blade.php ENDPATH**/ ?>