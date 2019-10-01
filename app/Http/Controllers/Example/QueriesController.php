<?php

namespace App\Http\Controllers\Example;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Todo;

class QueriesController extends Controller
{
	/**
	 * @var User
	 */
	protected $user;
	/**
	 * @var Todo
	 */
	protected $todo;

	/**
	 * QueriesController constructor
	 *
	 * @param User $user
	 * @param Todo $todo
	 */
	public function __construct(User $user, Todo $todo)
	{
		$this->user = $user;
		$this->todo = $todo;
	}

	public function query()
	{
		# select all from table
		$todos = $this->todo->all();
		dump($todos->toArray());

		# select particulat columns
		$todos = $this->todo->select('task')->get();
		dump($todos->toArray());

		# Get single column after executing query
		$todos = $this->todo->select('id', 'task')->get()->pluck('task');
		dump($todos->toArray());

		# Return only one row
		$todos = $this->todo->select('id', 'task')->where('id', '>', 11)->first();
		dump($todos->toArray());

		$todos = $this->todo->select('id', 'task')
			->where('id', '>', 8)->where('id', '<', 20)
			->get();
		dump($todos->toArray());

		$todos = $this->todo->select('id', 'task')
			->whereBetween('id', [8, 20])
			->get();
		dump($todos->toArray());

		$todos = $this->todo->select('id', 'task')
			->whereIn('id', [8, 20])
			->get();
		dump($todos->toArray());

		$todos = $this->todo->select('todos.id', 'todos.task', 'users.name')
			->join('users', 'users.id', '=', 'todos.user_id')
			->get();
		dump($todos->toArray());

		$todos = $this->todo->select('todos.id', 'todos.task', 'users.name')
			->join('users', function($join) {
				return $join->on('users.id', '=', 'todos.user_id')
					->where('todos.id', '>', 8);
			})
			->get();
		dump($todos->toArray());

		$todos = $this->todo->select('id', 'task')
			->where('task', 'like', '%Todo%')
			->where(function ($condition) {
				return $condition->where('id', '>', 8)
					->orWhere('id', '<', 20);
			})
			->toSql();
		dump($todos);

		$todos = $this->todo->where('id', '>', 10)->count();
		dump($todos);

		$todos = $this->todo->select(\DB::raw('COUNT(id)'), 'task')
			->where('id', '>', 10)
			->get();
		dump($todos->toArray());

		$first = $this->user->select('id', 'name as task');

		$todos = $this->todo->select('id', 'task')
			->union($first)
			->get();
		dump($todos->toArray());
	}
}