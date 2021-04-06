<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class SearchModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function scopeSearch($query, $params = [])
    {

        $params = $this->getCleanedParams($params);
        foreach ($params as $attribute => $value) {
            if (\Str::contains($attribute, '.')) {
                $relationSearchArr = explode('.', $attribute);
                $attribute = array_pop($relationSearchArr);
                $relationStr = implode('.', $relationSearchArr);
                $query->whereHas($relationStr, function ($q) use ($attribute, $value) {
                    if ($value === 'null') {
                        $q->whereNull($attribute);
                    } else {
                        $q->where($attribute, 'LIKE', "%{$value}%");
                    }
                });
            } elseif (\Schema::hasColumn($this->getTable(), $attribute)) {
                if ($value === 'null') {
                    $query->whereNull($attribute);
                } else {
                    $query->where($attribute, 'LIKE', "%{$value}%");
                }

            }
        }

        if (isset($params['sort_by']) && $params['sort_by']) {
            self::scopeSorting($query, $params['sort_by'], $params['sorting_direction']);
        }
    }

    public function scopeSorting($query, $sortBy, $sortDir = 'asc')
    {
        if (strpos($sortBy, '.') !== false) {
            $sortArr = explode('.', $sortBy);
            $sortBy = array_pop($sortArr);
            $selfTable = $this->getTable();
            $thisModel = $this;
            $select = [$selfTable . '.*'];
            foreach ($sortArr as $k => $rel) {
                $relation = $thisModel->$rel();
                $relatedModel = $relation->getRelated();
                $relatedTable = $relatedModel->getTable();
                $selfTable = $relatedTable;
                if ($k == count($sortArr) - 1) {
                    $select[] = $selfTable . '.' . $sortBy . ' as orderBy';
                } else {
                    $select[] = $selfTable . '.id as id' . $k;
                }
                $thisModel = $relatedModel;
            }
            $selfTable = $this->getTable();
            $thisModel = $this;
            $query->select($select);
            foreach ($sortArr as $k => $rel) {
                $relation = $thisModel->$rel();
                $relatedModel = $relation->getRelated();
                $relatedTable = $relatedModel->getTable();

                $foreignKey = $relatedModel->getForeignKey();

                $query->leftJoin($relatedTable, function ($join) use ($selfTable, $relatedTable, $relatedModel, $foreignKey) {
                    $join->on($relatedModel->getQualifiedKeyName(), '=', $selfTable . '.' . $foreignKey);
                });
                $thisModel = $relatedModel;
                $selfTable = $relatedTable;
            }

            $query->orderBy('orderBy', $sortDir);
        } else {
            $query->orderBy($sortBy, $sortDir);
        }
    }

    //eliminates whitespaces, tabs, and stuff that may copy-pasted into the field
    protected function getCleanedParams(array $params = [])
    {
        if (!empty($params)) {
            $params = array_map(function ($value) {
                return is_string($value) ? trim(preg_replace('!\s+!', '', $value)) : $value;
            }, $params);
            $filtered = array_filter($params, function ($value) {
                return $value !== '';
            });
            return \Arr::dot($filtered);
        }

        return null;
    }
}

