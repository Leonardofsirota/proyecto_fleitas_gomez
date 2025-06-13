<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-4">
    <h2>Alta de Producto</h2>
    <form action="<?= site_url('producto/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre_prod" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_prod" name="nombre_prod" required>
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
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="stock_min" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stock_min" name="stock_min" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"><?= esc($cat['descripcion']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= site_url('tabla_productos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?= $this->endSection() ?>
