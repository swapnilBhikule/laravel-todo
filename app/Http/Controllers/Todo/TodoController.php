<?php

namespace App\Http\Controllers\Todo;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Jobs\SendNewTodoMail;
use App\Http\Controllers\Controller;

use App\Events\TodoCompleted;

class TodoController extends Controller
{
    /**
     * @var Todo
     */
    protected $model;

    /**
     * TodoController constructor
     *
     * @param  Todo $model
     * @return void
     */
    public function __construct(Todo $model)
    {
        $this->middleware('auth');

        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->model->where('user_id', '=', auth()->user()->id)->get();

        if (request()->wantsJson()) {
            return response()->json([
                'error' => false,
                'data'  => $todos->toArray(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => ['required', 'string', 'max:160']
        ]);

        $todo = $this->model->create([
            'user_id' => auth()->user()->id,
            'task' => $request->input('task')
        ]);

        $todo = $todo->toArray();

        if ($todo) {
            SendNewTodoMail::dispatch([
                'email' => auth()->user()->email,
                'data'  => $todo
            ]);

            return response()->json([
                'error' => false,
                'data'  => $todo
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Unable to insert new task.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'task'          => ['sometimes', 'required', 'string', 'max:160'],
            'is_complete'   => ['sometimes', 'required', 'digits_between:0, 1']
        ]);

        $update = [];
        if ($request->has('task')) {
            $update['task'] = $request->input('task');
        }
        if ($request->has('is_complete')) {
            $update['is_complete'] = $request->input('is_complete');
        }

        if (! $update) {
            return response()->json([
                'error' => true,
                'message' => 'Please provide valid data.'
            ]);
        }

        $flag = $this->model->where('id', '=', $id)
            ->where('user_id', '=', auth()->user()->id)
            ->update($update);

        if (! $flag) {
            return response()->json([
                'error' => true,
                'message' => 'Looks like this todo does not belongs to you.'
            ]);
        }

        if ($request->has('is_complete')) {
            event(new TodoCompleted([
                'user' => auth()->user()->name
            ]));
        }

        return response()->json([
                'error' => false,
                'message' => []
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $flag = $this->model->where('id', '=', $id)
            ->where('user_id', '=', auth()->user()->id)
            ->delete();

        if (! $flag) {
            return response()->json([
                'error' => true,
                'message' => 'Looks like this todo does not belongs to you.'
            ]);
        }

        return response()->json([
                'error' => false,
                'message' => []
            ]);
    }
}
