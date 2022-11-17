<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
    }

    public function columns(): array
    {
        return [
            Column::make("Post title", "post_title")
                ->searchable()->sortable(),
            ImageColumn::make("image", "featured_image")
                ->location(fn($row) => storage_path('app/public/avatars/' . $row->id . '.jpg'))
                ->attributes(fn($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->post_title . ' Image',
                ]),
            Column::make('post_title')
                ->format(
                    fn($value, $row, Column $column) => '<strong>'.$row->id .'</strong>'
                )->html(),
            BooleanColumn::make("Status", "status")
                ->sortable(),
            Column::make("Category", "category.category_name")
                ->searchable()->sortable(),
            Column::make("User", "user.name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                    ->title(fn($row) => 'View ' )
                        ->location(fn($row) => route('post.index'))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit ')
                        ->location(fn($row) => route('post.index'))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                ]),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }
}
