<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ClientRequestStatusEnum;
use App\Models\ClientRequest;

class ClientRequestController extends Controller
{
    public function index(){
        $clientRequests = ClientRequest::all();
        return view('client_requests.index', compact('clientRequests'));
    }

    public function show(ClientRequest $clientRequest){
        return view('client_requests.show', compact('clientRequest'));
    }

    public function edit(ClientRequest $clientRequest){
        return view('client_requests.edit', compact('clientRequest'));
    }

    public function update(Request $request, ClientRequest $clientRequest){
        $request->validate([
         'status' => [new Enum(ClientRequestStatusEnum::class)],
        ]);
        $clientRequest->update($request->all());
        return redirect()->route('client_requests.show', $clientRequest);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email',
        ]);

        $clientRequest = new ClientRequest($request->all());
        $clientRequest->save();

        return redirect()->route('index')->with('success', 'Form submitted successfully!');
    }

    public function destroy(ClientRequest $clientRequest){
        $clientRequest->delete();
        return redirect()->route('client_requests.index')->with('success', 'Request deleted successfully!');
    }

    public function markAllAsRead()
    {
        ClientRequest::where('read_status', 'unread')->update(['read_status' => 'read']);
        return redirect()->back()->with('success', 'All requests marked as read');
    }
}
