@extends('dashboard.partials.layout')

@section('container')
<style>
    ::-webkit-scrollbar {
        width: 10px
    }

    ::-webkit-scrollbar-track {
        background: #eee
    }

    ::-webkit-scrollbar-thumb {
        background: #888
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555
    }

    .wrapper-admin {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main {
        background-color: #eee;
        width: 100%;
        position: relative;
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 6px 0px 0px 0px
    }

    .scroll {
        overflow-y: scroll;
        scroll-behavior: smooth;
        height: 325px
    }

    .name {
        font-size: 8px
    }

    .msg {
        background-color: #fff;
        font-size: 11px;
        padding: 5px;
        border-radius: 5px;
        font-weight: 500;
        color: #3e3c3c
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Dashboard Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div style="overflow-x:auto;">
            <div class="d-flex justify-content-center container mt-5">
                <div class="wrapper-admin">
                    <div class="main">
                        <div class="px-2 scroll" id="message">
                        </div>
                        <form id="form" class="navbar bg-white navbar-expand-sm d-flex justify-content-between">
                            <input type="text number" name="text" class="form-control" placeholder="Type a message...">
                            <button class="btn btn-success">
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



@php
    $userId = Auth::id() ?? 1;
@endphp
{{-- Load pusher library --}}
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Get chat from API
    const getChat = async () => {
        const response = await fetch('/chat/get/{{ $room->id }}')
        const data = await response.json()

        // Print chat
        let chatsHTML = ''

        data.map(r => {
            chatsHTML += `
                <div class="d-flex align-items-center
                    ${r.user_id == "{{ $userId }}" ? 'text-right justify-content-end' : ''}">
                    <div class="pr-2 ${r.user_id == "{{ $userId }}" ? '' : 'pl-1'}"> <span class="name">${r.user_name}</span>
                        <p class="msg">${r.message}</p>
                    </div>
                </div>`
        })

        document.getElementById('message').innerHTML = chatsHTML
    }

    window.addEventListener('load', async (ev) => {
        await getChat()

        // Connect to pusher
        const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
        })

        // Connect to chat channel
        const channel = pusher.subscribe('chat-channel')

        // Listen for chat-send event
        channel.bind('chat-send', async (data) => {
            await getChat()
        })

        // Send message
        document.getElementById('form').addEventListener('submit', async (ev) => {
            ev.preventDefault()

            const message = document.querySelector('input[name="text"]')
            const response = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message: message.value,
                    room: '{{ $room->id }}'
                })
            })

            const data = await response.json()

            if(data) {
                // Get chat
                await getChat()

                message.value = ''
            }
        })
    })
</script>
@endsection