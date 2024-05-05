<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageEvent;

class chat extends Component
{
    public $messages = [];
    public $text;
    public $users;
    public $selectedUser;
    public $newMessage = false;
    public $userWithNewMessage = [];
    public $conversation = [];

    protected $listeners = [
        'showMessages' => 'showMessages',
    ];   
    
    public function showMessages($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->messages = Message::messageList($userId)->get()->toArray();
    }

    #[On('echo:livewire_chatapp,MessageEvent')]
    public function listenForMessage($data)
    {
        $this->messages[] = $data['message'];
    }

    public function updatedMessages()
    {
        $this->dispatchBrowserEvent('scrollToBottom');
    }

    public function sendMessage()
    {

        $user = Auth::user();

        // Create a new Message instance and save it
        $message = new Message();
        MessageEvent::dispatch($this->text, $user->id, $this->selectedUser['id']);

        $this->text = null;

    }

    public function render()
    {
        $this->users = User::where('id','<>',auth()->id())->get();
        return view('livewire.chat');
    }
}
