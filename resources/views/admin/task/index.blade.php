@extends('layouts.admin')

@section('title')
    Задачи
@endsection

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="mt-8">
            <a href="{{ route('admin.tasks.create') }}" class="text-gray-800 hover:text-gray-900">Добавить</a>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-2 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                #</th>
                            <th class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Заголовок</th>
                            <th class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Описание</th>
                            <th class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Дата начала</th>
                            <th class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Дата завершения</th>
                            <th class="px-6 py-3 text-center border-b border-gray-200 bg-gray-200 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Статус</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-200"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="px-2 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ $task->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ $task->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ $task->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ formatDate($task->start_datetime) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ formatDate($task->end_datetime) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                        <div class="text-sm leading-5 text-gray-900">{{ $task->status->name }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">   
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="text-green-900 hover:text-green-600">Редактировать</a>
                                        <br />
                                        <a href="#" data-id="{{ $task->id }}" class="text-red-600 hover:text-red-900 showConfirmation">Удалить</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div id="modalConfirmation" class="modal hidden fixed inset-0 w-full h-full bg-gray-800 bg-opacity-75 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white w-1/2 p-4 rounded-lg">
                <div class="mb-4 text-center">
                    <h5 class="font-semibold">Вы уверены, что хотите удалить задачу?</h5>
                    <h6 class="font-semibold">Все данные связанные с задачей, будут удалены без возможности восстановления!</h6>
                </div>
                <div class="flex justify-around  items-center mb-4">
                    <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Отмена</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" id="delete" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var modal = document.getElementById('modalConfirmation');
        document.querySelectorAll('.showConfirmation').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                var taskId = button.getAttribute('data-id');
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.action = '/admin/tasks/' + taskId;

                modal.classList.remove('hidden');
                modal.classList.add('d-block');
            })
        });

        var closeModalButton = document.getElementById('closeModal');
        closeModalButton.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('d-block');
        });
    </script>
@endsection