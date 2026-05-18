<?php

class FeedbackController
{
    public function index(): void
    {
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [

                'name' => $_POST['name'],

                'email' => $_POST['email'],

                'type' => $_POST['type'],

                'message' => $_POST['message'],

                'reply' => $_POST['reply'] ?? []
            ];

            $options = [

                'http' => [

                    'header' =>
                        "Content-type: application/x-www-form-urlencoded",

                    'method' => 'POST',

                    'content' => http_build_query($data)
                ]
            ];

            $context = stream_context_create($options);

            file_get_contents(
                'https://httpbin.org/post',
                false,
                $context
            );

            $success = true;
        }

        require __DIR__ .
            '/../../templates/feedback/index.php';
    }
}