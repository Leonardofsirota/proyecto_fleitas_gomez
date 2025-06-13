<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-4">
    <h2>Editar Producto</h2>
    <form action="<?= base_url('productos/actualizar/' . (isset($producto['id']) ? $producto['id'] : (isset($producto['id_producto']) ? $producto['id_producto'] : '')) ) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre_prod" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_prod" name="nombre_prod" value="<?= esc($producto['nombre_prod']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio de Costo</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
        </div>
        <div class="mb-3">
            <label for="precio_vta" class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" class="form-control" id="precio_vta" name="precio_vta" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= esc($producto['stock']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock_min" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stock_min" name="stock_min" value="<?= esc($producto['stock_min']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="<?= base_url('assets/uploads/' . esc($producto['imagen'])) ?>" alt="Imagen actual" class="img-thumbnail mt-2" style="max-width: 150px;">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= site_url('tabla_productos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?= $this->endSection() ?>
