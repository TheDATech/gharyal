<div class="chat-editor-area">
    <input type="text" name="message" wire:model="message" class="form-control" placeholder="Type your message" style="border: none;height: 30px;" id="">    
    <button class="btn btn-sm btn-send" wire:click="sendMessage" type="submit">Send</button>
</div>