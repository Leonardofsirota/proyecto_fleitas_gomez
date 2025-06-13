<?php

namespace App\Controllers;

use App\Models\Consulta_model;
use CodeIgniter\Controller;

class ConsultasController extends Controller
{
    protected $consultaModel;

    public function __construct()
    {
        $this->consultaModel = new Consulta_model();
    }

    public function index()
    {
        $data['consultas'] = $this->consultaModel->findAll();
        return view('contacto', $data);
    }

    public function crear()
    {
        return view('contacto');
    }

    public function guardar()
    {
        $request = service('request');
        $data = [
            'consultas_nombre'   => $request->getPost('nombre'),
            'consultas_apellido' => $request->getPost('apellido'),
            'consultas_email'    => $request->getPost('email'),
            'consultas_numero'   => $request->getPost('numero'),
            'consultas_pregunta' => $request->getPost('pregunta'),
            'consultas_visto'    => 0 // por defecto no visto
        ];
        $this->consultaModel->save($data);

        return redirect()->to('/contacto');
    }

    public function marcarComoVisto($id)
    {
        $this->consultaModel->update($id, ['consultas_visto' => 1]);
        return redirect()->to('/contacto');
    }
}
