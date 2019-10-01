import Preloader from '../components/Preloader';

new Vue({
	components: {Preloader},
	el: '#app',
	data: {
		todos: [],
		task: '',
		updated_todo: {
			task: ''
		},
		ajax_loading: true
	},
	mounted() {
		this.loadInitialData();
	},
	methods: {
		loadInitialData() {
			axios.get('/todo')
				.then(response => {
					this.ajax_loading = false;

					if (response.status === 200 && response.data.error === false) {
						this.todos = response.data.data;
					}
				})
				.catch(error => {
					this.ajax_loading = false;

					console.log(error);
				});
		},
		addTodo() {
			if (this.task.length === 0) {
				alert('Please enter task!');

				return;
			}

			this.ajax_loading = true;

			axios.post('/todo', {
				task: this.task
			})
				.then(response => {
					this.ajax_loading = false;

					if (response.status === 200 && response.data.error === false) {
						this.todos.push(response.data.data);
						this.task = '';

						$("#add-todo").modal('hide');
					}
				})
				.catch(error => {
					this.ajax_loading = false;

					console.log(error);
				});
		},
		update(id, is_complete) {
			axios.patch('/todo/' + id, {
				is_complete: is_complete
			})
				.then(response => {
					if (response.status === 200 && response.data.error === false) {
						let todos = this.todos;
						let index = _.findIndex(todos, {id: id});

						todos[index].is_complete = parseInt(! is_complete);
						this.todos = todos;

						alert('Your todo is successfully updated!');
					}
				});
		},
		popupUpdateModal(id) {
			let todo = _.find(this.todos, {id: id});

			if (typeof todo === 'undefined') {
				return;
			}

			this.updated_todo = _.cloneDeep(todo);

			$("#update-todo").modal('show');
		},
		updateTodo() {
			axios.patch('/todo/' + this.updated_todo.id, {
				task: this.updated_todo.task
			})
				.then(response => {
					if (response.status === 200 && response.data.error === false) {
						let todos = this.todos;
						let index = _.findIndex(todos, {id: this.updated_todo.id});

						todos[index].task = this.updated_todo.task;
						this.todos = todos;

						alert('Your todo is successfully updated!');

						this.updated_todo = {
							task: ''
						};
						$("#update-todo").modal('hide');
					}
				})
				.catch(error => {
					console.log(error);
				});
		},
		destroy(id) {
			axios.delete('/todo/' + id)
				.then(response => {
					if (response.status === 200 && response.data.error === false) {
						let index = _.findIndex(this.todos, {id: id});

						this.todos.splice(index, 1);

						alert('Your todo is successfully deleted!');
					}
				})
				.catch(error => {
					console.log(error);
				});
		}
	}
});