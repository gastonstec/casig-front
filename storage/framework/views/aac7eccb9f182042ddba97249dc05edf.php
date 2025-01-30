<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Asignación de Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #d6d6d6;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header img {
            height: 50px;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
            padding-bottom: 40px;
        }
        .container-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="<?php echo e(asset('img/logo.jpg')); ?>" alt="Logo">
    </header>
    
    <main class="content">
        <div class="container-box">
            <h2 class="text-center">Control de Asignación de Equipos</h2>
            <form>
                <div class="mb-3">
                    <label class="form-label">User ID</label>
                    <select class="form-select" id="userId">
                        <option selected>Selecciona un usuario</option>
                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($usuario->id); ?>"><?php echo e($usuario->id); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Supervisor</label>
                    <input type="text" class="form-control" id="supervisor" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Centro de C.</label>
                    <input type="text" class="form-control" id="centro" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" disabled>
                </div>
                
                <h4>Técnico</h4>
                <div class="mb-3">
                    <label class="form-label">Técnico que entregará</label>
                    <select class="form-select">
                        <option selected>Muestra nombre de técnico SNOW</option>
                        <option value="1">Técnico 1</option>
                        <option value="2">Técnico 2</option>
                        <option value="3">Técnico 3</option>
                    </select>
                </div>
                
                <h4>Dispositivo</h4>
                <div class="mb-3">
                    <label class="form-label">Selecciona dispositivo</label>
                    <select class="form-select">
                        <option selected>Muestra catálogo de ítems en SNOW</option>
                        <option value="1">Laptop HP</option>
                        <option value="2">Monitor HP</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Selecciona N/S</label>
                    <select class="form-select">
                        <option selected>Muestra Números de serie SNOW del ítem seleccionado</option>
                        <option value="1">2345DF34</option>
                        <option value="2">5432FGH2</option>
                    </select>
                </div>
                
                <h4>Lista de Dispositivos Asignados</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Descripción Dispositivo</th>
                            <th>Asset Tag</th>
                            <th>Número de Serie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laptop HP</td>
                            <td>ASE234</td>
                            <td>2345DF34</td>
                        </tr>
                        <tr>
                            <td>Monitor HP</td>
                            <td>HPM345</td>
                            <td>5432FGH2</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Asignar Dispositivos</button>
                </div>
            </form>
        </div>
    </main>
    
    <footer class="footer">
        &copy; 2025 Mi Aplicación. Todos los derechos reservados.
    </footer>
    
    <script>
        document.getElementById('userId').addEventListener('change', function() {
            let userId = this.value;
            if (userId) {
                fetch(`/usuario/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('nombre').value = data.nombre || '';
                        document.getElementById('supervisor').value = data.supervisor || '';
                        document.getElementById('centro').value = data.centro || '';
                        document.getElementById('correo').value = data.correo || '';
                        document.getElementById('ubicacion').value = data.ubicacion || '';
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\example-app\resources\views/admi.blade.php ENDPATH**/ ?>