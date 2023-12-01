<?php

namespace App\DataTables;

use App\Enums\TodoItemStatusEnum;
use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use function Symfony\Component\String\b;

class TodoItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('todo_category_id', function (TodoItem $item) {
                return $item->category->name;
            })
            ->editColumn('status', function (TodoItem $item) {
                return TodoItemStatusEnum::labels()[$item->status];
            })
            ->editColumn('id', function (TodoItem $item) {
                if (! is_null($item->deleted_at)) {
                    return "$item->id - Deleted";
                }
                return $item->id;
            })
            ->editColumn('shared', function (TodoItem $item) {
                return $item->share->map(fn ($share) => $share->name)->implode(', ');
            })
            ->addColumn('action', function (TodoItem $item) {
                if ($item->user_id === Auth::id()) {
                    return view('pages.todo-items._partials.actions', [
                        'item' => $item,
                        'users' => User::query()->whereNot('id', Auth::id())->pluck('name', 'id'),
                        'shared' => $item->share->map(fn ($item) => $item->id)->toArray(),
                    ]);
                }
                return "Shared item";
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TodoItem $model): QueryBuilder
    {
        return $this->filterQuery($model->newQuery()
        )->orderBy('id','desc');
    }

    protected function filterQuery($query)
    {
        if (request()->has('todo_category_id') && ! is_null(request()->get('todo_category_id'))) {
            $query = $query->where('todo_category_id', request()->get('todo_category_id'));
        }

        if (request()->has('status') && ! is_null(request()->get('status'))) {
            $query = $query->where('status', request()->get('status'));
        }

        if (request()->has('show_deleted') && request()->get('show_deleted')) {
            $query = $query->withTrashed();
        }

        if (request()->has('show_shared') && request()->get('show_shared')) {
            $query = $query->whereHas('share', function ($query) {
                $query->where('user_id', Auth::id());
            });
        } else {
            $query = $query->orWhereHas('share', function ($query) {
                $query->where('user_id', Auth::id());
            })->orWhere('user_id', Auth::id());
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('todoitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'buttons' => ['reload']
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title('Todo item name'),
            Column::make('todo_category_id')->title('Category'),
            Column::make('shared')->title('Shared with users'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TodoItem_' . date('YmdHis');
    }
}
