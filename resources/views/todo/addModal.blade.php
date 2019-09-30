<!-- Modal -->
<div class="modal fade" id="add-todo" tabindex="-1" role="dialog" aria-labelledby="addTodo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addTodoTitle">Add TODO</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form name="add-todo-form" method="post" @submit.prevent="addTodo">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" name="task" class="form-control" v-model="task" required>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>