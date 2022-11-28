<?php

namespace App\Http\Controllers;

use App\Http\Services\InformeService;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;

class PDFController extends Controller
{
    public function pdf(Request $request)
    {
        $empleado = Empleado::find($request->empleado_id);
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;

        $stats = $this->getStats($empleado, $fecha_inicio, $fecha_fin);
        $pdf = PDF::loadView('livewire.informe.pdf', compact('empleado', 'stats', 'fecha_inicio', 'fecha_fin'));
        return $pdf->stream();
    }

    public function getStats($empleado, $fecha_inicio, $fecha_fin)
    {
        if (!is_null($empleado)) {
            $asistencias = InformeService::asistencias(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $listadoAsistencias = InformeService::listadoAsistencias(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $horasExtras = InformeService::horasExtras(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $listadoHorasExtra = InformeService::listadoHorasExtra(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $horasTrabajadas = InformeService::horasTrabajadas(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $faltasJustificadas = InformeService::faltasJustificadas(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );
            $faltasInjustificadas = InformeService::faltasInjustificadas(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );

            $excesoHoras = InformeService::excesoHoras(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );

            $graficos = InformeService::calcularGraficos(
                $empleado,
                $fecha_inicio,
                $fecha_fin
            );

            return [
                'empleado' => $empleado,
                'graficos' => $graficos,
                'excesoHoras' => $excesoHoras,
                'asistencias' => $asistencias,
                'horasExtras' => $horasExtras,
                'horasTrabajadas' => $horasTrabajadas,
                'listado_horas_extra' => $listadoHorasExtra,
                'faltasJustificadas' => $faltasJustificadas,
                'listado_asistencias' => $listadoAsistencias,
                'faltasInjustificadas' => $faltasInjustificadas,
            ];
        }
        return null;
    }
}
