<!-- Modal -->
<div class="modal fade" id="update-todo" tabindex="-1" role="dialog" aria-labelledby="updateTodo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateTodoTitle">Add TODO</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form name="add-todo-form" method="post" @submit.prevent="updateTodo">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" name="task" class="form-control" v-model="updated_todo.task" required>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>