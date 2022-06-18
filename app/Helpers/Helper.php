<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

function set_active($route)
{
    if (Route::is($route)) {
        return 'active';
    }
}
function uploadFile($file, $folder)
{
    $ext = $file->getClientOriginalExtension();
    if ($file->isValid()) {
        $file_name = $folder . '_' . date('YmdHis') . ".$ext";
        $file->storeAs($folder, $file_name, 'public');
        return $file_name;
    }
    return false;
}