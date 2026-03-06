<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Msg;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $conversations = Discussion::where('idUser', $user->idUser)
            ->orWhere('idUser_1', $user->idUser)
            ->with(['user', 'otherUser'])
            ->latest()
            ->get();

        return view('dashboard.messages.index', compact('conversations'));
    }

    public function show(int $id): View
    {
        $user = auth()->user();

        $conversation = Discussion::where('Id_Conversation', $id)
            ->where(function ($q) use ($user) {
                $q->where('idUser', $user->idUser)
                  ->orWhere('idUser_1', $user->idUser);
            })
            ->firstOrFail();

        $messages = $conversation->messages()
            ->orderBy('msg.created_at', 'asc')
            ->get();

        $otherUser = $conversation->idUser == $user->idUser
            ? $conversation->otherUser
            : $conversation->user;

        return view('dashboard.messages.show', compact('conversation', 'messages', 'otherUser'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'recipient_id' => 'required|integer|exists:users,idUser',
            'message' => 'required|string|max:512',
        ]);

        $user = auth()->user();
        $recipientId = $request->input('recipient_id');

        if ($user->idUser == $recipientId) {
            return redirect()->back()->with('error', 'You cannot message yourself.');
        }

        return DB::transaction(function () use ($user, $recipientId, $request) {
            // Find or create conversation
            $conversation = Discussion::where(function ($q) use ($user, $recipientId) {
                $q->where('idUser', $user->idUser)->where('idUser_1', $recipientId);
            })->orWhere(function ($q) use ($user, $recipientId) {
                $q->where('idUser', $recipientId)->where('idUser_1', $user->idUser);
            })->first();

            if (!$conversation) {
                $conversation = Discussion::create([
                    'idUser' => $user->idUser,
                    'idUser_1' => $recipientId,
                    'User1_Autorized' => true,
                    'User2_Autorized' => true,
                ]);
            }

            // Create message
            $message = Msg::create([
                'senderID' => $user->idUser,
                'idUser' => $recipientId,
                'message_content' => $request->input('message'),
            ]);

            // Link message to conversation
            DB::table('msg_convos')->insert([
                'idMessage' => $message->idMessage,
                'Id_Conversation' => $conversation->Id_Conversation,
            ]);

            return redirect()->route('messages.show', $conversation->Id_Conversation)
                ->with('success', 'Message sent!');
        });
    }

    public function create(int $userId): View
    {
        $recipient = User::findOrFail($userId);

        return view('dashboard.messages.create', compact('recipient'));
    }
}
