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
            <button class="btn btn-sm btn-falcon-primary btn-info" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Conversation Information"><span class="fas fa-info"></span></button>
            </div>
        </div>
        </div>
        <div class="chat-content-body" style="display: inherit;">
        <div class="conversation-info" data-index="0">
            <div class="h-100 overflow-auto scrollbar">
            <div class="d-flex position-relative align-items-center p-3 border-bottom">
                <div class="avatar avatar-xl status-online">
                <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />

                </div>
                <div class="flex-1 ms-2 d-flex flex-between-center">
                <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="pages/user/profile.html">Antony Hopkins</a></h6>
                <div class="dropdown z-index-1">
                    <button class="btn btn-link btn-sm text-400 dropdown-toggle dropdown-caret-none me-n3" type="button" id="profile-dropdown-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-cog"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="profile-dropdown-0"><a class="dropdown-item" href="#!">Mute</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="px-3 pt-2">
                <div class="nav flex-column font-sans-serif fw-medium"><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-search me-1" data-fa-transform="shrink-1 down-3"></span></span>Search in Conversation</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-pencil-alt me-1" data-fa-transform="shrink-1"></span></span>Edit Nicknames</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-palette me-1" data-fa-transform="shrink-1"></span></span><span>Change Color</span></a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-thumbs-up me-1" data-fa-transform="shrink-1"></span></span>Change Emoji</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-bell me-1" data-fa-transform="shrink-1"></span></span>Notifications</a></div>
            </div>
            <hr class="my-2" />
            <div class="px-3" id="others-info-0">
                <div class="title" id="shared-media-title-0"><a class="btn btn-link btn-accordion hover-text-decoration-none dropdown-indicator" href="#shared-media-0" data-bs-toggle="collapse" aria-expanded="false" aria-controls="shared-media-0">Shared media</a></div>
                <div class="collapse" id="shared-media-0" aria-labelledby="shared-media-title-0" data-parent="#others-info-0">
                <div class="row mx-n1">
                    <div class="col-6 col-md-4 px-1"><a href="backend/assets/img/chat/1.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/1.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"><a href="backend/assets/img/chat/2.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/2.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/3.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/3.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/4.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/4.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/5.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/5.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/6.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/6.jpg" alt="" /></a></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="chat-content-scroll-area scrollbar">
            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                @if(Cache::has('user-is-online-' . $to_user_id))
                <div class="avatar avatar-2xl status-online me-3">
                @else
                <div class="avatar avatar-2xl status-offline me-3">
                @endif
                    <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />
                </div>
                <div class="flex-1">
                    <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="pages/user/profile.html">{{ $name }}</a></h6>
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
            <button class="btn btn-sm btn-falcon-primary btn-info" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Conversation Information"><span class="fas fa-info"></span></button>
            </div>
        </div>
        </div>
        <div class="chat-content-body" style="display: inherit;">
        <div class="conversation-info" data-index="0">
            <div class="h-100 overflow-auto scrollbar">
            <div class="d-flex position-relative align-items-center p-3 border-bottom">
                <div class="avatar avatar-xl status-online">
                <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />

                </div>
                <div class="flex-1 ms-2 d-flex flex-between-center">
                <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="pages/user/profile.html">Antony Hopkins</a></h6>
                <div class="dropdown z-index-1">
                    <button class="btn btn-link btn-sm text-400 dropdown-toggle dropdown-caret-none me-n3" type="button" id="profile-dropdown-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-cog"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="profile-dropdown-0"><a class="dropdown-item" href="#!">Mute</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#!">Archive</a><a class="dropdown-item text-danger" href="#!">Delete</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="px-3 pt-2">
                <div class="nav flex-column font-sans-serif fw-medium"><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-search me-1" data-fa-transform="shrink-1 down-3"></span></span>Search in Conversation</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-pencil-alt me-1" data-fa-transform="shrink-1"></span></span>Edit Nicknames</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-palette me-1" data-fa-transform="shrink-1"></span></span><span>Change Color</span></a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-thumbs-up me-1" data-fa-transform="shrink-1"></span></span>Change Emoji</a><a class="nav-link d-flex align-items-center py-1 px-0 text-600" href="#!"><span class="conversation-info-icon"><span class="fas fa-bell me-1" data-fa-transform="shrink-1"></span></span>Notifications</a></div>
            </div>
            <hr class="my-2" />
            <div class="px-3" id="others-info-0">
                <div class="title" id="shared-media-title-0"><a class="btn btn-link btn-accordion hover-text-decoration-none dropdown-indicator" href="#shared-media-0" data-bs-toggle="collapse" aria-expanded="false" aria-controls="shared-media-0">Shared media</a></div>
                <div class="collapse" id="shared-media-0" aria-labelledby="shared-media-title-0" data-parent="#others-info-0">
                <div class="row mx-n1">
                    <div class="col-6 col-md-4 px-1"><a href="backend/assets/img/chat/1.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/1.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"><a href="backend/assets/img/chat/2.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/2.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/3.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/3.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/4.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/4.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/5.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/5.jpg" alt="" /></a></div>
                    <div class="col-6 col-md-4 px-1"> <a href="backend/assets/img/chat/6.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="backend/assets/img/chat/6.jpg" alt="" /></a></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="chat-content-scroll-area scrollbar">
            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                <div class="avatar avatar-2xl me-3">
                    <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />
                </div>
                <div class="flex-1">
                    <h6 class="mb-0"><a class="text-decoration-none stretched-link text-700" href="pages/user/profile.html">{{ $name }}</a></h6>
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