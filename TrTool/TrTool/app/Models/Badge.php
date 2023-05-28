<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'unicode'];

    public function displayBadge()
    {
        return $this->unicodeToEmoji($this->unicode);
    }

    private function unicodeToEmoji($unicode) 
    {
        $code = explode('-', $unicode);
        $emoji = '';
        foreach ($code as $char) {
            $emoji .= '&#x' . $char . ';';
        }
        return mb_convert_encoding($emoji, 'UTF-8', 'HTML-ENTITIES');
    }
}
