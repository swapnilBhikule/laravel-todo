@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    My TODO

                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-todo">Add Todo</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group" v-if="todos.length > 0">
                        <li v-for="todo in todos" :key="todo.id" class="list-group-item d-flex justify-content-between align-items-center"
                            :class="todo.is_complete ? 'list-group-item-success' : ''">
                            @{{ todo.task }}
                            <div>
                                <button type="button" class="btn btn-outline-info btn-sm"
                                        @click="popupUpdateModal(todo.id)" v-if="! todo.is_complete">
                                    Update
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm"
                                        @click="update(todo.id, 1)" v-if="! todo.is_complete">
                                    Mark Complete
                                </button>
                                <button type="button" class="btn btn-outline-dark btn-sm"
                                        @click="update(todo.id, 0)" v-else>
                                    Mark Incomplete
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        @click="destroy(todo.id)">
                                    x
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('todo.addModal')
    @include('todo.updateModal')
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection