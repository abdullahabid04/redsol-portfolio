<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index(Request $request)
    {
        $query = TeamMember::query();

        // ── Filters ──────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            if ($status === 'visible') {
                $query->where('is_visible', true);
            } elseif ($status === 'hidden') {
                $query->where('is_visible', false);
            }
        }

        if ($leadership = $request->get('leadership')) {
            $query->where('is_leadership', $leadership === 'yes');
        }

        // ── Pagination ───────────────────────────────────────
        $members = $query
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        // ── Summary counts ───────────────────────────────────
        $stats = [
            'total' => TeamMember::count(),
            'visible' => TeamMember::visible()->count(),
            'hidden' => TeamMember::where('is_visible', false)->count(),
            'leadership' => TeamMember::leadership()->count(),
        ];

        return view('admin.pages.team.index', compact('members', 'stats'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create()
    {
        return view('admin.pages.team.form', [
            'member' => new TeamMember(),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'bio' => ['required', 'string', 'min:20', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'], // 2MB
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'array', 'max:5'],
            'social_links.*' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_visible' => ['boolean'],
            'is_leadership' => ['boolean'],
        ]);

        try {
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('team-members', 'public');
                $validated['photo'] = $path;
            }

            // Handle social_links as JSON
            if (isset($validated['social_links']) && is_array($validated['social_links'])) {
                $validated['social_links'] = array_filter($validated['social_links']);
            }

            // Set default sort_order if not provided
            if (!isset($validated['sort_order'])) {
                $validated['sort_order'] = TeamMember::max('sort_order') + 1 ?? 1;
            }

            // Set defaults for booleans
            $validated['is_visible'] = $validated['is_visible'] ?? true;
            $validated['is_leadership'] = $validated['is_leadership'] ?? false;

            TeamMember::create($validated);

            return redirect()
                ->route('admin.team.index')
                ->with('success', 'Team member added successfully.');

        } catch (\Exception $e) {
            \Log::error('TeamMember store failed: ' . $e->getMessage(), ['request' => $request->all()]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to add team member. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit(TeamMember $member)
    {
        return view('admin.pages.team.form', [
            'member' => $member,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified team member in storage.
     */
    public function update(Request $request, TeamMember $member)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'bio' => ['required', 'string', 'min:20', 'max:500'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'photo_alt' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'array', 'max:5'],
            'social_links.*' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_visible' => ['boolean'],
            'is_leadership' => ['boolean'],
            'remove_photo' => ['nullable', 'boolean'],
        ]);

        try {
            // Handle photo removal
            if ($request->boolean('remove_photo') && $member->photo) {
                Storage::disk('public')->delete($member->photo);
                $validated['photo'] = null;
                $validated['photo_alt'] = null;
            }

            // Handle new photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }
                $path = $request->file('photo')->store('team-members', 'public');
                $validated['photo'] = $path;
            }

            // Handle social_links as JSON
            if (isset($validated['social_links']) && is_array($validated['social_links'])) {
                $validated['social_links'] = array_filter($validated['social_links']);
            }

            $member->update($validated);

            return redirect()
                ->route('admin.team.index')
                ->with('success', 'Team member updated successfully.');

        } catch (\Exception $e) {
            \Log::error('TeamMember update failed: ' . $e->getMessage(), ['id' => $member->id, 'request' => $request->all()]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update team member. Please try again.');
        }
    }

    /**
     * Toggle the visibility of a team member.
     */
    public function toggle(TeamMember $member)
    {
        try {
            $member->toggle();
            return redirect()
                ->back()
                ->with('success', $member->is_visible
                    ? 'Team member is now visible'
                    : 'Team member is now hidden');
        } catch (\Exception $e) {
            \Log::error('TeamMember toggle failed: ' . $e->getMessage(), ['id' => $member->id]);
            return redirect()
                ->back()
                ->with('error', 'Failed to update visibility');
        }
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy(TeamMember $member)
    {
        try {
            // Delete photo if exists
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }

            $name = $member->name;
            $member->delete();

            return redirect()
                ->route('admin.team.index')
                ->with('success', "Team member \"{$name}\" deleted successfully.");

        } catch (\Exception $e) {
            \Log::error('TeamMember deletion failed: ' . $e->getMessage(), ['id' => $member->id]);
            return redirect()
                ->route('admin.team.index')
                ->with('error', 'Failed to delete team member. Please try again.');
        }
    }
}