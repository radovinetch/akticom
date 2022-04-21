<?php

namespace App\Http\Controllers;

use App\Http\Requests\CSVFillRequest;
use App\Models\CSVModel;
use App\Models\CSVModelRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{
    public function result(CSVFillRequest $request)
    {
        $validated = $request->validated();
        /** @var UploadedFile $file */
        $file = $validated['file'];
        Storage::putFileAs('/public/csv/', $file, $file->getClientOriginalName());
        $path = Storage::path(DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . $file->getClientOriginalName());

        $resource = fopen($path, 'r');
        $fields = [];
        $repository = new CSVModelRepository();

        $row = 0;

        while (($data = fgetcsv($resource, null, ';', ',')) !== false) {
            $row++;
            $count = count($data);
            if (empty($fields)) { //Получаем структуру CSV файла
                for ($i = 0; $i < $count; $i++) {
                    $fields[$i] = $data[$i];
                }
            } else {
                $modelFields = [];
                for ($i = 0; $i < $count; $i++) {
                    if (!isset($fields[$i])) {
                        continue 2; // некоторые записи в CSV файле не соответствуют структуре модели из-за ; в описании
                    }
                    $modelFields[$fields[$i]] = $data[$i];
                }

                $repository->add(new CSVModel($modelFields));
            }
        }

        $models = $repository->getRepository();

        Storage::delete($path);

        return view('result', ['models' => $models, 'fields' => $fields]);
    }
}
