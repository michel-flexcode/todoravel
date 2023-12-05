<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todoravel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        <h2>Create a New Task</h2>

        <form action="{{ route('tasks.store') }}" method="post">
            @csrf

            <div>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" required>
            </div>

            <div>
                <label for="isDone">Status:</label>
                <select name="isDone" id="isDone" required>
                    <option value="0">Incomplete</option>
                    <option value="1">Completed</option>
                </select>
            </div>

            <button type="submit">Create Task</button>
        </form>
    </div>

    <h2>Tasks for {{ Auth::user()->name }}</h2>
    <ul>
        @foreach (Auth::user()->tasks as $task)
            <li>
                <div>
                    <strong>Description:</strong> {{ $task->description }}
                </div>
                <div>
                    <strong>Status:</strong> {{ $task->isDone ? 'Completed' : 'Incomplete' }}
                </div>
                <form action="{{ route('tasks.delete', ['id' => $task->id]) }}" method="post">
                    @csrf
                    @method('delete')

                    <div>
                        <button type="submit">Delete</button>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
