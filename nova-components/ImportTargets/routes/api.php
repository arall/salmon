<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\Target;
use App\Models\Department;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::post('/', function (Request $request) {
    $path = $request->csv->store('csv');

    $csv = Reader::createFromPath(storage_path('app/' . $path), 'r');
    $csv->setDelimiter(';');
    $csv->setHeaderOffset(0);
    $records = (new Statement())->process($csv);

    $header = $csv->getHeader();
    if (!in_array('Name', $header) || !in_array('Email', $header)) {
        abort(400, 'CSV is not compatible');
        Storage::delete($path);
        return;
    }

    $total = 0;
    $new = 0;
    foreach ($records as $record) {
        $target = Target::firstOrNew(['email' => $record['Email']]);
        if (!$target->id) {
            $new++;
        }
        if ($record['Name']) {
            $name = $record['Name'];
            if (strstr($name, ',')) {
                $parts = explode(',', $name);
                $parts = array_reverse($parts);
                $name = implode(' ', $parts);
                $name = trim($name);
            }
            $target->name = $name;
        }
        $target->save();
        $total++;

        if (isset($record['Department'])) {
            $department = Department::firstOrCreate(['name' => $record['Department']]);
            $target->departments()->syncWithoutDetaching([$department->id]);
        }
    }

    return [
        'message' => $total . ' targets imported (' . $new . ' new)',
    ];
});
