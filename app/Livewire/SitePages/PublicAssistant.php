<?php

namespace App\Livewire\SitePages;

use OpenAI;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class PublicAssistant extends Component
{
    #[Validate('required', as: "pregunta")]
    public $prompt;

    public $runId, $runStatus, $runRetrieve, $messagesList;
    public $apiKey, $assistantId, $threadId, $messageId;

    public function mount()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->assistantId = env('ASSISTANT_ID');
        $this->messagesList = array();
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.site-pages.public-assistant', [
            'messages' => $this->messagesList,
        ]);
    }

    public function callAssistant()
    {
        $this->validate();
        array_push($this->messagesList, ['role' => 'user', 'content' => $this->prompt]);
        // ? Create client
        $client = OpenAI::client($this->apiKey);

        // ? Create a Thread and get threadId
        if (!$this->threadId) {
            $response = $client->threads()->create([]);
            $this->threadId = $response->id;
        }

        // ? Create a message to Thread
        $messageResponse = $client->threads()->messages()->create($this->threadId, [
            'role' => 'user',
            'content' => $this->prompt,
        ]);
        $this->messageId = $messageResponse->id;

        // ? Create a run of a Thread
        $runReponse = $client->threads()->runs()->create(
            threadId: $this->threadId,
            parameters: [
                "assistant_id" => $this->assistantId,
            ],
        );
        $this->runId = $runReponse->id;

        // ? Verify if run is completed, if then run is completed, add messages to messageList array
        while (true) {
            try {
                $run = $client->threads()->runs()->retrieve($this->threadId, $this->runId);
                if ($run->completedAt) {
                    $response = $client->threads()->messages()->list($this->threadId, [
                        'limit' => 10,
                    ]);
                    array_push($this->messagesList, ['role' => 'assistant', 'content' => $response->data[0]->content[0]->text->value]);
                    $this->reset('prompt');
                    break;
                }
            } catch (\Throwable $th) {
                dd($th);
            }
            sleep(1);
        }
    }
}
