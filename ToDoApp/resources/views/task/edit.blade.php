<!-- edit.blade.php -->
@extends('task.layout')

@section('content')
<div class="lg:w-2/4 mx-auto py-8 px-6 bg-white rounded-xl">
            <h1 class="font-bold text-5xl text-center mb-8">Edit Task</h1>

            <div class="mb-6">  
                <form class="flex flex-col space-y-4" method="POST" action="{{ route('task.updates', $task->id) }}">
                    @csrf

                    <input type="text" name="title" placeholder="Edit Task" class="py-3 px-4 bg-gray-100 rounded-xl" value='{{$task->title}}'>

                    <textarea name="description" placeholder="Task description" class="py-3 px-4 bg-gray-100 rounded-xl"></textarea>
                    <button class="w-28 py-2 px-2 bg-blue-500 text-white rounded-xl">Update Task</button>
                </form>
            </div>
                
@endsection
