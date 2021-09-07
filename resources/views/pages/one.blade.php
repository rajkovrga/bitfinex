@extends('layout.content')
@section('script')
    <script src="{{asset('js/app/one.js')}}"></script>
@endsection
@section('content')

    <div class="flex flex-col items-center">
        <H1 class="text-2xl py-10">{{substr($data[0], 1)}}</H1>
        @if(session('error'))
            {{ session('error') }}
        @endif
        <input type="hidden" name="name" value="{{substr($data[0], 1)}}">
        <div class="w-2/3 mx-auto">
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                    <tr>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Last</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Change</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Change Percent</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">High</th>
                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Low</th>
                    </tr>
                    </thead>
                    <tbody id="list">
                        <tr class="hover:bg-grey-lighter" >
                            <td class="py-4 px-6 border-b border-grey-light"> {{substr($data[0], 1)}}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$data[1]}}
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$data[2]}}
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light"> {{$data[6] * 100}}%
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$data[9]}}
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$data[10]}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-2/3 mx-auto flex flex-row justify-between	 items-center">
            @if(!str_contains(\Illuminate\Support\Facades\Redis::get('types'), $d[0]))
                <a href="/add/{{$d[0]}}"  class="px-3 py-1 whitespace-nowrap bg-blue-500 border-2 rounded-lg text-gray-100 font-medium hover:text-gray-900">
                    Add to favorites
                </a>
            @else
                <a href="/remove/{{$d[0]}}" class="px-3 py-1 whitespace-nowrap bg-red-500 border-2 rounded-lg text-gray-100 font-medium hover:text-gray-900">
                    Remove from favorites
                </a>
            @endif
        </div>
    </div>

@endsection
