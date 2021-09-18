<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('jawaban', $diag->id)}}" method="post">
                        @csrf
                        <ul class="list-decimal">
                            @foreach ($tanya as $item)
                            @php
                             $tanya = $loop->index;   
                            @endphp
                            <li>
                                {{$item->tanya}}
                                <input type="hidden" name="tanya_id[{{$tanya}}]" value="{{$item->id}}">
                            </li>
                            
                                @foreach ($jawab as $items)
                                    <div class="flex items-center mr-4 mb-4">
                                        <input id="radio{{$item->id}}{{$items->id}}" type="radio" name="jawab_id[{{$tanya}}]" value="{{$items->id}}" />
                                        <label for="radio{{$item->id}}{{$items->id}}" class="flex items-center cursor-pointer text-xl">
                                        <span class="w-8 h-8 inline-block mr-2 rounded-full border border-grey flex-no-shrink"></span>
                                        {{$items->jawab}}</label>
                                   </div>
                                @endforeach
                            @endforeach
                        </ul>
                        <button class="mt-10 bg-blue-300" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>