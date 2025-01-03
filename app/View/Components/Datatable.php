<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Datatable extends Component
{
    public $columns;
    public $rows;
    public $search;
    public $filter;
    public $filters;
    public $placeholderFilter;
    public $colAction;
    public $fields;
    public $detailRoute;
    public $rowCallback;
    public $detailId;

    /**
     * Create a new component instance.
     *
     * @param array $columns
     * @param object $rows
     * @param array $fields
     * @param string|null $detailRoute
     * @param bool $search
     * @param bool $filter
     * @param array|null $filters
     * @param string $placeholderFilter
     * @param array|null $colAction
     * @param \Closure|null $rowCallback
     */
    public function __construct(
        array $columns,
        object $rows,
        array $fields,
        ?string $detailRoute = null,
        bool $search = false,
        bool $filter = false,
        ?array $filters = null,
        string $placeholderFilter = 'Pilih Filter',
        ?array $colAction = null,
        ?Closure $rowCallback = null,
        $detailId = null,
    ) {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->fields = $fields;
        $this->detailRoute = $detailRoute;
        $this->search = $search;
        $this->filter = $filter;
        $this->filters = $filters;
        $this->placeholderFilter = $placeholderFilter;
        $this->colAction = $colAction;
        $this->rowCallback = $rowCallback;
        $this->detailId = $detailId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable');
    }
}
