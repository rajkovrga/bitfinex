@extends('layout.content')
@section('content')

<div class="flex flex-col items-center">
    <H1 class="text-2xl py-10">Teletrader project</H1>

    <div class="w-2/3 mx-auto">
        <div class="bg-white shadow-md rounded my-6">
            <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
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
                <tbody>
                @foreach($data as $d)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{substr($d[0], 1)}}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$d[1]}}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$d[2]}}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light"> {{$d[6] * 100}}%
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$d[9]}}
                        </td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$d[10]}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
