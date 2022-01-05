<head>
<link rel="stylesheet" href="{{ asset('css/favorite.css') }}">
<link rel="icon" href="{{ asset('img/favicon.ico')}}">
</head>

<body>
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('お気に入り会話一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="border-gray-200 talk_container">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-grey-light talk_title">Favorite</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($messages as $message)
                @if($message->users()->where('user_id', Auth::id())->exists())
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-grey-light">
                <!-- 🔽 詳細画面へのリンク -->
                    <!-- <a href="{{ route('message.show',$message->id) }}"> -->
                    <a href="{{ route('message.edit',$message->id) }}">
                    <!-- <form action="{{ route('message.edit',$message->id) }}" method="GET" class="text-left"> -->
                        <!-- <p class="text-left text-grey-dark">{{$message->user->name}}</p> -->
                        <div class="talk_right"><h3 class="text">{{$message->message}}</h3></div>
                        <div class="talk_left">
                            <figure>
                              <img src="../img/ttora.jpg">
                            </figure>
                            <div class="talk_left-text">
                                <div class="name"><br>TORA</div>
                                    <h3 class="text">{{$message->reply}}</h3>
                                </div>
                        </div>
                    </a>
                    <!-- </form> -->
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
</body>
