<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('jurusan_id')
                    // ini berelasi dengan file model (jurusan)
                    ->relationship('jurusan', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ngambil dari model mahasiswa yang proctacted
                // ini untuk fitur pencarian ->searchable() bisa di atruh di nim name dan lain lain
                // yang di pasang itu maka akan ada jika di cari di fitur sherc maka akan ketemu
                // untuk mebuat urutan bisa di pasang dimana saja ->sortable(),
                Tables\Columns\TextColumn::make('nim')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                // di model kan jurusan-id kalo jurusan_id.name 
                // gbisa bisa nya seperti ini
                Tables\Columns\TextColumn::make('jurusan.name')->searchable(),
            ])
            ->filters([
                // mau seperti ini 
                Tables\Filters\SelectFilter::make('jurusan_id')
                // ini berelasi dengan file model (jurusan)
                    ->relationship('jurusan', 'name'),
                
                // atau ini
                // normal dari filament nya
                // Tables\Filters\SelectFilter::make('type')
                // ->options([
                //     'cat' => 'Cat',
                //     'dog' => 'Dog',
                //     'rabbit' => 'Rabbit',
                // ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
