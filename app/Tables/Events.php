<?php

namespace App\Tables;

use App\Models\Event;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Events extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        if (Gate::allows('if_company')) {
            return Event::query()->where('target', Event::TARGET_COMPANY);
        } elseif (Gate::allows('if_visitor')) {
            return Event::query()->where('target', Event::TARGET_VISITOR);
        } else {
            return Event::query();
        }
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name'])
            ->searchInput('name')
            ->searchInput('location')
            ->paginate(15)
            ->column('name', sortable: true)
            ->column('location', sortable: true)
            ->column('start_date', sortable: true)
            ->column('end_date', sortable: true);
        if (Gate::allows('if_admin')) {
            $table->column('target')
                ->column('visible_for_target')
                ->column('actions');
        }

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}