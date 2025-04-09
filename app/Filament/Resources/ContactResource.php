<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('design_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('organization_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slogan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('color_preference'),
                Forms\Components\TextInput::make('logo_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('additional_logo_services')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_formats'),
                Forms\Components\TextInput::make('occupation')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_or_draft')
                    ->image(),
                Forms\Components\Textarea::make('additional_info')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('advance_payment')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_option')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('transaction_screenshot')
                    ->maxLength(255),
                Forms\Components\TextInput::make('reference_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('services'),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('mobile_number')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('email')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('design_name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('organization_type')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('slogan')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('logo_type')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('additional_logo_services')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('occupation')
    //                 ->searchable(),
    //             Tables\Columns\ImageColumn::make('image_or_draft'),
    //             Tables\Columns\TextColumn::make('advance_payment')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('payment_option')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('transaction_number')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('transaction_screenshot')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('reference_name')
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('created_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //             Tables\Columns\TextColumn::make('updated_at')
    //                 ->dateTime()
    //                 ->sortable()
    //                 ->toggleable(isToggledHiddenByDefault: true),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mobile_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('design_name')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('organization_type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slogan')
                    ->searchable()
                    ->limit(25)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('logo_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '3D' => 'success',
                        'Flat' => 'warning',
                        'Minimal' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('additional_logo_services')
                    ->searchable()
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('occupation')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\ImageColumn::make('image_or_draft')
                    ->disk('public')
                    ->width(80)
                    ->height(80)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('advance_payment')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_option')
                    ->searchable()
                    ->limit(25),

                Tables\Columns\TextColumn::make('transaction_number')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Transaction number copied'),

                Tables\Columns\ImageColumn::make('transaction_screenshot')
                    ->disk('public')
                    ->width(100)
                    ->height(100)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('reference_name')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('color_preference')
                    ->listWithLineBreaks()
                    ->toggleable()
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('file_formats')
                    ->listWithLineBreaks()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('services')
                    ->listWithLineBreaks()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
