<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Users;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($data){
                $result = "";
                // $result = ' <a class="btn btn-sm btn-info" title="view registarion Details " href='.route("test",$data->id).'><i class="fa fa-eye"></i></a> ';
               if($data->status == 1) {
                   $result .= '<button type="button" class="btn btn-secondary btn-sm changeStatus" status="0" title="click to Inactivate" category_id="'.$data->id.'"><i class="fa fa-lock"></i></button> ';
               } else {
                   $result .= '<button type="button" class="btn btn-danger btn-sm changeStatus" status="1" title="click to Activate" category_id="'.$data->id.'"><i class="fa fa-unlock"></i></button> ';
               }
               $result .= '<a class="btn btn-sm btn-info" title="edit registation Details" href='.route("admin.user.test1",$data->id).'><i class="fa fa-pencil"></i></a> ';
                            // <button type="button" id="cat_delete" class="btn btn-sm btn-danger" title="delete category" category_id="'.$data->id.'"><i class="fa fa-trash"></i></button> ';

               return $result;
           })

           ->editColumn('status',function($data) {
               if($data->status == 1) {
                   return '<span class="badge badge-success">Inactive</span>';
               } else {
                   return '<span class="badge badge-danger">Active</span>';
               }
           })

           ->rawColumns(['action', 'status'])
           ->addIndexColumn();

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Users $model)
    {
        // dd($model->all());
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('no')->data('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('id'),
            Column::make('fname')->title('first name'),
            Column::make('lname')->title('Last name'),
            Column::make('gender')->title('gender')->hidden(),
            Column::make('dob')->title('dob'),
            Column::make('email')->title('email'),
            Column::make('mobile')->title('mobile'),
            Column::make('password')->title('password')->hidden(),
            // Column::make('hobbies')->title('hobbies'),
            Column::make('image')->title('image')->hidden(),
            Column::make('country')->title('country name'),
            Column::make('state')->title('state name'),
            Column::make('city')->title('city name'),
            column::make('status')->title('status'),
            Column::make('created_at')->hidden(),
            Column::make('updated_at')->hidden(),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
