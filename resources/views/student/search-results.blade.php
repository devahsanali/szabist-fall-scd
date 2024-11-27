@if($students->isEmpty())
    <p>No students found.</p>
@else
    <ul class="list-group">
        @foreach($students as $student)
            <li class="list-group-item">
                <strong>{{ $student->name }}</strong> ({{ $student->email }})
            </li>
        @endforeach
    </ul>
@endif
