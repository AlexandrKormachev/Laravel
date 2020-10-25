<?php


namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;


class BlogPostRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'user_id',
            'category_id',
            'published_at'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['category' => function ($query) {
                $query->select(['id', 'title']);
               },
                'user:id,name'
            ])
            ->orderBy('id', 'DESC')
            ->paginate(25);

        return $result;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
