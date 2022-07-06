<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use STS\Shuttle\Models\Concerns\HasUploads;

/**
 * @property mixed id
 */
class Folder extends Model
{
    use HasFactory;
    use HasUploads;
}
