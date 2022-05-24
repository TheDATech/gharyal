<div class="tab-pane card-chat-pane active" role="tabpanel" wire:poll.keep-alive>
    @if($show_chat)
    <div class="chat-content-header">
        <div class="row flex-between-center">
            <div class="col-6 col-sm-8 d-flex align-items-center"><a class="pe-3 text-700 d-md-none contacts-list-show" href="#!">
                <div class="fas fa-chevron-left"></div>
            </a>
            <div class="min-w-0">
                <h5 class="mb-0 text-truncate fs-0">{{ $name }}</h5>
                <div class="fs--2 text-400">Active On Chat
                </div>
            </div>
            </div>
            <div class="col-auto">
            <button class="btn btn-sm btn-falcon-primary me-2" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Start a Call"><span class="fas fa-phone"></span></button>
            <button class="btn btn-sm btn-falcon-primary me-2" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Start a Video Call"><span class="fas fa-video"></span></button>
            <button class="btn btn-sm btn-falcon-primary btn-info" type="button" onclick="event.preventDefault();
                                                     document.getElementById('convert-to-group-form').submit();" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Add new representative to this chat"><span class="fas fa-user-plus"></span></button>
                <form id="convert-to-group-form" action="{{ route('convert-to-group') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $to_user_id }}">
                </form>    
            </div>
        </div>
    </div>
    <div class="chat-content-body" style="display: inherit;">

        <div class="chat-content-scroll-area scrollbar">
            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                @if(Cache::has('user-is-online-' . $to_user_id))
                <div class="avatar avatar-2xl status-online me-3">
                @else
                <div class="avatar avatar-2xl status-offline me-3">
                @endif
                    <img class="rounded-circle" src="{{ $profile }}" alt="" />
                </div>
                <div class="flex-1">
                    <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="{{ route('users.edit', $to_user_id) }}">{{ $name }}</a></h6>
                    <p class="mb-0">You friends with {{ $name }}. Say hi to start the conversation
                    </p>
                </div>
            </div>
            <!-- <div class="text-center fs--2 text-500"><span>May 5, 2019, 11:54 am</span></div> -->
            <div>
                @foreach($messages as $message)
                @if($message->from_user_id != Auth::User()->id)
                <div class="d-flex p-3">
                    <div class="avatar avatar-l me-2">
                        <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />
                    </div>
                    <div class="flex-1">
                        <div class="w-xxl-75">
                            <div class="hover-actions-trigger d-flex align-items-center">
                                <div class="chat-message bg-200 p-2 rounded-2">{{ $message->message }}</div>
                            </div>
                            <div class="text-400 fs--2"><span> {{ date('h:m a', strtotime($message->created_at)) }}</span></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="d-flex p-3">
                    <div class="flex-1 d-flex justify-content-end">
                        <div class="w-100 w-xxl-75">
                            <div class="hover-actions-trigger d-flex flex-end-center">
                                <div class="bg-primary text-white p-2 rounded-2 chat-message light">
                                    <p class="mb-0">{{ $message->message }} </p>
                                </div>
                            </div>
                            <div class="text-400 fs--2 text-end">
                                {{ date('h:m a', strtotime($message->created_at)) }} 
                                @if($message->is_read)
                                <span class="fas fa-check ms-2 text-success"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @elseif($show_group_chat)
    <div class="chat-content-header">
        <div class="row flex-between-center">
            <div class="col-6 col-sm-8 d-flex align-items-center"><a class="pe-3 text-700 d-md-none contacts-list-show" href="#!">
                <div class="fas fa-chevron-left"></div>
            </a>
            <div class="min-w-0">
                <h5 class="mb-0 text-truncate fs-0">{{ $name }}</h5>
                <div class="fs--2 text-400">Active On Chat
                </div>
            </div>
            </div>
            <div class="col-auto">
            <button class="btn btn-sm btn-falcon-primary me-2" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Start a Call"><span class="fas fa-phone"></span></button>
            <button class="btn btn-sm btn-falcon-primary me-2" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Start a Video Call"><span class="fas fa-video"></span></button>
            </div>
        </div>
        </div>
        <div class="chat-content-body" style="display: inherit;">
        <div class="chat-content-scroll-area scrollbar">
            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                <div class="avatar avatar-2xl me-3">
                    <img class="rounded-circle" src="{{ $group_icon }}" alt="" />
                </div>
                <div class="flex-1">
                    <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="{{ route('groups.edit', $to_group_id) }}">{{ $name }}</a></h6>
                    <p class="mb-0">{{ $description }}
                    </p>
                </div>
            </div>
            <!-- <div class="text-center fs--2 text-500"><span>May 5, 2019, 11:54 am</span></div> -->
            <div>
                @foreach($messages as $message)
                @if($message->user_id != Auth::User()->id)
                <div class="d-flex p-3">
                    <div class="avatar avatar-l me-2">
                        <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />
                    </div>
                    <div class="flex-1">
                        <div class="w-xxl-75">
                            <div class="hover-actions-trigger d-flex align-items-center">
                                <div class="chat-message bg-200 p-2 rounded-2">{{ $message->message }}</div>
                            </div>
                            <div class="text-400 fs--2"><span> {{ date('h:m a', strtotime($message->created_at)) }}</span></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="d-flex p-3">
                    <div class="flex-1 d-flex justify-content-end">
                        <div class="w-100 w-xxl-75">
                            <div class="hover-actions-trigger d-flex flex-end-center">
                                <div class="bg-primary text-white p-2 rounded-2 chat-message light">
                                    <p class="mb-0">{{ $message->message }} </p>
                                </div>
                            </div>
                            <div class="text-400 fs--2 text-end">
                                {{ date('h:m a', strtotime($message->created_at)) }} 
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>