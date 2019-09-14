<?php

namespace console\components;

use common\models\ChatLog;
use Yii;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class SocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->echoToClient($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    private function echoToClient(ConnectionInterface $conn) {
        $conn->send(json_encode([
            'message'=>'Всем привет',
            'username'=>'Чат студентов',
            'date' => Yii::$app->formatter->asDatetime(time())
        ]));
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = $this->clients->count() - 1;
        var_dump($msg);
        var_dump('clients: ' . $this->clients->count());
        ChatLog::saveLog($msg);
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        foreach ($this->clients as $client) {
            $msg = json_decode($msg, true);
            $msg['date'] = Yii::$app->formatter->asDatetime(time());
            $msg = json_encode($msg);

            $client->send($msg);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
}