<?php

// app/Http/Controllers/LeadController.php
namespace App\Http\Controllers;

use App\Events\LeadCreated;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $lead = Lead::create([
            'type' => $request->validated('type'),
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'message' => $request->validated('message'),
            'source' => $request->validated('source') ?? 'landing_page',
            'meta' => array_filter($request->metaFields()),
        ]);

        event(new LeadCreated($lead));

        return back()->with('status', 'Thanks — we\'ll be in touch shortly.');
    }
}