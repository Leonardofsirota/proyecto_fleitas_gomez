<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>

<div class="container my-5">
    <h1>Detalle de Compra</h1>

    <?php if (!empty($detalles)): ?>
        <div class="mb-3 text-end">
            <span class="badge bg-info">Fecha: <?= isset($detalles[0]['fecha']) ? esc(date('d/m/Y H:i', strtotime($detalles[0]['fecha']))) : '' ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $item): ?>
                        <tr>
                            <td><?= esc($item['nombre_producto']) ?></td>
                            <td>$<?= number_format($item['precio'], 2, ',', '.') ?></td>
                            <td><?= esc($item['cantidad']) ?></td>
                            <td>$<?= number_format($item['precio'] * $item['cantidad'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong>$<?= number_format($total_venta, 2, ',', '.') ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php else: ?>
        <p>No se encontraron productos para esta compra.</p>
    <?php endif; ?>

    <a href="<?= site_url('compras') ?>" class="btn btn-secondary mt-3">Volver al historial</a>
</div>
<?= $this->endSection() ?>
