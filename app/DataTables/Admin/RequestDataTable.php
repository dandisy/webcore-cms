<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Request;
use Form;
use Yajra\Datatables\Services\DataTable;

class RequestDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'admin.requests.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $requests = Request::query();

        return $this->applyScopes($requests);
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
            'nama_pengguna' => ['name' => 'nama_pengguna', 'data' => 'nama_pengguna'],
            'nomor_identitas_pengguna' => ['name' => 'nomor_identitas_pengguna', 'data' => 'nomor_identitas_pengguna'],
            //'telepon' => ['name' => 'telepon', 'data' => 'telepon'],
            //'email' => ['name' => 'email', 'data' => 'email'],
            'keterangan' => ['name' => 'keterangan', 'data' => 'keterangan'],
            'created_by' => ['name' => 'created_by', 'data' => 'created_by'],
            'verified' => ['name' => 'verified', 'data' => 'verified'],
            'verified_by' => ['name' => 'verified_by', 'data' => 'verified_by']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'requests';
    }
}
