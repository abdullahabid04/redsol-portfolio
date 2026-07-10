<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function index()
    {
        $query = ContactSubmission::query()
            ->where('is_spam', false)
            ->latest();

        // 🔹 Apply Filter
        $filter = request('filter', 'all');
        if ($filter === 'unread') {
            $query->where('status', ContactSubmission::STATUS_NEW);
        } elseif ($filter === 'read') {
            $query->where('status', ContactSubmission::STATUS_READ);
        }

        // 🔹 Apply Search
        if (request('q')) {
            $search = request('q');
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $contacts = $query->get();
        $totalContacts = ContactSubmission::where('is_spam', false)->count();
        $unreadCount = ContactSubmission::where('is_spam', false)->where('status', ContactSubmission::STATUS_NEW)->count();
        $readCount = ContactSubmission::where('is_spam', false)->where('status', ContactSubmission::STATUS_READ)->count();

        return view('admin.pages.contacts.index', compact('contacts', 'unreadCount', 'totalContacts', 'readCount'));
    }

    public function show($id)
    {
        $contact = ContactSubmission::findOrFail($id);

        // Mark as read if it's new
        if ($contact->status === ContactSubmission::STATUS_NEW) {
            $contact->status = ContactSubmission::STATUS_READ;
            $contact->save();
        }

        return view('admin.contacts.show', compact('contact'));
    }


    public function destroy($id)
    {
        $contact = ContactSubmission::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact inquiry deleted successfully.');
    }

    public function markAllRead()
    {
        ContactSubmission::where('status', ContactSubmission::STATUS_NEW)
            ->update(['status' => ContactSubmission::STATUS_READ]);

        return redirect()->route('admin.contacts.index')->with('success', 'All contact inquiries marked as read.');
    }
}
