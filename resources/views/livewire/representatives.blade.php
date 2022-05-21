<div class="contacts-list scrollbar-overlay" wire:poll.keep-alive>
    <div class="nav nav-tabs border-0 flex-column" role="tablist" aria-orientation="vertical">
        
        @foreach($representatives as $representative)
        <div class="hover-actions-trigger chat-contact nav-item" wire:click="$emit('updateChatAttributes', {{ $representative->id }})" role="tab" id="chat-link-0" data-bs-toggle="tab" data-bs-target="#chat-0" aria-controls="chat-0" aria-selected="true">
            <div class="d-flex p-3">
                @if(Cache::has('user-is-online-' . $representative->id))
                    <div class="avatar avatar-xl status-online">    
                @else
                    <div class="avatar avatar-xl status-offline">
                @endif
                <img class="rounded-circle" src="backend/assets/img/team/2.jpg" alt="" />
            </div>
            <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                <div class="d-flex justify-content-between">
                <h6 class="mb-0 chat-contact-title">{{ $representative->name }} @if(App\Models\User::countuUnseenMessages($representative->id)) <span class="badge bg-danger"> {{ App\Models\User::countuUnseenMessages($representative->id) }} </span> @endif </h6>
                    <span class="message-time fs--2"> 
                        @if(App\Models\User::lastMessage($representative->id))
                            {{ date('D', strtotime(App\Models\User::lastMessage($representative->id)->created_at)) }}
                        @endif
                </span>
                </div>
                <div class="min-w-0">
                <div class="chat-contact-content pe-3"> 
                    @if(App\Models\User::lastMessage($representative->id))
                        {{ App\Models\User::lastMessage($representative->id)->message }}
                    @else
                        say hi!
                    @endif
                </div>
                <div class="position-absolute bottom-0 end-0 hover-hide">
                </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach

        @foreach($groups as $group)
        <div class="hover-actions-trigger chat-contact nav-item" wire:click="$emit('updateGroupChatAttributes', {{ $group->id }})"  role="tab" data-bs-toggle="tab" data-bs-target="#chat-0" aria-controls="chat-0" aria-selected="true">
            <div class="d-flex p-3">
            <div class="avatar avatar-xl">
                <div class="rounded-circle overflow-hidden h-100 d-flex">
                    <div class="w-50 border-end"><img src="backend/assets/img/team/1.jpg" alt="" /></div>
                    <div class="w-50 d-flex flex-column">
                        <img class="h-50 border-bottom" src="backend/assets/img/team/2.jpg" alt="" />
                        <img class="h-50" src="backend/assets/img/team/3.jpg" alt="" />
                    </div>
                </div>
            </div>
            <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                <div class="d-flex justify-content-between">
                <h6 class="mb-0 chat-contact-title">{{ $group->name }}</h6><span class="message-time fs--2">Sun</span>
                </div>
                <div class="min-w-0">
                <div class="chat-contact-content pe-3">
                    @if(App\Models\Group::lastMessage($group->id))
                    @php $user_id = App\Models\Group::lastMessage($group->id)->user_id @endphp
                    {{ App\Models\User::find($user_id)->name }}: {{ App\Models\Group::lastMessage($group->id)->message }}
                    @else
                        say hi!
                    @endif
                </div>
                <div class="position-absolute bottom-0 end-0 hover-hide">
                    <span class="fas fa-check text-success" data-fa-transform="shrink-5 down-4"></span>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    </div>
</div>