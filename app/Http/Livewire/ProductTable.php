<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
//        $this->setDebugStatus(true);
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['products.featured_image', 'products.barcode', 'products.id as id']);
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("اسم المنتج", "name")->sortable(),
            ImageColumn::make('صورة المنتج')
                ->location(
                    fn($row) => asset($row->featured_image)
                )->attributes(fn($row) => [
                    'style' => 'height: 50px;',
                    'class' => 'rounded-full',
                    'alt' => $row->name . ' Avatar',
                ]),
            Column::make("الكمية", "quantity")->sortable(),
            Column::make("السعر", "price")->sortable(),
            Column::make("التكلفة", "cost")->sortable(),
            BooleanColumn::make("الحالة", "status")->sortable(),
            Column::make("التصنيف", "category.category_name")->searchable()->sortable(),
            Column::make("اضيف بواسطة", "user.name")->sortable(),

            Column::make('تاريخ الانشاء', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
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
                        ->location(fn($row) => route('product.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('product.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ]),

        ];
    }

}
