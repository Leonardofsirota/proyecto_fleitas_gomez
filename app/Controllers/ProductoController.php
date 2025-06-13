<?php

namespace App\Controllers;

use App\Models\producto_Model;
use CodeIgniter\Controller;

class ProductoController extends BaseController
{
    protected $productoModel;
    protected $cart;

    public function __construct()
    {
        $this->productoModel = new producto_Model();
        $this->cart = \Config\Services::cart();
    }

    // Mostrar catálogo de productos por categoría
    public function index($categoria_id = null)
    {
        $categoriaModel = new \App\Models\categoria_Model();
        $categorias = $categoriaModel->where('activo', 1)->findAll();
        $request = \Config\Services::request();
        // Si viene por GET, tomar el filtro de la URL
        $categoria_id = $request->getGet('categoria_id') ?? $categoria_id;
        $db = \Config\Database::connect();
        $builder = $db->table('productos');
        $builder->select('productos.*, categorias.descripcion AS nombre_cat');
        $builder->join('categorias', 'categorias.id_categoria = productos.categoria_id', 'left');
        $builder->where('productos.eliminado', 'no');
        if ($categoria_id) {
            $builder->where('productos.categoria_id', $categoria_id);
        }
        $productos = $builder->get()->getResultArray();
        return view('productos', [
            'productos' => $productos,
            'categorias' => $categorias,
            'categoria_id' => $categoria_id,
            'cart' => $this->cart
        ]);
    }

    // Mostrar tabla de productos (no eliminados)
    public function tabla()
    {
        $productos = $this->productoModel->where('eliminado', 'no')->findAll();
        return view('tabla_productos', ['productos' => $productos]);
    }

    // Mostrar formulario de alta de producto
    public function agregar()
    {
        $categoriaModel = new \App\Models\categoria_Model();
        $categorias = $categoriaModel->where('activo', 1)->findAll();
        return view('productos_alta', ['categorias' => $categorias]);
    }

    // Guardar producto nuevo
    public function guardar()
    {
        $request = service('request');
        $data = [
            'nombre_prod' => $request->getPost('nombre_prod'),
            'precio_vta'  => $request->getPost('precio_vta'),
            'stock'       => $request->getPost('stock'),
            'categoria_id' => $request->getPost('categoria_id'),
            'eliminado'   => 'no'
        ];
        // Manejo de imagen
        $imagen = $request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('assets/uploads', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }
        $this->productoModel->insert($data);
        return redirect()->to(site_url('productos/tabla'));
    }

    // Mostrar formulario de edición
    public function editar($id)
    {
        $producto = $this->productoModel->find($id);
        if (!$producto) {
            return redirect()->to(site_url('productos/tabla'));
        }
        return view('productos_editar', ['producto' => $producto]);
    }

    // Actualizar producto
    public function actualizar($id)
    {
        $request = service('request');
        $data = [
            'nombre_prod' => $request->getPost('nombre_prod'),
            'precio'      => $request->getPost('precio'),
            'precio_vta'  => $request->getPost('precio_vta'),
            'stock'       => $request->getPost('stock'),
            'stock_min'   => $request->getPost('stock_min'),
        ];
        $imagen = $request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move('assets/uploads', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }
        $this->productoModel->update($id, $data);
        return redirect()->to(site_url('productos/tabla'));
    }

    // Eliminar producto (borrado lógico)
    public function borrar($id)
    {
        $this->productoModel->update($id, ['eliminado' => 'si']);
        return redirect()->to(site_url('productos/tabla'));
    }

    // Listar productos eliminados
    public function eliminados()
    {
        $eliminados = $this->productoModel->where('eliminado', 'SI')->findAll();
        return view('productos_eliminados', ['eliminados' => $eliminados]);
    }

    // Activar producto eliminado
    public function activar($id)
    {
        $this->productoModel->update($id, ['eliminado' => 'no']);
        return redirect()->to(site_url('productos/eliminados'));
    }
}
