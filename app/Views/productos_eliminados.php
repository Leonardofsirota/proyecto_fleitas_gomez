<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-4 text-center">
    <h2>Productos Eliminados</h2>
    <?php if (!empty($eliminados) && is_array($eliminados)): ?>
        <div class="d-flex justify-content-center">
            <table class="table table-bordered table-striped mt-3" style="max-width: 900px;">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eliminados as $producto): ?>
                        <tr>
                            <td><?= esc($producto['nombre_prod']) ?></td>
                            <td>$<?= number_format($producto['precio_vta'], 2, ',', '.') ?></td>
                            <td><?= esc($producto['stock']) ?></td>
                            <td>
                                <?php if (!empty($producto['imagen'])): ?>
                                    <img src="<?= base_url('assets/uploads/' . esc($producto['imagen'])) ?>" alt="Imagen" class="img-thumbnail" style="max-width: 80px;">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('productos/activar/' . $producto['id_producto']) ?>" class="btn btn-success btn-sm">Activar</a>
                                <a href="<?= base_url('productos/editar/' . (isset($producto['id']) ? $producto['id'] : (isset($producto['id_producto']) ? $producto['id_producto'] : ''))) ?>" class="btn btn-success btn-sm">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay productos eliminados.</p>
    <?php endif; ?>
    <a href="<?= site_url('tabla_productos') ?>" class="btn btn-secondary mt-3 mb-5">Volver a la lista de Productos</a>
</div>
<?= $this->endSection() ?>
