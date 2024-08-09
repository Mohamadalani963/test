<?php

namespace App\Repos;

use App\Exceptions\Errors;
use App\Models\Category;

class CategoryRepo extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    protected $filters = [
        'name' => 'equal',
        'id' => 'equal',
    ];

    public function store($data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/categories');
        }
        $item = parent::store($data);

        return $item;
    }

    public function update($id, $data, $attr = null)
    {
        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('public/categories');
        }
        $item = parent::update($id, $data);

        return $item;
    }

    public function delete($id, $attr = null)
    {
        $category = $this->findOrFail($id);
        if ($category->offers->count() > 0) {
            Errors::RelatedResourceExisted('Category have related offers delete those offers and Try Again', 'Category have related offers delete those offers and Try Again');
        }
        $category->delete();
    }
}
