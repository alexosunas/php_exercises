var chat = {
  conn: null,
	init: function(){
    var self = this;
    self.conn = new WebSocket('ws://localhost:8080');

		self.conn.onopen = function(e) {
		    console.log("Connection established!");
		};

    self.conn.onmessage = function(e) {
    		console.log(e.data);
        alert(e.data)
		};

    var sendButton = document.getElementById("send");
    sendButton.addEventListener('click', self.SendMessage);
	},
  SendMessage: function(e){

    var message = document.getElementById("message").value;
    chat.conn.send(message);
  }
};

chat.init();