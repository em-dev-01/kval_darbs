<?php

namespace App\Http\Controllers;

use App\Enums\ClientRequestStatusEnum;
use App\Models\ClientRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class ClientRequestController extends Controller
{
    public function index()
    {
        $clientRequests = ClientRequest::all()->sortByDesc('created_at');
        return view('client_requests.index', compact('clientRequests'));
    }

    public function show(ClientRequest $clientRequest)
    {
        return view('client_requests.show', compact('clientRequest'));
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

        return redirect()->route('welcome')->with('success', 'Pieteikums nosūtīts! Mēs sazināsimies ar Jums tuvākajā laikā!');
    }

    public function destroy(ClientRequest $clientRequest)
    {
        Project::where('client_request_id', $clientRequest->id)->update(['client_request_id' => null]);
        $clientRequest->delete();
        return redirect()->route('client_requests.index')->with('success', 'Pieteikums izdzēsts');
    }

    public function markAsRead(ClientRequest $clientRequest)
    {
        ClientRequest::where('id', $clientRequest->id)->update(['read_status' => true]);
        return redirect()->route('client_requests.show', $clientRequest);
    }

    public function accept(ClientRequest $clientRequest)
    {
        $clientRequest->status = ClientRequestStatusEnum::ACCEPTED;
        $clientRequest->read_status = true;
        $clientRequest->save();
        return redirect()->route('client_requests.show', $clientRequest);
    }

    public function deny(ClientRequest $clientRequest)
    {
        $clientRequest->status = ClientRequestStatusEnum::DENIED;
        $clientRequest->read_status = true;
        $clientRequest->save();
        return redirect()->route('client_requests.show', $clientRequest);
    }
}
