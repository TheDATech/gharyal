@extends('layouts.app')
@section('content')
<div class="row g-3 mb-3">
    <div class="col-lg-12">
        <div class="card card-chat overflow-hidden">
            <div class="card-body d-flex p-0 h-100">
                <div class="chat-sidebar">
                    <livewire:representatives /> 
                    <div class="border h-100">  
                    </div>
                </div>
                <div class="tab-content card-chat-content">
                    <livewire:chatpanel />
                    <livewire:chatmessage />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection