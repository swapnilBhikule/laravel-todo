@component('mail::message')
# Todo Added

Hi,
You've added new todo.

<strong>{{ $todo['task'] }}</strong>

@component('mail::button', ['url' => route('todo.index')])
View my List
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
