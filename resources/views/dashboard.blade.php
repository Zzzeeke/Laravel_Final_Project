<x-app-layout>
    
    <div class="bg-gray-100 flex flex-col items-center min-h-screen">
        @include('partials.header')

        <div class="w-full max-w-4xl mt-6">
            <!-- Add Button -->
            <div style="text-align: center; margin-top: 24px;">
                <a href="{{ route('create_todo') }}">
                    <button style="padding: 12px 24px; background-color: #3b82f6; border: 4px solid #1d4ed8; color: white; font-weight: bold; border-radius: 0.375rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        Create
                    </button>
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Incomplete Tasks -->
            <div class="mb-6 pl-20"> 
                <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">To-Do List</h2>
                <ul style="padding: 0; list-style-type: none;"> 
                    @foreach ($incompleteTodos as $todo)
                        <li style="width: 60%; max-width: 300px; background-color: #3cabc9; border: 1px solid #3cabc9; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; margin-bottom: 16px; padding: 16px; margin-left: auto; margin-right: auto;">
                            <div class="flex items-center justify-center mb-4" style="text-align: center;">
                                <div class="flex items-center justify-center">
                                    <input type="checkbox" 
                                        id="todo-{{ $todo->id }}" 
                                        {{ $todo->completed ? 'checked' : '' }}
                                        onclick="document.getElementById('complete-form-{{ $todo->id }}').submit();"
                                        style="margin-right: 8px;">
                                    <label for="todo-{{ $todo->id }}" class="{{ $todo->completed ? 'line-through text-black-500' : '' }}" style="font-weight: 600; text-align: center;">
                                        {{ $todo->title }}
                                    </label>
                                </div>
                                <form id="complete-form-{{ $todo->id }}" action="{{ route('todos.complete', $todo->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                            </div>
                            <div style="font-size: 0.875rem; color: #000;">
                                @if ($todo->description)
                                    <p style="margin-bottom: 8px;"><strong>Description:</strong> {{ $todo->description }}</p>
                                @endif
                                <p style="margin-bottom: 4px;"><strong>Date:</strong> {{ $todo->date->format('F j, Y') }}</p>
                                <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($todo->time)->format('g:i A') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Completed Tasks -->
            <div class="mb-6 pl-20">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-black-200 leading-tight">Completed List</h2>
                <ul style="padding: 0; list-style-type: none;"> 
                    @foreach ($completedTodos as $todo)
                        <li class="flex flex-col px-4 py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="todo-{{ $todo->id }}" 
                                           onclick="document.getElementById('complete-form-{{ $todo->id }}').submit();"
                                           class="mr-3" 
                                           checked>
                                    <label for="todo-{{ $todo->id }}" class="line-through text-gray-500">
                                        {{ $todo->title }}
                                    </label>
                                </div>
                                <form id="complete-form-{{ $todo->id }}" action="{{ route('todos.complete', $todo->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('POST')
                                </form>
                            </div>
                            <div class="mt-2 text-gray-600">
                                @if ($todo->description)
                                    <p>Description: {{ $todo->description }}</p>
                                @endif
                                <p>Date: {{ $todo->date->format('F j, Y') }}</p>
                                <p>Time: {{ $todo->time }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @include('partials.footer')
    </div>
</x-app-layout>
