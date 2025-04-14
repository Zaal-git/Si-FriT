<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    public function index()
    {
        $servers = Servers::all();
        return view('master-data.server.main', [
            'title' => 'Master Data - Server',
            'servers' => $servers
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip|unique:servers,ip_address',
            'location' => 'required',
            'status' => 'required|boolean',
        ]);

        Servers::create($request->all());
        return redirect('master-data/server/')->with('success', 'Server berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $server = Servers::findOrFail($id);

        if (request()->ajax()) {
            return response()->json($server);
        }

        return view('master-data.server.edit', compact('server'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip|unique:servers,ip_address,' . $id,
            'location' => 'required',
            'status' => 'required|boolean',
        ]);

        $server = Servers::findOrFail($id);
        $server->update($request->all());
        return redirect('master-data/server/')->with('success', 'Server berhasil diupdate.');
    }

    public function destroy($id)
    {
        $server = Servers::findOrFail($id);
        $server->delete();
        return redirect('master-data/server/')->with('success', 'Server berhasil dihapus.');
    }
}
