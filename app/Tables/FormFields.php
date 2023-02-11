<?php

namespace App\Tables;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class FormFields extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public $form;
    public function __construct(Form $f)
    {
        $this->form = $f;
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
        return FormField::where('form_id', $this->form->id)->get();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        if (Gate::allows('if_admin')) {
            $table
                ->withGlobalSearch()
                ->column('field')
                ->column('actions');
        }

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}