var chat = {
  conn: null,
  init: function(){
    var self = this;
    //Save the webSocket connections
    self.conn = new WebSocket('ws://localhost:8080');

    //Listen for the handshake established
    self.conn.onopen = function(e) {
        console.log("Connection established!");
    };

    //Listen for a message and alert it
    self.conn.onmessage = function(e) {
        console.log(e.data);
        alert(e.data)
    };

    //Listen the click event 
    var sendButton = document.getElementById("send");
    sendButton.addEventListener('click', self.SendMessage);
  },
  SendMessage: function(e){

    //Take the message from input and  send it to the webSocket
    var message = document.getElementById("message").value;
    chat.conn.send(message);
  }
};

//Construct the object
chat.init();