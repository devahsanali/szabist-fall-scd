<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @php($route = isset($data) ? route('enrollment.update') : route('enrollment.store'))
                    <form method="post" action="{{$route}}">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="student" class="form-label">Student:</label>
                            <select class="form-control @error('student_id') is-invalid @enderror"
                                    id="student_id"  name="student_id">
                                @foreach($students as $student)
                                    <option
                                        @if(isset($data) && $student->id == $data->pluck('student_id')->first()) selected @endif
                                    value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>

                            @error('student_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="course" class="form-label">Course:</label>
                            <select class="form-control select2 @error('course_id') is-invalid @enderror"
                                    id="course_id"  name="course_id[]" multiple="multiple">
                                @foreach($courses as $course)
                                    <option
                                        @if(isset($data) && in_array($course->id, $data->pluck('course_id')->toArray()))
                                        selected
                                        @endif
                                        value="{{ $course->id }}">
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_io')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
