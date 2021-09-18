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
                    <form action="{{route('diagnosa.store')}}" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="user_id" value="{{auth()->user()->id}}"> --}}
                        <button onclick="return confirm(`Siap untuk diagnosa ?`)" type="submit">Diagnosa Sekarang</button>
                    </form>
                </div>
                <div>
                    <ul>
                        @foreach ($diag as $item)
                        <li>
                            <a href="{{route('diagnosa.show', $item->id)}}">{{$item->id}}</a>
                        </li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>