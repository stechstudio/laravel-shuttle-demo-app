<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use STS\Shuttle\Models\Concerns\HasUploads;
use STS\Shuttle\Models\Upload;

/**
 * @property mixed id
 * @property mixed uploads
 */
class Folder extends Model
{
    use HasFactory;
    use HasUploads;
}
