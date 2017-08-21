<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Archive;
use Form;
use Yajra\Datatables\Services\DataTable;

class ArchiveDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'admin.archives.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $archives = Archive::query();

        return $this->applyScopes($archives);
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
            'judul' => ['name' => 'judul', 'data' => 'judul'],
            'tanggal' => ['name' => 'tanggal', 'data' => 'tanggal'],
            'jenis_informasi' => ['name' => 'jenis_informasi', 'data' => 'jenis_informasi'],
            'asal' => ['name' => 'asal', 'data' => 'asal'],
            'bentuk_informasi' => ['name' => 'bentuk_informasi', 'data' => 'bentuk_informasi'],
            'keterangan' => ['name' => 'keterangan', 'data' => 'keterangan'],
            'file' => ['name' => 'file', 'data' => 'file'],
            'verified' => ['name' => 'verified', 'data' => 'verified'],
            'verified_by' => ['name' => 'verified_by', 'data' => 'verified_by'],
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
        return 'archives';
    }
}
