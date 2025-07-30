<?php
// WebSocket Server for Real-time Chat
// This is an optional enhancement for true real-time communication
// Requires: php -q websocket_server.php

require_once 'chat_api.php';

class ChatWebSocketServer {
    private $socket;
    private $clients = [];
    private $chatSessions = [];
    
    public function __construct($host = 'localhost', $port = 8080) {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->socket, $host, $port);
        socket_listen($this->socket);
        
        echo "WebSocket server started on ws://$host:$port\n";
    }
    
    public function run() {
        while (true) {
            $changed = array_merge([$this->socket], $this->clients);
            socket_select($changed, $null, $null, 0, 10);
            
            if (in_array($this->socket, $changed)) {
                $client = socket_accept($this->socket);
                $this->clients[] = $client;
                
                // Perform WebSocket handshake
                $this->performHandshake($client);
                
                $changedKey = array_search($this->socket, $changed);
                unset($changed[$changedKey]);
            }
            
            foreach ($changed as $client) {
                $data = $this->receiveData($client);
                
                if ($data === false) {
                    $index = array_search($client, $this->clients);
                    unset($this->clients[$index]);
                    continue;
                }
                
                if ($data) {
                    $decodedData = json_decode($data, true);
                    $this->handleMessage($client, $decodedData);
                }
            }
        }
    }
    
    private function performHandshake($client) {
        $request = socket_read($client, 5000);
        preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches);
        $key = base64_encode(sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        
        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
        
        socket_write($client, $headers, strlen($headers));
    }
    
    private function receiveData($client) {
        $data = socket_read($client, 2048, PHP_NORMAL_READ);
        
        if ($data === false) {
            return false;
        }
        
        return $this->decode($data);
    }
    
    private function decode($data) {
        $length = ord($data[1]) & 127;
        
        if ($length == 126) {
            $masks = substr($data, 4, 4);
            $data = substr($data, 8);
        } elseif ($length == 127) {
            $masks = substr($data, 10, 4);
            $data = substr($data, 14);
        } else {
            $masks = substr($data, 2, 4);
            $data = substr($data, 6);
        }
        
        $text = '';
        for ($i = 0; $i < strlen($data); ++$i) {
            $text .= $data[$i] ^ $masks[$i % 4];
        }
        
        return $text;
    }
    
    private function encode($text) {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);
        
        if ($length <= 125) {
            $header = pack('CC', $b1, $length);
        } elseif ($length > 125 && $length < 65536) {
            $header = pack('CCn', $b1, 126, $length);
        } else {
            $header = pack('CCNN', $b1, 127, $length);
        }
        
        return $header . $text;
    }
    
    private function handleMessage($client, $data) {
        if (!$data) return;
        
        $action = $data['action'] ?? '';
        $sessionId = $data['session_id'] ?? '';
        
        switch ($action) {
            case 'join_session':
                $this->chatSessions[$sessionId][] = $client;
                $this->sendToClient($client, [
                    'type' => 'joined',
                    'session_id' => $sessionId
                ]);
                break;
                
            case 'send_message':
                $message = $data['message'] ?? '';
                $userName = $data['user_name'] ?? 'Guest';
                
                // Save to database
                $this->saveMessage($sessionId, $userName, $message);
                
                // Send to all clients in the session
                $this->broadcastToSession($sessionId, [
                    'type' => 'message',
                    'session_id' => $sessionId,
                    'user_name' => $userName,
                    'message' => $message,
                    'message_type' => 'user',
                    'timestamp' => date('Y-m-d H:i:s')
                ]);
                
                // Get bot response
                $botResponse = $this->getBotResponse($message, $userName);
                $this->saveMessage($sessionId, 'Pearl Vista', $botResponse, 'bot');
                
                // Send bot response
                $this->broadcastToSession($sessionId, [
                    'type' => 'message',
                    'session_id' => $sessionId,
                    'user_name' => 'Pearl Vista',
                    'message' => $botResponse,
                    'message_type' => 'bot',
                    'timestamp' => date('Y-m-d H:i:s')
                ]);
                break;
        }
    }
    
    private function saveMessage($sessionId, $userName, $message, $type = 'user') {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "the_pearl_vista");
        
        if ($conn->connect_error) {
            return false;
        }
        
        $stmt = $conn->prepare("INSERT INTO chat_messages (session_id, user_name, message, message_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sessionId, $userName, $message, $type);
        $result = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $result;
    }
    
    private function getBotResponse($userMessage, $userName = 'Guest') {
        // Use the same bot response logic as in chat_api.php
        $message = strtolower(trim($userMessage));
        
        $responses = [
            'booking' => "I can help you with bookings! You can make a reservation through our website or call us at +59741122566 for immediate assistance.",
            'reservation' => "Great! I can assist with reservations. We have various room types available.",
            'price' => "Our room rates vary by season and room type. Standard rooms start from $150/night, Deluxe rooms from $250/night.",
            'hello' => "Hello $userName! How can I assist you with your stay at Pearl Vista today?",
            'hi' => "Hi $userName! How can I assist you with your stay at Pearl Vista today?",
            'help' => "I'm here to help! I can assist with bookings, room information, amenities, and general inquiries."
        ];
        
        foreach ($responses as $keyword => $response) {
            if (strpos($message, $keyword) !== false) {
                return $response;
            }
        }
        
        return "Thank you for your message! For detailed assistance, please use our contact form or call us at +59741122566.";
    }
    
    private function sendToClient($client, $data) {
        $encoded = $this->encode(json_encode($data));
        socket_write($client, $encoded, strlen($encoded));
    }
    
    private function broadcastToSession($sessionId, $data) {
        if (!isset($this->chatSessions[$sessionId])) return;
        
        foreach ($this->chatSessions[$sessionId] as $client) {
            $this->sendToClient($client, $data);
        }
    }
}

// Start the WebSocket server
if (php_sapi_name() === 'cli') {
    $server = new ChatWebSocketServer();
    $server->run();
} else {
    echo "This script should be run from command line: php websocket_server.php\n";
}