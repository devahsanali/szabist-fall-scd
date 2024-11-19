<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class') }} alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="d-flex flex-row-reverse p-2">
                <a href="{{route('course.create')}}">
                    <button class="btn btn-success">Create</button>
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Credit Hrs</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($data as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->credit_hrs}}</td>
                                <td>
                                    <span>
                                        <a href="{{route('course.edit', $row->id)}}">Edit</a>
                                    </span> |
                                    <span>
                                         <a href="{{route('course.destroy', $row->id)}}">Delete</a>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
