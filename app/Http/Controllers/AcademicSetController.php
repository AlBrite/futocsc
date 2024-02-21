<?php

namespace App\Http\Controllers;

use App\Models\AcademicSet;

class AcademicSetController extends Controller
{
    public function show(AcademicSet $set)
    {

        $set->url = $set->tokenURL($set);
        $students = $set->students()->latest()->simplePaginate(10);

        $advisor = $set->advisor?->user;
        return view('academicset.show', compact('set', 'advisor', 'students'));
    }

    public function revokeInvitationLink(AcademicSet $set)
    {
        AcademicSet::revokeToken($set);

        return redirect()->route('view.academic_set', compact('set'))->with('message', 'Invitation link revoked');
    }

    public function generateInvitationLink(AcademicSet $set)
    {
        AcademicSet::regenerateToken($set);

        return redirect()->route('view.academic_set', compact('set'))->with('message', 'Invitation link generated');
    }
}
