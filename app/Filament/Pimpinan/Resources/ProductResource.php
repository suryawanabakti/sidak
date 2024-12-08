<?php

namespace App\Filament\Pimpinan\Resources;

use App\Filament\Pimpinan\Resources\ProductResource\Pages;
use App\Filament\Pimpinan\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')->image()->directory('products')->required()->columnSpan(2),
                TextInput::make('name')->required()->reactive()->afterStateUpdated(function ($state, callable $set) {
                    $set('slug', str()->slug($state));
                }),
                // 
                TextInput::make('slug'),
                Select::make('category_id')
                    ->label('Category')
                    ->options(\App\Models\Category::pluck('name', 'id')->toArray())
                    ->required()
                    ->placeholder('Select a category'),
                TextInput::make('price')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // Tambahkan tombol export ke header
                Action::make('export')
                    ->label('Export')
                    // ->icon('heroicon-o-download')
                    ->action(function () {
                        // Melakukan ekspor menggunakan Laravel Excel
                        return "test";
                    })
            ])
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Image')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->filters([
                Filter::make('price')
                    ->form([
                        TextInput::make('min_price')
                            ->label('Min Price'),
                        TextInput::make('max_price')
                            ->label('Max Price'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['min_price'])) {
                            $query->where('price', '>=', $data['min_price']);
                        }

                        if (!empty($data['max_price'])) {
                            $query->where('price', '<=', $data['max_price']);
                        }
                    }),
                SelectFilter::make('name')
                    ->label('Name')
                    ->options(
                        Product::pluck('name', 'name')
                    ),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->default(now()->subYear()),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->default(now())
                    ])
                    ->query(fn($query, array $data) => $query->when(
                        $data['start_date'] ?? false,
                        fn($query) => $query->where('created_at', '>=', $data['start_date'])
                    )
                        ->when(
                            $data['end_date'] ?? false,
                            fn($query) => $query->where('created_at', '<=', $data['end_date'])
                        )),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
