<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex flex-row-reverse p-2" >
                <input type="text" class="form-control" id="student-search" placeholder="Search by name or email">
            </div>
            <div id="student-results" class="row mt-0">
                <!-- Results will be displayed here dynamically -->
            </div>
            @if(Session::has('message'))
                <div class="alert {{ Session::get('alert-class') }} alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="d-flex flex-row-reverse p-2">
                <a href="{{route('student.create')}}">
                    <button class="btn btn-success">Create</button>
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($data as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->address}}</td>
                                <td>
                                    <span>
                                        <a href="{{route('student.edit', $row->id)}}">Edit</a>
                                    </span> |
                                    <span>
                                         <a href="{{route('student.destroy', $row->id)}}">Delete</a>
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
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#student-search').on('keyup', function() {
                    let query = $(this).val();
                    if (query.length > 0) {
                        // Perform the AJAX request
                        $.ajax({
                            url: '{{ route('student.search') }}',
                            method: 'GET',
                            data: { query: query },
                            success: function(response) {
                                // Update the results section with the response
                                $('#student-results').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    } else {
                        $('#student-results').empty();
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
