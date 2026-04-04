<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(): View
    {
        $building = config('apartments.building');
        $poi      = config('apartments.poi');

        return view('contact', compact('building', 'poi'));
    }

    /**
     * Procesare formular de contact (general și de pe pagina apartament).
     * Phase 1: salvare + flash.
     * Phase 2: email notification + CRM + webhook.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        /*
         * Phase 2: aici integrezi email/CRM/webhook.
         * Ex: Mail::to(config('mail.contact'))->send(new ContactMail($request->validated()));
         *     \Log::info('contact', $request->validated());
         */

        return back()->with('success', __('contact.success'));
    }

    /**
     * Formular rapid din modal ofertă (same handler, sursă diferită).
     */
    public function oferta(ContactRequest $request): RedirectResponse
    {
        /*
         * Phase 2: același handler, posibil cu notificare diferită (SMS imediat).
         */

        return back()->with('success', __('contact.success'));
    }
}
