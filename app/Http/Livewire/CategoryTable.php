<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
//        $this->setDebugStatus(true);

        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['categories.id as id']);
        $this->setColumnSelectStatus(false);
    }

    public function builder(): Builder
    {
        return Category::withCount('posts');
    }

    public function columns(): array
    {
        return [
            Column::make(" الاسم", "category_name")
                ->sortable(),
            BooleanColumn::make("الحالة", "status")->sortable(),
            Column::make("اضيف بواسطة", "user.name")->sortable(),
            Column::make('تاريخ الانشاء', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
            Column::make('عدد المنتجات')
                ->label(function ($row) {
                    return $row->posts_count;
                }),
            ButtonGroupColumn::make('خيارات')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('category.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('category.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ]),
        ];
    }
}
