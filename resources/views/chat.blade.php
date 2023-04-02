@extends('adminlte::page')

@section('title', 'Chat Message')

@section('content_header')
    <h1 class="m-0 text-dark">Chat Message</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-adminlte-card title="Contact Message" theme="success" icon="fas fa-chat" collapsible>
                @php
                    $heads = ['ID', 'Name', 'Status'];
                @endphp
                <x-adminlte-datatable id="table1" :heads="$heads" hoverable compressed>
                    @foreach ($chat_sessions as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a href="{{ route('chat.index') }}?number={{ $item->number }}">
                                    {{ $item->contact }}
                                </a>
                                <br>
                                {{ $item->number }}
                            </td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </x-adminlte-card>
        </div>
        @if ($chats != null)
            <div class="col-md-8">
                <x-adminlte-card title="Chat Message - Marwan" theme="success" icon="fas fa-chat" collapsible maximizable>
                    <div class="direct-chat-messages">
                        @foreach ($chats as $chat)
                            @if ($chat->direct == 'in')
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">{{ $chat->contact }}</span>
                                        <span
                                            class="direct-chat-timestamp float-right">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                    <img class="direct-chat-img" src="{{ asset('user.jpg') }}" alt="Message User Image">
                                    <div class="direct-chat-text">
                                        <pre>{{ $chat->message }}</pre>
                                    </div>
                                </div>
                            @else
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right">{{ $chat->username }}</span>
                                        <span
                                            class="direct-chat-timestamp float-left">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                    <img class="direct-chat-img" src="{{ asset('user.jpg') }}" alt="Message User Image">
                                    <div class="direct-chat-text">
                                        {{ $chat->message }}
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <x-slot name="footerSlot">
                        <form action="{{ route('chat.store') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="number" value="{{ $request->number }}">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-success">Send</button>
                                </span>
                            </div>
                        </form>
                    </x-slot>
                </x-adminlte-card>
            </div>
        @endif

    </div>
@stop

@section('plugins.Datatables', true)
