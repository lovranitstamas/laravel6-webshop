<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    public function attachable()
    {
        return $this->morphTo();
    }

    public function addFile($file)
    {
        if (isset($file) && $file && is_file($file)) {
            $this->filename = Carbon::now()->timestamp . uniqid() . "." . $file->getClientOriginalExtension();
            $this->path = \Storage::disk('dev')->put('/', $file, ['name' => $this->filename]);
            $this->original_filename = $file->getClientOriginalName();
            $this->size = $file->getSize();
            $this->mimetype = $file->getMimeType();
        }
    }

    public function publicUrl()
    {
        return \Storage::disk('dev')->url($this->path);
    }
}

