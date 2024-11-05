@extends('layouts.admin')

@section('title')
    {{ isset($task) ? "Редактировать" : "Добавить" }} задачу
@endsection

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-2xl font-medium">{{ isset($task) ? "Редактировать ID {$task->id}" : 'Добавить' }}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-8">
            <form enctype="multipart/form-data" id="formId" class="space-y-5 mt-2" method="POST" action="{{ isset($task) ? route('admin.tasks.update', $task->id) : route('admin.tasks.store') }}">
                @csrf

                @if(isset($task))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <div class="space-y-5">
                        <div class="border rounded-lg p-4 shadow-sm bg-white">
                            <div class="mb-3">
                                <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                                <input type="text" name="title" id="title" 
                                    value="{{ old('title', isset($task) ? $task->title : '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                                <textarea name="description" id="description" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    rows="4">{{ old('description', isset($task) ? $task->description : '') }}</textarea>
                            </div>

                            @if(!isset($task))
                                <div class="mb-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="start_datetime" class="block text-sm font-medium text-gray-700">Дата и время начала задачи</label>
                                        <input type="datetime-local" name="start_datetime" id="start_datetime" 
                                            value="{{ old('start_datetime', isset($task) ? $task->start_datetime : '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="end_datetime" class="block text-sm font-medium text-gray-700">Дата и время конца задачи</label>
                                        <input type="datetime-local" name="end_datetime" id="end_datetime" 
                                            value="{{ old('end_datetime', isset($task) ? $task->end_datetime : '') }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            @endif

                            @if(isset($task))
                                <div class="mb-3">
                                    <select size="1" name="status_id" id="statusId"
                                        class="block w-full px-2.5 pb-2 pt-2 text-base text-gray-900 border border-gray-800 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">        
                                        <option selected disabled>Статус</option>
                                        @foreach($taskStatuses as $status)
                                            <option value="{{$status->id}}" @if(isset($task) && $task->task_status_id == $status->id) selected @endif />
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="text-center w-full bg-green-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection