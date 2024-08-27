@extends('app.app')

@section('content')
    <div class="flex flex-row min-h-36 justify-center items-center break-all">

        <form action="{{ route('index') }}" method="POST">
            @csrf
            @method('POST')

            <div class="inline-block relative w-64 mb-6">
                <select 
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                id="service"
                name="service"
                >
                <option>products</option>
                <option>recipes</option>
                <option>posts</option>
                <option>users</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            <div class="mb-6">
                <div id="inputs">
                </div>
            </div>

            <div>
                <input type="submit" name="btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="GET">
                <input type="submit" name="btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="POST">
            </div>

            @if(Session::has('success'))
                <div style="color: green">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="color: red">
                    {{ $errors->first() }}
                </div>
            @endif
        </form>
    </div>

    <pre>
        @if(Session::has('data'))
            {{ session()->get('data') }}
        @endif
    </pre>
@endsection