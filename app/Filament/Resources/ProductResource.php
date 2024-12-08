<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;

use App\Models\Product;
use Filament\Actions\Modal\Actions\Action;
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



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master Data';

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
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->placeholder('Select a category'),
                TextInput::make('price')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
