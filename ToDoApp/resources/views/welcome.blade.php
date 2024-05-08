<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To-Do List</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href= "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>

        <!-- Styles -->
        <style>
            body{
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-white-200 py-4 ">
        <div class="lg:w-2/4 mx-auto py-4 px-20 bg-white">
            <h1 class="font-bold text-5xl text-center mb-8 mt-8">To-Do List</h1>

            <div class="mb-6">  
                <form class="flex flex-col space-y-4" method="POST" action="/">
                    @csrf

                    <input type="text" name="title" placeholder="Add Task" class="rounded-xl font-bold py-3 px-4 bg-blue-100">
                    <textarea name="description" placeholder="Task description" class="rounded-xl py-3 px-4 bg-blue-100"></textarea>
                    <button class="w-28 py-2 px-4 bg-blue-500 text-white rounded-xl font-bold">Add Task</button>
                </form>
            </div>

            <hr>

            <div class="nt-2">
                @foreach ($task as $tasks)
                    <div 
                        @class([
                            'py-4 flex items-center border-b border-gray-300 px-3',
                            $tasks->completed ? 'line-through bg-red-200' : ''
                            ])
                    >
                        <div class="flex-1 pr-8">
                            <h3 class="text-lg font-semibold">{{$tasks->title}}</h3>
                            <p class="text-gray-500">{{$tasks->description}}</p>
                        </div>

                        <div class="flex space-x-3">
                            <form method="POST" action="/{{$tasks->id}}">
                                @csrf
                                @method('PUT')

                                <button class="py-2 px-2 bg-blue-500 text-white rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                            </form>

                            <!-- <p>{{ $tasks->title }}</p>
                            <p>{{ $tasks->description }}</p>     -->
                            <form method="POST" action="{{ route('task.edit', $tasks->id) }}">
                                @csrf
                                @method('GET')

                                <button class="py-2 px-2 text-white rounded-xl bg-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </button>
                            </form>

                            <form method="POST" action="/{{$tasks->id}}">
                                @csrf
                                @method('DELETE')

                                <button class="py-2 px-2 bg-red-500 text-white rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach    
            </div>
        </div>
    </body>
</html>
