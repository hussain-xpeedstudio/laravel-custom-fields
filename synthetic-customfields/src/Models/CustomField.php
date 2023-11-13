<?php

namespace SyntheticCustomFields\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SyntheticCustomFields\Trait\CustomFieldTrait;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

class CustomField extends Model
{
    use HasFactory;
    use CustomFieldTrait;
    protected $fillable = [
        'model', 'entity', 'entity_id', 'customfield_structure'
    ];
    protected $collection = 'customfield_people';
    public  function setTable($tableName)
    {
        $this->table = $tableName;
    }

    public function scopeSetDatabase($query)
    {
        $this->table = $query->getQuery()->from;
        return $query;
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id', '_id')->from($this->table);
    }
}
