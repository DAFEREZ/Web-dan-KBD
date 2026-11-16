<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $aksiList = AuditLog::query()->distinct()->orderBy('aksi')->pluck('aksi');

        $logs = AuditLog::with('user:id,username')
            ->when($request->filled('aksi'), fn ($q) => $q->where('aksi', $request->string('aksi')))
            ->orderByDesc('id')
            ->limit(200)
            ->get();

        return view('admin.audit', compact('logs', 'aksiList'));
    }
}