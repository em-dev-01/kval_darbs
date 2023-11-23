<?php

namespace App\Exports;

use App\Models\Cost;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Sheet;


class CostExport implements FromCollection, WithEvents, WithCustomStartCell
{
    use Exportable;

    protected $project_id;

    public function __construct($project_id)
    {
        $this->project_id = $project_id;
    }

    public function collection()
    {
        $project = Project::where('id', $this->project_id)->first();
        $costs = Cost::select('task_title', 'unit', 'amount', 'material_cost_per_unit', 'task_cost_per_unit', 'total_unit_cost', 'total_material_cost', 'total_task_cost', 'total_cost')
        ->where('project_id', $this->project_id)
        ->get();

        return collect([$costs]);
    }

    public function startCell(): string
    {
        return 'B13';
    }

    public function registerEvents(): array
    {
        $costs = $this->collection()->toArray();
        return [
            AfterSheet::class => function (AfterSheet $event) use ($costs) {
                // Merge cells for "darbu izmaksu tāme"
                $event->sheet->mergeCells('A1:J2');
                $event->sheet->getStyle('A1:J2')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('A1', 'DARBU IZMAKSU TĀME');

                $event->sheet->mergeCells('A3:J3');
                $event->sheet->getStyle('A3:J3')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('A3', 'SIA "AR Builders"');

                // Merge cells for table headers
                // darbu nosaukums
                $event->sheet->mergeCells('B7:B9');
                $event->sheet->getStyle('B7:B9')->getAlignment()->setHorizontal('center');
                $event->sheet->setCellValue('B7', 'Darbu nosaukums');

                // mērvienība un apjoms
                $event->sheet->mergeCells('C7:C9');
                $event->sheet->setCellValue('C7', 'Mērv.');

                $event->sheet->mergeCells('D7:D9');
                $event->sheet->setCellValue('D7', 'Apjoms');

                //vienības izmaksas
                $event->sheet->mergeCells('E7:G7');
                $event->sheet->setCellValue('E7', 'Vienības izmaksas');

                $event->sheet->mergeCells('E8:E9');
                $event->sheet->setCellValue('E8', 'Materiāls');

                $event->sheet->mergeCells('F8:F9');
                $event->sheet->setCellValue('F8', 'Darbs');

                $event->sheet->mergeCells('G8:G9');
                $event->sheet->setCellValue('G8', 'Kopā');

                //kopējās izmaksas
                $event->sheet->mergeCells('H7:J7');
                $event->sheet->setCellValue('H7', 'Kopējās izmaksas');

                $event->sheet->mergeCells('H8:H9');
                $event->sheet->setCellValue('H8', 'Materiāls');

                $event->sheet->mergeCells('I8:I9');
                $event->sheet->setCellValue('I8', 'Darbs');

                $event->sheet->mergeCells('J8:J9');
                $event->sheet->setCellValue('J8', 'Kopā');

                $row_count = count($costs);

                //styling

                $event->sheet->getColumnDimension('B')->setAutoSize(true); // Auto-size column B on content

               
            },
        ];
    }
}
