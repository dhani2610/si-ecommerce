<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanKeuangan implements FromView,WithEvents
{

    private $data;

    // Constructor to receive and store data
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        // dd($this->data);
        return view('catatan-keuangan.excel', [
            'data' => $this->data
        ]);
    }

    public function registerEvents(): array
    {

        $data = $this->data;

        $verti_center = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            )
        );
        
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($data, $verti_center) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']; // All headers

                for ($x = 'A'; $x <= 'ZZ'; $x++) {

                   
                    if (in_array($x, ['B'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(100);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                   
                    if (in_array($x, ['C','D','E','F'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(30);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }

                }

            },
        ];
    }
}
