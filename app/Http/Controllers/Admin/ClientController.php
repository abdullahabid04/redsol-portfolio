<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // ── Filters ──────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('province', 'like', "%{$search}%");
            });
        }

        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        if ($status = $request->get('status')) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // ── Pagination ───────────────────────────────────────
        $clients = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.pages.clients.form');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        try {
            // ── Handle logo upload ───────────────────────────
            if ($request->hasFile('logo')) {
                $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
            }

            // ── Checkbox fallbacks ───────────────────────────
            $validated['is_active'] = $request->has('is_active');
            $validated['is_featured'] = $request->has('is_featured');

            // ── Default sort order ───────────────────────────
            if (empty($validated['sort_order'])) {
                $validated['sort_order'] = (Client::max('sort_order') ?? 0) + 1;
            }

            Client::create($validated);

            return redirect()->route('admin.clients.index')->with('success', 'Client added successfully.');

        } catch (\Exception $e) {
            \Log::error('Client store failed: ' . $e->getMessage(), [
                'request' => $request->except('logo'),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->with('error', 'Failed to create client. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(string $id)
    {
        $client = Client::findOrFail($id);

        return view('admin.pages.clients.form', [
            'client' => $client,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);
        $validated = $this->validateRequest($request, $client->id);

        try {
            // ── Handle logo removal/replacement ──────────────
            if ($request->filled('remove_logo')) {
                if ($client->logo_path && Storage::disk('public')->exists($client->logo_path)) {
                    Storage::disk('public')->delete($client->logo_path);
                }
                $validated['logo_path'] = null;
            } elseif ($request->hasFile('logo')) {
                if ($client->logo_path && Storage::disk('public')->exists($client->logo_path)) {
                    Storage::disk('public')->delete($client->logo_path);
                }
                $validated['logo_path'] = $request->file('logo')->store('clients', 'public');
            } else {
                // Keep existing logo
                unset($validated['logo_path']);
            }

            // ── Checkbox fallbacks ───────────────────────────
            $validated['is_active'] = $request->has('is_active');
            $validated['is_featured'] = $request->has('is_featured');

            $client->update($validated);

            return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');

        } catch (\Exception $e) {
            // Rollback newly uploaded logo if DB update fails
            if (isset($validated['logo_path']) && Storage::disk('public')->exists($validated['logo_path'])) {
                Storage::disk('public')->delete($validated['logo_path']);
            }

            \Log::error("Client update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->except('logo'),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->with('error', 'Failed to update client. Please try again.');
        }
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);

            // ── Delete associated logo ───────────────────────
            if ($client->logo_path && Storage::disk('public')->exists($client->logo_path)) {
                Storage::disk('public')->delete($client->logo_path);
            }

            $name = $client->name;
            $client->delete();

            return redirect()->route('admin.clients.index')->with('success', "Client \"{$name}\" deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.clients.index')->with('error', 'Client not found.');
        } catch (\Exception $e) {
            \Log::error("Client deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()->route('admin.clients.index')->with('error', 'Failed to delete client.');
        }
    }

    /**
     * Toggle active status.
     */
    public function toggle(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->toggle();
            return back()->with('success', $client->is_active ? 'Client activated.' : 'Client deactivated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update client status.');
        }
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->toggleFeatured();
            return back()->with('success', $client->is_featured ? 'Client featured.' : 'Client unfeatured.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update featured status.');
        }
    }

    /**
     * Shared validation rules.
     */
    private function validateRequest(Request $request, ?int $ignoreId = null)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => [
                'nullable',
                'string',
                'max:100',
                Rule::in([
                    'Punjab',
                    'Sindh',
                    'KPK',
                    'Balochistan',
                    'Islamabad',
                    'AJK',
                    'Gilgit-Baltistan'
                ])
            ],
            'website_url' => ['nullable', 'url', 'max:255'],
            'year_deployed' => ['nullable', 'integer', 'digits:4', 'min:2000', 'max:' . date('Y')],
            'notes' => ['nullable', 'string'],
            'logo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,webp,svg', 'max:1024'],
            'logo_alt' => ['nullable', 'string', 'max:255'],
            'type' => ['required', Rule::in(array_keys(Client::TYPES))],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);
    }
}