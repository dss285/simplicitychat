<style type="text/css">
	.activeChats {
		height: 300px;
		width: 250px;
		background-color: grey;
		position: fixed;
		z-index: 4;
		bottom: 40px;
		right: 0px;
		border-left: 3px solid black;
		border-top: 2px solid black;
		border-right: 3px solid black;
		padding: 5px;
		overflow-y: scroll;
		display: none;
	}

	.activeChats .chat {
		background-color: white;
		border-radius: 10px;
		border: 0.5px solid black;
		margin: 5px;
		padding-left: 5px;
		padding-right: 5px;
	}

	.activeChats .chat:hover {
		cursor: pointer;
		background-color: yellow;
	}
</style>

<script>
$(document).ready(function(){
    $("#toggleChat").click(function(){
        $("#chats").toggle();
    });
});
</script>

<div class="activeChats" id="chats">

	<div class="chat"><p>Tommi do you like my windows 95 theme :)</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	<div class="chat"><p>This is a chat</p></div>
	
		
</div>
<div class="activeChatPanel" id="toggleChat">
	<p>ACTIVE CHATS (1)</p>
</div>