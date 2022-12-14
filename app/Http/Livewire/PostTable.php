<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;

    public function configure(): void
    {
//        $this->setDebugStatus(true);

        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['posts.id as id']);
        $this->setColumnSelectStatus(false);
    }


    public function columns(): array
    {

        return [
            Column::make("العنوان", "post_title")->searchable()->sortable(),
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
                        ->location(fn($row) => route('post.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('post.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ]),
        ];
    }

}
