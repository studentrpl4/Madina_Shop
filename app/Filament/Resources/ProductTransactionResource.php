<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTransactionResource\Pages;
use App\Filament\Resources\ProductTransactionResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductTransaction;
use Doctrine\DBAL\Schema\Schema;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductTransactionResource extends Resource
{
    protected static ?string $model = ProductTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                     Wizard\Step::make('Order')
                        ->schema([
                            Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $product = Product::find($state);
                                $price = $product ? $product->price : 0;
                                $quantity = $get('quantity') ?? 1;
                                $subTotalAmount = $price * $quantity;

                                $set('price', $price);
                                $set('sub_total_amount', $subTotalAmount);

                            })
                            ->afterStateHydrated(function (callable $get, callable $set, $state) {
                                $productId = $state;
                                if ($productId) {
                                    $product = Product::find($productId);
                                }
                            }),
                            TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->prefix('Qty')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $price = $get('price');
                                $quantity = $state;
                                $subTotalAmount = $price * $quantity;

                                $set('sub_total_amount', $subTotalAmount);

                            }),
                            TextInput::make('sub_total_amount')
                            ->required()
                            ->readOnly()
                            ->numeric()
                            ->prefix('IDR'),
                        ]),

                        Step::make('Customer Information')
                        ->schema([

                            Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('phone')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('email')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('address')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('city')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('post_code')
                                ->required()
                                ->maxLength(255),
                            ]),
                        ]),

                        Step::make('Payment Information')
                        ->schema([

                            TextInput::make('booking_trx_id')
                            ->required()
                            ->maxLength(255),

                            ToggleButtons::make('is_paid')
                            ->label("Apakah Sudah Membayar?")
                            ->boolean()
                            ->grouped()
                            ->icons([
                                true => 'heroicon-o-pencil',
                                false => 'heroicon-o-clock',
                            ])
                            ->required(),

                            FileUpload::make('proof')
                            ->image()
                            ->required(),
                            ]),
                ])
                ->columnSpan('full')
                ->columns(1)
                ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product.thumbnail'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('booking_trx_id')
                    ->searchable(),
                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Terverifikasi')
            ])
            ->filters([
                SelectFilter::make('product_id')
                    ->label('product')
                    ->relationship('product', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProductTransactions::route('/'),
            'create' => Pages\CreateProductTransaction::route('/create'),
            'edit' => Pages\EditProductTransaction::route('/{record}/edit'),
        ];
    }
}
