<div>
    <div class="col-9">
        <h3 class="card-header">{{ __('USERS') }}</h3>
        <hr />

        <div class="col-12 row">
            <div class = "col-md-4">
                <ul class="list-group">

                    @foreach($users as $user)
                    <li wire:click="showMessages({{ $user->id }})" 
                        class="list-group-item d-flex align-items-center {{(optional($selectedUser)['id']) == $user->id ? 'active' : ''}}">
                        @if(!empty($user->avatar))
                            <img src="{{ asset('avatars/' . $user->avatar) }}" alt="User Avatar" class="avatar rounded-circle d-flex align-self-center z-depth-1" style="width:50px;height:50px;margin-right:25px;">
                        @else
                            <img src="{{ asset('avatars/default_user.png' ) }}" alt="User Avatar" class="avatar rounded-circle d-flex align-self-center z-depth-1" style="width:50px;height:50px;margin-right:25px;">
                        @endif
                        {{$user->name}}
                        
                    </li>
                @endforeach

            </ul>
        </div>
        <div class = "col-md-8">
            @if($selectedUser)
                <section class = "">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="card" id="card1" style="">
                                    <div class="card-header d-flex align-items-center p-3" style="font-size:large;">
                                        <i class="fas fa-angle-left"></i>
                                        @if(!empty($selectedUser['avatar']))
                                            <img src="{{ asset('avatars/' . $selectedUser['avatar']) }}" alt="User Avatar" class="avatar rounded-circle d-flex align-self-center z-depth-1" style="width:50px;height:50px;margin-right:25px;">
                                        @else
                                            <img src="{{ asset('avatars/default_user.png' ) }}" alt="User Avatar" class="avatar rounded-circle d-flex align-self-center z-depth-1" style="width:50px;height:50px;margin-right:25px;">
                                        @endif
                                        <p class="mb-0 fw-bold">{{$selectedUser['name']}}</p>
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="message-body" style="height:500px;overflow: auto;flex-direction: column-reverse;">
                                            @foreach($messages as $message)
                                                @if($message['receiver_id'] == auth()->id())

                                                    <div class="d-flex flex-row justify-content-start mb-4">
                                                        
                                                        {{-- <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.webp" alt="avatar" class="avatar rounded-circle d-flex align-self-center mr-2 z-depth-1" style="width:50px;height:50px;"> --}}
                
                                                        <div class="p-3 ms-3" style="border-radius:15px;background-color:rgba(57,192,237,.2);height:fit-content;">
                                                            <p class="small mb-0">{{$message['message']}}</p>
                                                        </div>
                                                    </div> 
                                                @else
                                                    <div class="d-flex flex-row justify-content-end mb-4">
                                                        <div class="p-3 me-3 border" style="border-radius:15px;background-color:#fbfbfb;height:fit-content;">
                                                        <p class="small mb-0">{{$message['message']}}</p>
                                                        </div>
                                                        {{-- <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-4.webp" alt="avatar" class="avatar rounded-circle d-flex align-self-center mr-2 z-depth-1" style="width:50px;height:50px;"> --}}
                                                                                        </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        <div class=" row form-outline">
                                            <input class="form-control" id="textAreaExample" wire:model.debounce.100ms="text" placeholder="Type your Message...">
                                            <button wire:click="sendMessage" class="btn btn-primary mt-2"> send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>
</div>