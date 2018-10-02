<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class PostRepository implements PostRepositoryInterface
{

	// model property on class instances
    protected $model;

    public function __construct(Model $model) 
    {
    	$this->model = $model;
    }

	public function all() 
	{
        return $this->model->whereNull('reply_to')->orderBy('updated_at', 'desc')->get();
	}

    public function create(array $data) 
    {

    }

    public function update(array $data, $id) 
    {

    }

    public function delete($id) 
    {

    }

    public function show($id) 
    {

    }
}