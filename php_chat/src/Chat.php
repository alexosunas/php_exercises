<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


//Implements the Ratchet interface
class Chat implements MessageComponentInterface {
    protected $clients;

    //The constructor creates object to store the incoming connection
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    //Listen when the handshake is established
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    //Listen when a message is sent
    public function onMessage(ConnectionInterface $from, $msg) {
        //Count the number of connections established
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        //Send the message to each client
        foreach ($this->clients as $client) {
            // The sender is not the receiver, send to each client connected
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}