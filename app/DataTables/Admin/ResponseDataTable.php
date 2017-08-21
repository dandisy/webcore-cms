<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Response;
use Form;
use Yajra\Datatables\Services\DataTable;

class ResponseDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'admin.responses.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $responses = Response::query();

        return $this->applyScopes($responses);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             /*'pdf',*/
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'nomor' => ['name' => 'nomor', 'data' => 'nomor'],
            'tanggal' => ['name' => 'tanggal', 'data' => 'tanggal'],
            'nomor_keberatan' => ['name' => 'nomor_keberatan', 'data' => 'nomor_keberatan'],
            'keterangan' => ['name' => 'keterangan', 'data' => 'keterangan'],
            'created_by' => ['name' => 'created_by', 'data' => 'created_by']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'responses';
    }
}
