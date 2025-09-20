<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation; // Kembali di sini
use Maatwebsite\Excel\Concerns\Importable;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class PendudukImport extends DefaultValueBinder implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithCustomValueBinder, WithValidation // Implement WithValidation
{
    use Importable;

    public function bindValue(Cell $cell, $value)
    {
        $column = $cell->getColumn();
        
        if ($column === 'A' || $column==='B'|| $cell->getDataType() == DataType::TYPE_STRING) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
    
    public function model(array $row)
    {
        // Dengan WithValidation, kita tidak perlu validasi manual di sini
        // Data yang masuk ke sini sudah pasti valid
        return new Penduduk([
            'nik'                 => trim($row['nik']),
            'no_kk'               => trim($row['no_kk'] ?? ''),
            'nama'                => trim($row['nama'] ?? ''),
            'jenis_kelamin'       => trim($row['jenis_kelamin'] ?? ''),
            'agama'               => trim($row['agama'] ?? ''),
            'alamat_tanggallahir' => trim($row['alamat_tanggallahir'] ?? ''),
        ]);
    }
    
    public function rules(): array
    {
        return [
            'nik' => 'required|string|size:16|unique:penduduk,nik|regex:/^[0-9]+$/',
            'no_kk' => 'required|string|size:16|regex:/^[0-9]+$/',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P,l,p',
            'agama' => 'required|string|max:50',
            'alamat_tanggallahir' => 'required|string',
        ];
    }
    
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}