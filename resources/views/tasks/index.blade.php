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
                    <form action="{{ route('tasks.onoff', ['id' => $task->id]) }}" method="post">
                        @csrf
                        <input type="checkbox" name="isDone" {{ $task->isDone ? 'checked' : '' }}
                            onchange="this.form.submit()" />
                    </form>
                </div>

                <button type="button" class="btn btn-danger" onclick="showDeleteModal({{ $task->id }})">
                    Delete Task
                </button>


                <div id="deleteModal" class="modal invisible" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this task?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('tasks.delete', ['id' => 0]) }}" method="post" id="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>

<script>
    const modal = document.getElementById('deleteModal');
    let taskId = 0;
    let form = document.getElementById("form-delete");
    console.log(form);

    function showDeleteModal(taskModalId) {
        // Show the modal
        taskId = taskModalId;
        let action = form.action;
        modal.classList.toggle("invisible");
    }
    // Attach a click event to the cancel button in the modal to hide it
    const cancelButton = modal.querySelector('.btn-secondary');
    cancelButton.addEventListener('click', function() {
        modal.classList.toggle("invisible");
    });
</script>
