<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationController extends Controller
{
    public function index(): Response
    {
        $organization = Organization::current();

        return Inertia::render('organization/Form', [
            'organization' => $organization,
            'isUpdate' => $organization !== null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        Organization::create($validated);

        return redirect()->route('organization-settings')
            ->with('message', 'Organization created successfully.');
    }

    public function update(UpdateOrganizationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $organization = Organization::current();

        if (! $organization) {
            return redirect()->route('organization-settings')
                ->with('error', 'Organization not found.');
        }

        if (isset($validated['logo']) && $validated['logo'] === 'REMOVE') {
            // User wants to remove logo
            if ($organization->logo && Storage::disk('public')->exists($organization->logo)) {
                Storage::disk('public')->delete($organization->logo);
            }
            $validated['logo'] = null;
        } elseif ($request->hasFile('logo')) {
            // User uploaded new logo
            if ($organization->logo && Storage::disk('public')->exists($organization->logo)) {
                Storage::disk('public')->delete($organization->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        } else {
            // No logo changes, preserve existing
            unset($validated['logo']);
        }

        $organization->update($validated);

        return redirect()->route('organization-settings')
            ->with('message', 'Organization updated successfully.');
    }
}
