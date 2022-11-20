<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;

class SupplierTable extends DataTableComponent
{
    protected $model = Supplier::class;

    public function configure(): void
    {
//        $this->setDebugStatus(true);

        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['suppliers.id as id']);
        $this->setColumnSelectStatus(false);
    }

    public function builder(): Builder
    {
        return Supplier::withCount('products');
    }

    public function columns(): array
    {
        return [
            Column::make(" الاسم", "name")->sortable(),
            Column::make(" رقم الهاتف", "phone")->sortable(),
            Column::make(" البريد الاكتروني", "email")->sortable(),
            Column::make(" العنوان", "address")->sortable(),
            Column::make("اضيف بواسطة", "user.name")->sortable(),
            Column::make('تاريخ الانشاء', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
            Column::make('عدد المنتجات')
                ->label(function ($row) {
                    return $row->products_count;
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
                        ->location(fn($row) => route('supplier.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('supplier.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ]),
        ];
    }
}
